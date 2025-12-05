# WhatsApp API Fonnte - Quick Reference Guide

## 🎯 Perubahan Utama

### 1. Struktur Baru
```
app/Services/WhatsAppService.php  ← NEW: Service class terpusat untuk semua operasi WhatsApp
app/Http/Controllers/CustomerController.php  ← UPDATED: Gunakan WhatsAppService
app/Http/Controllers/AdminController.php  ← UPDATED: Gunakan WhatsAppService
tests/Unit/WhatsAppServiceTest.php  ← NEW: Unit tests
```

### 2. Fitur Baru
- ✅ **Retry Mechanism**: Automatic retry hingga 3x jika ada koneksi error
- ✅ **Smart Backoff**: Delay 1 detik antar retry untuk avoid rate limiting
- ✅ **Comprehensive Logging**: Detailed logs dengan emoji prefix untuk easy scanning
- ✅ **Privacy**: Phone number di-mask di logs
- ✅ **Multiple Message Types**: 4 tipe pesan (booking, confirmation, cancellation, reminder)
- ✅ **Timeout Configuration**: API timeout 30 detik (lebih stabil)

---

## 📝 Cara Menggunakan

### Kirim Booking Notification (saat customer submit booking)
```php
use App\Services\WhatsAppService;

// Di CustomerController->submitBooking()
$whatsAppService = new WhatsAppService();
$whatsAppService->sendBookingNotification($pesanan, $detailAddons);
```

### Kirim Confirmation Notification (saat admin konfirmasi)
```php
use App\Services\WhatsAppService;

// Di AdminController->updateStatusPesanan()
$whatsAppService = new WhatsAppService();
$whatsAppService->sendConfirmationNotification($pesanan);
```

### Kirim Cancellation Notification
```php
use App\Services\WhatsAppService;

$whatsAppService = new WhatsAppService();
$whatsAppService->sendCancellationNotification($pesanan, 'Alasan pembatalan di sini');
```

### Kirim Reminder Notification (future: untuk scheduled job)
```php
use App\Services\WhatsAppService;

$whatsAppService = new WhatsAppService();
$whatsAppService->sendReminderNotification($pesanan);
```

### Check apakah WhatsApp API dikonfigurasi
```php
$whatsAppService = new WhatsAppService();

if ($whatsAppService->isConfigured()) {
    // API sudah dikonfigurasi, kirim pesan
    $whatsAppService->sendBookingNotification($pesanan, $detailAddons);
} else {
    // API belum dikonfigurasi, skip
    Log::warning('WhatsApp API belum dikonfigurasi');
}
```

---

## 🔧 Configuration

Pastikan `.env` sudah ter-set:
```env
FONNTE_API_TOKEN=your_token_here
```

Untuk mendapatkan token:
1. Buka https://fonnte.com
2. Login ke dashboard
3. Generate API token
4. Copy token ke `.env`

---

## 📊 Logging Output

### Success Case
```
[2025-12-05 10:30:45] production.INFO: Mengirim WhatsApp via Fonnte (Attempt 1/3):
[2025-12-05 10:30:46] production.INFO: ✅ WhatsApp berhasil dikirim via Fonnte
  - pesanan_id: 123456
  - type: booking
  - message_id: msg_1234567890
```

### Retry Case (Server Error)
```
[2025-12-05 10:30:45] production.INFO: Mengirim WhatsApp via Fonnte (Attempt 1/3):
[2025-12-05 10:30:46] production.WARNING: ⚠️ Fonnte API error, akan retry: Server error
[2025-12-05 10:30:47] production.INFO: Mengirim WhatsApp via Fonnte (Attempt 2/3):
[2025-12-05 10:30:48] production.INFO: ✅ WhatsApp berhasil dikirim via Fonnte
```

### Failure Case
```
[2025-12-05 10:30:45] production.INFO: Mengirim WhatsApp via Fonnte (Attempt 1/3):
[2025-12-05 10:30:46] production.ERROR: ❌ Fonnte API error (tidak di-retry): Invalid token
  - pesanan_id: 123456
  - status_code: 401
```

---

## 🚨 Troubleshooting

### Problem: WhatsApp tidak terkirim
**Debug:**
1. Check logs: `tail -f storage/logs/laravel.log`
2. Cari entries dengan "❌" untuk error messages
3. Pastikan `.env` sudah punya `FONNTE_API_TOKEN`

### Problem: Retry terus terjadi
**Solusi:**
- Check network connectivity
- Verify Fonnte API status
- Coba increase `API_TIMEOUT` (di WhatsAppService)

### Problem: Token invalid
**Solusi:**
- Verify token di Fonnte dashboard
- Regenerate token jika perlu
- Update `.env` dengan token baru

---

## 📚 API Reference

### WhatsAppService Methods

| Method | Return | Purpose |
|--------|--------|---------|
| `sendBookingNotification($pesanan, $detailAddons)` | bool | Kirim notifikasi booking |
| `sendConfirmationNotification($pesanan)` | bool | Kirim notifikasi konfirmasi |
| `sendCancellationNotification($pesanan, $reason)` | bool | Kirim notifikasi pembatalan |
| `sendReminderNotification($pesanan)` | bool | Kirim pengingat booking |
| `isConfigured()` | bool | Cek apakah API dikonfigurasi |
| `formatPhoneNumber($phone)` | string | Format nomor ke format 62 |

---

## 🔄 Constants

Semua config di `app/Services/WhatsAppService.php`:

```php
const MAX_RETRIES = 3;              // Max retry attempts
const RETRY_DELAY = 1;              // Delay antar retry (detik)
const API_TIMEOUT = 30;             // API request timeout (detik)
const API_BASE_URL = 'https://api.fonnte.com/send';
```

Untuk mengubah config, edit constant di class (atau pindahkan ke `.env` jika ingin flexible).

---

## ✅ Validation

### Sebelum Production
- [ ] `.env` sudah punya `FONNTE_API_TOKEN` yang valid
- [ ] Test send booking notification ke test customer
- [ ] Test send confirmation notification
- [ ] Check logs untuk "✅ WhatsApp berhasil dikirim"
- [ ] Run unit tests: `php artisan test tests/Unit/WhatsAppServiceTest.php`

---

## 🎓 Examples

### Example 1: Manual Test di Tinker
```bash
php artisan tinker

$service = new App\Services\WhatsAppService();
$service->formatPhoneNumber('081234567890');  // Output: 6281234567890
$service->isConfigured();  // Output: true/false
```

### Example 2: Send ke specific pesanan
```php
$pesanan = Pesanan::find(123456);
$whatsAppService = new WhatsAppService();
$result = $whatsAppService->sendConfirmationNotification($pesanan);
// $result adalah bool: true (sukses) atau false (gagal)
```

### Example 3: Check before sending
```php
$whatsAppService = new WhatsAppService();

if (!$whatsAppService->isConfigured()) {
    return response()->json(['error' => 'WhatsApp not configured'], 500);
}

$whatsAppService->sendBookingNotification($pesanan, $detailAddons);
```

---

## 📞 Support

Jika ada issue:
1. Check logs di `storage/logs/laravel.log`
2. Verify `.env` configuration
3. Test dengan Tinker: `php artisan tinker`
4. Contact Fonnte support untuk API-related issues

---

**Last Updated**: 5 Desember 2025  
**Version**: 1.0.0
