# Full Cash di Tempat - Payment Method Feature

**Status**: ✅ COMPLETED  
**Date**: December 5, 2025  
**Feature**: Hide Payment Info & Upload Section untuk "Full Cash di Tempat"

---

## 📋 Summary

Ketika customer memilih metode pembayaran **"Full Cash di Tempat"**, sistem akan:
1. ✅ **Sembunyikan** bagian "Informasi Pembayaran" (Bank Info)
2. ✅ **Sembunyikan** bagian "Upload Bukti Pembayaran"
3. ✅ **Izinkan** customer untuk konfirmasi booking tanpa upload bukti
4. ✅ **Tetap tampilkan** untuk metode pembayaran lain (DP 50% dan Lunas)

---

## 🔧 Technical Implementation

### 1. Frontend Changes (booking.blade.php)

#### JavaScript Function: `togglePaymentSection()`
```javascript
function togglePaymentSection() {
    const metodeBayar = document.querySelector('input[name="metode_bayar"]:checked');
    const bankInfoSection = document.getElementById('bank-info-section');
    const paymentInfoTitle = document.getElementById('payment-info-title');
    const screenshotSection = document.getElementById('screenshot-section');
    const screenshotInput = document.getElementById('screenshot');
    const screenshotLabel = document.getElementById('screenshot-label');
    const requiredAsterisk = document.getElementById('required-asterisk');

    if (metodeBayar && metodeBayar.value === 'full_cash_on_site') {
        // Hide semua payment info untuk cash on site
        bankInfoSection.style.display = 'none';
        paymentInfoTitle.style.display = 'none';
        screenshotSection.style.display = 'none';
        
        // Make screenshot optional
        screenshotInput.removeAttribute('required');
        requiredAsterisk.style.display = 'none';
        screenshotLabel.textContent = 'Upload Bukti Pembayaran (Opsional)';
    } else {
        // Show semua payment info untuk metode lain
        bankInfoSection.style.display = 'block';
        paymentInfoTitle.style.display = 'block';
        screenshotSection.style.display = 'block';
        
        // Make screenshot required
        screenshotInput.setAttribute('required', 'required');
        requiredAsterisk.style.display = 'inline';
        screenshotLabel.textContent = 'Upload Bukti Pembayaran';
    }
}
```

**Positioning**: Line ~1663 in booking.blade.php

#### Event Listeners
- **Payment change event**: Panggil `togglePaymentSection()` saat radio button berubah
- **Page load**: Panggil `togglePaymentSection()` pada saat page initialized (line ~1799)

#### Form Validation Update
```javascript
// Screenshot validation - hanya jika bukan full_cash_on_site
if (metodeBayar.value !== 'full_cash_on_site') {
    if (!screenshot) {
        alert('Bukti Pembayaran harus diupload!');
        screenshotInput.focus();
        return false;
    }
    // Validasi ukuran dan tipe file
    if (screenshot.size > 2 * 1024 * 1024) {
        alert('Ukuran file tidak boleh lebih dari 2MB!');
        return false;
    }
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!allowedTypes.includes(screenshot.type)) {
        alert('Format file harus JPG atau PNG!');
        return false;
    }
}
```

---

### 2. Backend Changes (CustomerController.php)

```php
// Screenshot hanya required jika bukan full_cash_on_site
$screenshotRule = $request->metode_bayar === 'full_cash_on_site' ? 'nullable' : 'required';

$validated = $request->validate([
    'screenshot' => $screenshotRule . '|image|mimes:jpeg,png,jpg|max:2048',
    // ... field lainnya
]);
```

**File**: `app/Http/Controllers/CustomerController.php` (line ~83)

---

## 📊 UX Flow

### Scenario 1: Customer memilih "DP 50%" atau "Lunas"
```
Payment Method Selected
    ↓
Show: Informasi Pembayaran (Bank info)
Show: Upload Bukti Pembayaran (Required)
Show: * (Required asterisk)
Enable: Konfirmasi Booking (hanya jika screenshot diupload)
```

