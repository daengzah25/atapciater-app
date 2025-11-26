<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - Atap Ciater</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --text: #333333;
            --border: #e0e0e0;
            --success: #388e3c;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #2e7d32, #1b5e20);
            color: var(--text);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .receipt-container {
            max-width: 500px;
            width: 100%;
        }

        .receipt-card {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--primary-light);
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: var(--success);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 2rem;
        }

        .receipt-title {
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        .receipt-subtitle {
            color: #666;
            font-size: 0.9rem;
        }

        .info-section {
            margin-bottom: 2rem;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border);
        }

        .info-label {
            font-weight: 500;
            color: #666;
        }

        .info-value {
            font-weight: 600;
            text-align: right;
        }

        .detail-section {
            background: var(--light-bg);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .detail-title {
            color: var(--primary-dark);
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .addon-detail {
            padding-left: 1rem;
            font-size: 0.9rem;
            color: #666;
        }

        .total-section {
            background: var(--primary-light);
            color: white;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
        }

        .total-label {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }

        .total-amount {
            font-size: 2rem;
            font-weight: bold;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 1rem;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            text-align: center;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-whatsapp {
            background: #25D366;
            color: white;
        }

        .btn-whatsapp:hover {
            background: #128C7E;
        }

        .btn-secondary {
            background: var(--light-bg);
            color: var(--text);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: #e9ecef;
        }

        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-menunggu {
            background: #fff3cd;
            color: #856404;
        }

        .status-dikonfirmasi {
            background: #d1edff;
            color: #0c5460;
        }

        @media (max-width: 480px) {
            .action-buttons {
                grid-template-columns: 1fr;
            }

            .receipt-card {
                padding: 1.5rem;
            }
        }

        .whatsapp-notification {
            background: #f0f9f0;
            border: 1px solid #25D366;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            grid-column: 1 / -1;
        }

        .whatsapp-notification i {
            margin-bottom: 0.5rem;
        }

        .whatsapp-notification p {
            margin: 0;
            color: #25D366;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <div class="receipt-card">
            <div class="receipt-header">
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h1 class="receipt-title">Booking Berhasil!</h1>
                <p class="receipt-subtitle">Terima kasih telah memesan di Atap Ciater</p>
            </div>

            <div class="info-section">
                <div class="info-item">
                    <span class="info-label">ID Pesanan</span>
                    <span class="info-value">{{ $pesanan->id_pesanan }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Nama Pemesan</span>
                    <span class="info-value">{{ $pesanan->nama_pemesan }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tanggal Booking</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($pesanan->tanggal_booking)->format('d F Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">No. WhatsApp</span>
                    <span class="info-value">{{ $pesanan->no_wa }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status</span>
                    <span class="info-value">
                        <span class="status-badge status-{{ str_replace('_', '-', $pesanan->status) }}">
                            {{ ucwords(str_replace('_', ' ', $pesanan->status)) }}
                        </span>
                    </span>
                </div>
            </div>

            <div class="detail-section">
                <h3 class="detail-title">Detail Pesanan</h3>

                <div class="detail-item">
                    <span>{{ $pesanan->nama_paket }}</span>
                    <span>Rp {{ number_format($pesanan->harga_paket, 0, ',', '.') }}</span>
                </div>

                @foreach($pesanan->detailPesanan as $detail)
                <div class="detail-item addon-detail">
                    <span>{{ $detail->nama_addons }} (x{{ $detail->jumlah }})</span>
                    <span>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                </div>
                @endforeach
                
                <!-- Tambahkan informasi total full dan sisa bayar untuk DP -->
                @php
                $totalFull = $pesanan->harga_paket;
                foreach($pesanan->detailPesanan as $detail) {
                $totalFull += $detail->subtotal;
                }
                @endphp

                @if($pesanan->metode_bayar == 'dp_50%')
                <div class="detail-item" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border);">
                    <span><strong>Total Harga:</strong></span>
                    <span><strong>Rp {{ number_format($totalFull, 0, ',', '.') }}</strong></span>
                </div>
                <div class="detail-item">
                    <span>DP 50% yang Dibayar:</span>
                    <span>Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                </div>
                <div class="detail-item">
                    <span>Sisa Pembayaran:</span>
                    <span>Rp {{ number_format($totalFull - $pesanan->total, 0, ',', '.') }}</span>
                </div>
                <div class="detail-item" style="color: #666; font-size: 0.9rem;">
                    <span><em>Catatan: Sisa pembayaran dapat dilunasi di tempat saat check-in</em></span>
                </div>
                @endif

                <div class="detail-item" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border);">
                    <span><strong>Metode Bayar</strong></span>
                    <span><strong>{{ $pesanan->metode_bayar == 'dp_50%' ? 'DP 50%' : 'Lunas' }}</strong></span>
                </div>
            </div>

            <div class="total-section">
                <div class="total-label">Total Pembayaran</div>
                <div class="total-amount">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</div>
            </div>

            <div class="action-buttons">
                <div class="whatsapp-notification">
                    <i class="fab fa-whatsapp" style="color: #25D366; font-size: 1.5rem;"></i>
                    <p>Notifikasi WhatsApp telah dikirim otomatis ke nomor Anda</p>
                </div>
                <a href="{{ route('landing.page') }}" class="btn btn-secondary">
                    <i class="fas fa-home"></i> Kembali ke Home
                </a>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk kirim ke WhatsApp
        function sendToWhatsApp() {
            // Data dasar dari PHP
            const idPesanan = '{{ $pesanan->id_pesanan }}';
            const namaPemesan = '{{ $pesanan->nama_pemesan }}';
            const namaPaket = '{{ $pesanan->nama_paket }}';
            const tanggalBooking = '{{ \Carbon\Carbon::parse($pesanan->tanggal_booking)->translatedFormat("d F Y") }}';
            const metodeBayar = '{{ $pesanan->metode_bayar == "dp_50%" ? "DP 50%" : "Lunas" }}';
            const total = '{{ number_format($pesanan->total, 0, ",", ".") }}';

            // Addons text - generate dengan PHP sepenuhnya
            let addonsText = '';
            <?php
            if ($pesanan->detailPesanan && count($pesanan->detailPesanan) > 0) {
                echo "addonsText = '\\n\\n*Tambahan:*\\n';";
                foreach ($pesanan->detailPesanan as $detail) {
                    $addonLine = "- {$detail->nama_addons} (x{$detail->jumlah}): Rp " . number_format($detail->subtotal, 0, ',', '.');
                    echo "addonsText += '" . addslashes($addonLine) . "\\n';";
                }
            }
            ?>

            // Buat pesan WhatsApp
            const message = `Halo, saya telah melakukan booking di *Atap Ciater* dengan detail berikut:

*ID Pesanan:* ${idPesanan}
*Nama Pemesan:* ${namaPemesan}
*Paket:* ${namaPaket}
*Tanggal Booking:* ${tanggalBooking}
*Metode Bayar:* ${metodeBayar}${addonsText}

*Total Pembayaran:* Rp ${total}

Terima kasih.`;

            // Format nomor WhatsApp
            const rawPhone = '{{ $pesanan->no_wa }}'.replace(/\D/g, '');
            let phoneNumber;

            if (rawPhone.startsWith('0')) {
                phoneNumber = '62' + rawPhone.substring(1);
            } else if (rawPhone.startsWith('62')) {
                phoneNumber = rawPhone;
            } else {
                phoneNumber = '62' + rawPhone;
            }

            // Encode message untuk URL
            const encodedMessage = encodeURIComponent(message);
            const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;

            // Buka WhatsApp
            window.open(whatsappUrl, '_blank');
        }

        // Event listener untuk tombol WhatsApp
        document.getElementById('whatsapp-btn').addEventListener('click', function(e) {
            e.preventDefault();
            sendToWhatsApp();
        });

        // Auto-scroll ke atas setelah load
        window.scrollTo(0, 0);
    </script>
</body>

</html>