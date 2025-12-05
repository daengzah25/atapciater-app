<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    const MAX_RETRIES = 3;
    const RETRY_DELAY = 1; // detik
    const API_TIMEOUT = 30; // detik
    const API_BASE_URL = 'https://api.fonnte.com/send';

    private string $apiToken;
    private bool $isConfigured = false;

    public function __construct()
    {
        $this->apiToken = env('FONNTE_API_TOKEN', '');
        $this->isConfigured = !empty($this->apiToken) && $this->apiToken !== 'your_fonnte_api_token_here';
    }

    /**
     * Cek apakah Fonnte sudah dikonfigurasi
     */
    public function isConfigured(): bool
    {
        return $this->isConfigured;
    }

    /**
     * Kirim notifikasi booking ke customer
     */
    public function sendBookingNotification($pesanan, array $detailAddons): bool
    {
        if (!$this->isConfigured) {
            Log::warning('Fonnte tidak dikonfigurasi. Plewati pengiriman WhatsApp.');
            return false;
        }

        $phone = $this->formatPhoneNumber($pesanan->no_wa);
        $message = $this->formatBookingMessage($pesanan, $detailAddons);

        return $this->sendMessage($phone, $message, [
            'type' => 'booking',
            'pesanan_id' => $pesanan->id_pesanan,
            'customer_name' => $pesanan->nama_pemesan,
        ]);
    }

    /**
     * Kirim notifikasi konfirmasi ke customer
     */
    public function sendConfirmationNotification($pesanan): bool
    {
        if (!$this->isConfigured) {
            Log::warning('Fonnte tidak dikonfigurasi. Plewati pengiriman WhatsApp.');
            return false;
        }

        $phone = $this->formatPhoneNumber($pesanan->no_wa);
        $message = $this->formatConfirmationMessage($pesanan);

        return $this->sendMessage($phone, $message, [
            'type' => 'confirmation',
            'pesanan_id' => $pesanan->id_pesanan,
            'customer_name' => $pesanan->nama_pemesan,
        ]);
    }

    /**
     * Kirim notifikasi pembatalan ke customer
     */
    public function sendCancellationNotification($pesanan, string $reason = ''): bool
    {
        if (!$this->isConfigured) {
            Log::warning('Fonnte tidak dikonfigurasi. Plewati pengiriman WhatsApp.');
            return false;
        }

        $phone = $this->formatPhoneNumber($pesanan->no_wa);
        $message = $this->formatCancellationMessage($pesanan, $reason);

        return $this->sendMessage($phone, $message, [
            'type' => 'cancellation',
            'pesanan_id' => $pesanan->id_pesanan,
            'customer_name' => $pesanan->nama_pemesan,
        ]);
    }

    /**
     * Kirim notifikasi pengingat ke customer
     */
    public function sendReminderNotification($pesanan): bool
    {
        if (!$this->isConfigured) {
            Log::warning('Fonnte tidak dikonfigurasi. Plewati pengiriman WhatsApp.');
            return false;
        }

        $phone = $this->formatPhoneNumber($pesanan->no_wa);
        $message = $this->formatReminderMessage($pesanan);

        return $this->sendMessage($phone, $message, [
            'type' => 'reminder',
            'pesanan_id' => $pesanan->id_pesanan,
            'customer_name' => $pesanan->nama_pemesan,
        ]);
    }

    /**
     * Kirim pesan generik ke nomor WhatsApp
     */
    private function sendMessage(string $phone, string $message, array $metadata = []): bool
    {
        $attempt = 0;
        $lastException = null;

        while ($attempt < self::MAX_RETRIES) {
            try {
                $attempt++;

                Log::info('Mengirim WhatsApp via Fonnte (Attempt ' . $attempt . '/' . self::MAX_RETRIES . '):', [
                    'phone' => $this->maskPhoneNumber($phone),
                    'message_length' => strlen($message),
                    'metadata' => $metadata,
                ]);

                $response = Http::withHeaders([
                    'Authorization' => $this->apiToken,
                ])
                    ->timeout(self::API_TIMEOUT)
                    ->asForm()
                    ->post(self::API_BASE_URL, [
                        'target' => $phone,
                        'message' => $message,
                        'delay' => '2',
                        'countryCode' => '62',
                    ]);

                // Log response lengkap untuk debugging
                $responseData = $response->json();

                Log::info('Fonnte API Response (Attempt ' . $attempt . '):', [
                    'status_code' => $response->status(),
                    'success' => $response->successful(),
                    'response_status' => $responseData['status'] ?? null,
                    'message_id' => $responseData['data']['id_message'] ?? null,
                    'metadata' => $metadata,
                ]);

                // Cek jika response sukses
                if ($response->successful() && isset($responseData['status']) && $responseData['status'] === true) {
                    Log::info('✅ WhatsApp berhasil dikirim via Fonnte', [
                        'pesanan_id' => $metadata['pesanan_id'] ?? null,
                        'type' => $metadata['type'] ?? null,
                        'attempt' => $attempt,
                        'message_id' => $responseData['data']['id_message'] ?? null,
                    ]);
                    return true;
                }

                // Jika gagal tapi bukan error server (retry)
                $errorReason = $responseData['reason'] ?? 'Unknown error';
                $shouldRetry = $response->status() >= 500; // Retry hanya untuk server error

                if ($shouldRetry && $attempt < self::MAX_RETRIES) {
                    Log::warning('⚠️ Fonnte API error, akan retry: ' . $errorReason, [
                        'attempt' => $attempt,
                        'pesanan_id' => $metadata['pesanan_id'] ?? null,
                        'status_code' => $response->status(),
                    ]);
                    sleep(self::RETRY_DELAY);
                    continue;
                } else {
                    // Error yang tidak perlu di-retry
                    Log::error('❌ Fonnte API error (tidak di-retry): ' . $errorReason, [
                        'attempt' => $attempt,
                        'pesanan_id' => $metadata['pesanan_id'] ?? null,
                        'status_code' => $response->status(),
                        'response' => $responseData,
                        'metadata' => $metadata,
                    ]);
                    return false;
                }
            } catch (\Exception $e) {
                $lastException = $e;

                Log::warning('⚠️ Exception saat mengirim WhatsApp (Attempt ' . $attempt . '): ' . $e->getMessage(), [
                    'attempt' => $attempt,
                    'pesanan_id' => $metadata['pesanan_id'] ?? null,
                    'exception_class' => get_class($e),
                ]);

                if ($attempt < self::MAX_RETRIES) {
                    sleep(self::RETRY_DELAY);
                    continue;
                } else {
                    Log::error('❌ Gagal mengirim WhatsApp setelah ' . self::MAX_RETRIES . ' kali percobaan: ' . $e->getMessage(), [
                        'pesanan_id' => $metadata['pesanan_id'] ?? null,
                        'exception' => $e,
                        'metadata' => $metadata,
                    ]);
                    return false;
                }
            }
        }

        Log::error('❌ Gagal mengirim WhatsApp - semua retry habis', [
            'pesanan_id' => $metadata['pesanan_id'] ?? null,
            'attempts' => $attempt,
            'last_error' => $lastException?->getMessage(),
            'metadata' => $metadata,
        ]);

        return false;
    }

    /**
     * Format nomor telepon untuk Fonnte (format internasional)
     */
    public function formatPhoneNumber(string $phone): string
    {
        // Hapus semua karakter non-digit
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Jika dimulai dengan 0, ganti dengan 62
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }
        // Jika belum dimulai dengan 62 dan bukan 0
        elseif (substr($phone, 0, 2) !== '62') {
            $phone = '62' . $phone;
        }

        return $phone;
    }

    /**
     * Format pesan booking untuk customer
     */
    private function formatBookingMessage($pesanan, array $detailAddons): string
    {
        Carbon::setLocale('id');

        $tanggalBooking = Carbon::parse($pesanan->tanggal_booking)->translatedFormat('l, d F Y');
        $tanggalPesan = Carbon::parse($pesanan->tanggal_pesan)->translatedFormat('l, d F Y H:i');

        // Determine payment method text
        if ($pesanan->metode_bayar === 'dp_50%') {
            $metodeBayar = 'DP 50%';
        } elseif ($pesanan->metode_bayar === 'full_cash_on_site') {
            $metodeBayar = 'Bayar 100% di Tempat';
        } else {
            $metodeBayar = 'Lunas';
        }

        // Hitung total full
        $totalFull = $pesanan->harga_paket;
        foreach ($detailAddons as $addon) {
            $totalFull += $addon['subtotal'];
        }

        // Format addons
        $addonsText = '';
        if (!empty($detailAddons)) {
            $addonsText = "\n\n*TAMBAHAN:*\n";
            foreach ($detailAddons as $addon) {
                $addonsText .= "• {$addon['nama']} (x{$addon['jumlah']}): Rp "
                    . number_format($addon['subtotal'], 0, ',', '.') . "\n";
            }
        }

        // Format pesan berdasarkan metode bayar
        if ($pesanan->metode_bayar === 'dp_50%') {
            $sisaBayar = $totalFull - $pesanan->total;

            $message = "Halo *{$pesanan->nama_pemesan}*,\n\n"
                . "Terima kasih telah melakukan booking di *ATAP CIATER*! 🏕️\n\n"
                . "*DETAIL BOOKING:*\n"
                . "📋 *ID Pesanan:* {$pesanan->id_pesanan}\n"
                . "👤 *Nama Pemesan:* {$pesanan->nama_pemesan}\n"
                . "📦 *Paket:* {$pesanan->nama_paket}\n"
                . "📅 *Tanggal Booking:* {$tanggalBooking}\n"
                . "🕒 *Waktu Pemesanan:* {$tanggalPesan}\n"
                . "💰 *Metode Bayar:* {$metodeBayar}"
                . $addonsText . "\n"
                . '💳 *TOTAL HARGA:* Rp ' . number_format($totalFull, 0, ',', '.') . "\n"
                . '💵 *DP 50% YANG DIBAYAR:* Rp ' . number_format($pesanan->total, 0, ',', '.') . "\n"
                . '📊 *SISA PEMBAYARAN:* Rp ' . number_format($sisaBayar, 0, ',', '.') . "\n\n"
                . "*Catatan:* Sisa pembayaran dapat dilunasi di tempat saat check-in.\n\n"
                . "*Status:* MENUNGGU KONFIRMASI\n\n"
                . "Pembayaran Anda akan diverifikasi dalam 1x24 jam. Terima kasih! 🙏\n\n"
                . "Untuk informasi lebih lanjut:\n"
                . "📞 Customer Service: 0812-3456-7890\n"
                . '📍 Lokasi: Atap Ciater, Subang';
        } elseif ($pesanan->metode_bayar === 'full_cash_on_site') {
            $message = "Halo *{$pesanan->nama_pemesan}*,\n\n"
                . "Terima kasih telah melakukan booking di *ATAP CIATER*! 🏕️\n\n"
                . "*DETAIL BOOKING:*\n"
                . "📋 *ID Pesanan:* {$pesanan->id_pesanan}\n"
                . "👤 *Nama Pemesan:* {$pesanan->nama_pemesan}\n"
                . "📦 *Paket:* {$pesanan->nama_paket}\n"
                . "📅 *Tanggal Booking:* {$tanggalBooking}\n"
                . "🕒 *Waktu Pemesanan:* {$tanggalPesan}\n"
                . "💰 *Metode Bayar:* {$metodeBayar}"
                . $addonsText . "\n"
                . '💳 *TOTAL PEMBAYARAN:* Rp ' . number_format($totalFull, 0, ',', '.') . "\n\n"
                . "*CATATAN PENTING:* Pembayaran penuh akan dilakukan di lokasi saat check-in.\n\n"
                . "*Status:* MENUNGGU KONFIRMASI\n\n"
                . "Kami akan mengkonfirmasi ketersediaan dalam 1x24 jam. Terima kasih! 🙏\n\n"
                . "Untuk informasi lebih lanjut:\n"
                . "📞 Customer Service: 0812-3456-7890\n"
                . '📍 Lokasi: Atap Ciater, Subang';
        } else {
            $message = "Halo *{$pesanan->nama_pemesan}*,\n\n"
                . "Terima kasih telah melakukan booking di *ATAP CIATER*! 🏕️\n\n"
                . "*DETAIL BOOKING:*\n"
                . "📋 *ID Pesanan:* {$pesanan->id_pesanan}\n"
                . "👤 *Nama Pemesan:* {$pesanan->nama_pemesan}\n"
                . "📦 *Paket:* {$pesanan->nama_paket}\n"
                . "📅 *Tanggal Booking:* {$tanggalBooking}\n"
                . "🕒 *Waktu Pemesanan:* {$tanggalPesan}\n"
                . "💰 *Metode Bayar:* {$metodeBayar}"
                . $addonsText . "\n"
                . '💳 *TOTAL PEMBAYARAN:* Rp ' . number_format($totalFull, 0, ',', '.') . "\n\n"
                . "*Status:* MENUNGGU KONFIRMASI\n\n"
                . "Pembayaran Anda akan diverifikasi dalam 1x24 jam. Terima kasih! 🙏\n\n"
                . "Untuk informasi lebih lanjut:\n"
                . "📞 Customer Service: 0812-3456-7890\n"
                . '📍 Lokasi: Atap Ciater, Subang';
        }

        return $message;
    }

    /**
     * Format pesan konfirmasi untuk customer
     */
    private function formatConfirmationMessage($pesanan): string
    {
        Carbon::setLocale('id');
        $tanggalBooking = Carbon::parse($pesanan->tanggal_booking)->translatedFormat('l, d F Y');

        $message = "Halo *{$pesanan->nama_pemesan}*,\n\n"
            . "Pesanan Anda di *ATAP CIATER* telah *DIKONFIRMASI*! 🎉\n\n"
            . "*DETAIL KONFIRMASI:*\n"
            . "📋 *ID Pesanan:* {$pesanan->id_pesanan}\n"
            . "📅 *Tanggal Booking:* {$tanggalBooking}\n"
            . "📦 *Paket:* {$pesanan->nama_paket}\n"
            . '💰 *Total:* Rp ' . number_format($pesanan->total, 0, ',', '.') . "\n\n"
            . "Pesanan Anda sudah aktif dan siap untuk digunakan pada tanggal yang telah ditentukan.\n\n"
            . "Terima kasih telah memilih Atap Ciater! 🙏\n\n"
            . "Untuk informasi lebih lanjut:\n"
            . "📞 Customer Service: 0812-3456-7890\n"
            . '📍 Lokasi: Atap Ciater, Subang';

        return $message;
    }

    /**
     * Format pesan pembatalan untuk customer
     */
    private function formatCancellationMessage($pesanan, string $reason = ''): string
    {
        Carbon::setLocale('id');
        $tanggalBooking = Carbon::parse($pesanan->tanggal_booking)->translatedFormat('l, d F Y');

        $reasonText = $reason ? "\n\n*Alasan Pembatalan:*\n{$reason}" : '';

        $message = "Halo *{$pesanan->nama_pemesan}*,\n\n"
            . "Pesanan Anda di *ATAP CIATER* telah *DIBATALKAN*. ❌\n\n"
            . "*DETAIL PEMBATALAN:*\n"
            . "📋 *ID Pesanan:* {$pesanan->id_pesanan}\n"
            . "📅 *Tanggal Booking:* {$tanggalBooking}\n"
            . "📦 *Paket:* {$pesanan->nama_paket}\n"
            . '💰 *Total:* Rp ' . number_format($pesanan->total, 0, ',', '.') . "\n"
            . $reasonText . "\n\n"
            . "Jika ada pertanyaan atau ingin membuat pesanan baru, silakan hubungi kami.\n\n"
            . "📞 Customer Service: 0812-3456-7890\n"
            . '📍 Lokasi: Atap Ciater, Subang';

        return $message;
    }

    /**
     * Format pesan pengingat untuk customer
     */
    private function formatReminderMessage($pesanan): string
    {
        Carbon::setLocale('id');
        $tanggalBooking = Carbon::parse($pesanan->tanggal_booking)->translatedFormat('l, d F Y');
        $hariIni = Carbon::now()->translatedFormat('l, d F Y');

        $message = "Halo *{$pesanan->nama_pemesan}*,\n\n"
            . "Pengingat: Booking Anda di *ATAP CIATER* akan datang! ⏰\n\n"
            . "*DETAIL PESANAN:*\n"
            . "📋 *ID Pesanan:* {$pesanan->id_pesanan}\n"
            . "📅 *Tanggal Booking:* {$tanggalBooking}\n"
            . "📦 *Paket:* {$pesanan->nama_paket}\n\n"
            . "Pastikan Anda siap untuk check-in sesuai jadwal yang telah ditentukan.\n\n"
            . "Jika ada perubahan rencana, silakan hubungi kami segera.\n\n"
            . "📞 Customer Service: 0812-3456-7890\n"
            . '📍 Lokasi: Atap Ciater, Subang';

        return $message;
    }

    /**
     * Mask nomor telepon untuk logging (privasi)
     */
    private function maskPhoneNumber(string $phone): string
    {
        if (strlen($phone) < 10) {
            return '***' . substr($phone, -4);
        }
        return substr($phone, 0, 4) . '****' . substr($phone, -4);
    }
}