### Scenario 2: Customer memilih "Full Cash di Tempat"
```
Payment Method Selected
    ↓
Hide: Informasi Pembayaran (Bank info)
Hide: Upload Bukti Pembayaran
Hide: * (Required asterisk)
Show: Total Pembayaran (masih menampilkan total)
Enable: Konfirmasi Booking (tanpa perlu screenshot)
```

---

## ✅ Testing Checklist

- [x] Open booking form
- [x] Select "DP 50%": Verifikasi bank info dan upload section MUNCUL
- [x] Select "Lunas": Verifikasi bank info dan upload section MUNCUL
- [x] Select "Full Cash di Tempat": Verifikasi bank info dan upload section HILANG
- [x] Coba submit booking "Full Cash di Tempat" tanpa upload screenshot: BERHASIL
- [x] Coba submit booking "DP 50%" tanpa upload screenshot: GAGAL (required)
- [x] Coba submit booking "Lunas" tanpa upload screenshot: GAGAL (required)
- [x] Verifikasi WhatsApp message untuk "Full Cash di Tempat": Tampil pesan tentang bayar di tempat
- [x] Verifikasi database: `metode_bayar = 'full_cash_on_site'`, `total = 0`, `screenshot = NULL`

---

## 📝 Files Modified

1. **resources/views/customer/booking.blade.php**
   - Updated `togglePaymentSection()` function (lines ~1663-1693)
   - Updated form validation logic (lines ~1738-1755)
   - Removed duplicate file validation code (lines ~1768-1782)
   - Added `togglePaymentSection()` call on initialization (line ~1799)

2. **app/Http/Controllers/CustomerController.php**
   - Already has `$screenshotRule` logic (line ~83)
   - Validation already supports optional screenshot for `full_cash_on_site`

---

## 🎨 Visual Changes

### Before Selection
```
┌─────────────────────────────────────┐
│ Metode Pembayaran                   │
├─────────────────────────────────────┤
│ ○ DP 50%        ○ Lunas  ○ Full Cash│
└─────────────────────────────────────┘

(Default: Informasi Pembayaran HIDDEN, Upload HIDDEN)
```

### After DP 50% or Lunas Selected
```
┌─────────────────────────────────────┐
│ Informasi Pembayaran                │
├─────────────────────────────────────┤
│ [Bank Info Card]                    │
│                                     │
│ Upload Bukti Pembayaran *           │
│ [File Upload Area]                  │
└─────────────────────────────────────┘
```

### After Full Cash di Tempat Selected
```
┌─────────────────────────────────────┐
│ [Bank Info HIDDEN]                  │
│                                     │
│ [Upload Section HIDDEN]             │
│                                     │
│ Total Pembayaran: Rp [TOTAL]        │
│                                     │
│ [Konfirmasi Booking Button]         │
└─────────────────────────────────────┘
```

---

## 📱 Responsive Design

- ✅ Mobile: Sections hide/show correctly
- ✅ Tablet: Layout maintains consistency
- ✅ Desktop: Full visibility control works

---

## 🔗 Integration Points

### WhatsApp API Message
WhatsAppService sudah handle formatting untuk metode ini:
- Message type: "Full Cash di Tempat"
- Display text: "Bayar 100% di Tempat"
- Special note: "Pembayaran penuh akan dilakukan di lokasi saat check-in"

### Database
```sql
pesanan table:
- metode_bayar = 'full_cash_on_site'
- total = 0
- screenshot = NULL (jika tidak diupload)
```

---

## 🚀 Deployment

1. **No migration required** - Metode sudah di database enum
2. **Clear cache**: `php artisan config:clear && php artisan cache:clear`
3. **Test**: Lakukan booking dengan setiap metode
4. **Monitor**: Cek WhatsApp messages dan database entries

---

## 💡 Future Enhancements

- [ ] Add admin dashboard indicator untuk "Cash on Site" pesanan
- [ ] Add special handling saat check-in untuk collect cash
- [ ] Add SMS reminder before check-in untuk metode ini
- [ ] Add payment receipt generation saat check-in selesai

---

**Status**: Production Ready ✅
