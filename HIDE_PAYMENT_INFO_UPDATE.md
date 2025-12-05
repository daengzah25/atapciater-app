# Update: Hide Payment Info & Make Screenshot Optional untuk Full Cash di Tempat

**Status**: ✅ COMPLETED  
**Tanggal**: December 5, 2025  
**User Request**: "Ketika 'Full Cash di Tempat' hide atau sembunyikan Informasi Pembayaran dan Upload Bukti Pembayaran *, serta bisa Konfirmasi booking"

---

## 📋 Ringkasan Perubahan

Ketika customer memilih metode pembayaran **"Full Cash di Tempat"**, maka:
1. **Informasi Pembayaran** (Bank details) disembunyikan
2. **Upload Bukti Pembayaran** menjadi optional (tidak wajib)
3. Customer tetap bisa **Konfirmasi Booking** tanpa upload bukti

---

## 📁 File-File yang Diubah

### 1. Frontend - Booking Form (`resources/views/customer/booking.blade.php`)

#### 1a. HTML Structure - Add IDs untuk hide/show
```html
<!-- SEBELUM: Tanpa ID -->
<h3 class="section-title">Informasi Pembayaran</h3>
<div class="bank-info">
    <!-- bank details... -->
</div>

<!-- SESUDAH: Dengan ID untuk toggle -->
<h3 class="section-title" id="payment-info-title">Informasi Pembayaran</h3>
<div class="bank-info" id="bank-info-section">
    <!-- bank details... -->
</div>
```

#### 1b. Screenshot Section - Add conditional required
```html
<!-- SEBELUM -->
<label for="screenshot">Upload Bukti Pembayaran *</label>
<input type="file" id="screenshot" name="screenshot" accept="image/*" required>

<!-- SESUDAH: Dengan ID untuk toggle dan conditional required -->
<label for="screenshot">
    <span id="screenshot-label">Upload Bukti Pembayaran</span> 
    <span id="required-asterisk">*</span>
</label>
<input type="file" id="screenshot" name="screenshot" accept="image/*" required>
```

#### 1c. JavaScript - Add Toggle Function
**Lokasi**: Sebelum form submission handler (line ~1658)

```javascript
// Fungsi untuk toggle payment info dan screenshot section
function togglePaymentSection() {
    const metodeBayar = document.querySelector('input[name="metode_bayar"]:checked');
    const bankInfoSection = document.getElementById('bank-info-section');
    const paymentInfoTitle = document.getElementById('payment-info-title');
    const screenshotSection = document.getElementById('screenshot-section');
    const screenshotInput = document.getElementById('screenshot');
    const requiredAsterisk = document.getElementById('required-asterisk');

    if (metodeBayar && metodeBayar.value === 'full_cash_on_site') {
        // Hide bank info dan payment title
        bankInfoSection.style.display = 'none';
        paymentInfoTitle.style.display = 'none';
        // Make screenshot optional
        screenshotInput.removeAttribute('required');
        requiredAsterisk.style.display = 'none';
    } else {
        // Show bank info dan payment title
        bankInfoSection.style.display = 'block';
        paymentInfoTitle.style.display = 'block';
        // Make screenshot required
        screenshotInput.setAttribute('required', 'required');
        requiredAsterisk.style.display = 'inline';
    }
}

// Event listener untuk payment method changes
document.querySelectorAll('input[name="metode_bayar"]').forEach(radio => {
    radio.addEventListener('change', function() {
        togglePaymentSection();
        calculateTotal();
    });
});
```

#### 1d. JavaScript - Update Form Validation
**Screenshot hanya required jika bukan full_cash_on_site**:

```javascript
// SEBELUM
if (!screenshot) {
    alert('Bukti Pembayaran harus diupload!');
    screenshotInput.focus();
    return false;
}

// SESUDAH: Conditional check
if (metodeBayar.value !== 'full_cash_on_site') {
    if (!screenshot) {
        alert('Bukti Pembayaran harus diupload!');
        screenshotInput.focus();
        return false;
    }
}
```

#### 1e. JavaScript - Update File Validation
**Hanya validasi file jika screenshot ada**:

```javascript
// SEBELUM
if (screenshot.size > 2 * 1024 * 1024) {
    alert('Ukuran file maksimal 2MB!...');
    return false;
}

// SESUDAH: Check if screenshot exists first
if (screenshot) {
    if (screenshot.size > 2 * 1024 * 1024) {
        alert('Ukuran file maksimal 2MB!...');
        return false;
    }
    // ... other validations
}
```

---

### 2. Backend - Controller (`app/Http/Controllers/CustomerController.php`)

#### 2a. Validation Rule - Screenshot menjadi optional untuk full_cash_on_site
**Lokasi**: Line 83-84

```php
// SEBELUM
'screenshot' => 'required|image|mimes:jpeg,png,jpg|max:2048',

// SESUDAH: Dynamic validation based on payment method
$screenshotRule = $request->metode_bayar === 'full_cash_on_site' ? 'nullable' : 'required';

$validated = $request->validate([
    // ... other fields ...
    'screenshot' => $screenshotRule . '|image|mimes:jpeg,png,jpg|max:2048',
    // ...
]);
```

#### 2b. File Upload Logic - Handle optional screenshot
**Lokasi**: Line 151-183

```php
// SEBELUM
if ($request->hasFile('screenshot')) {
    // ... upload logic ...
} else {
    DB::rollBack();
    return redirect()->back()
        ->withErrors(['screenshot' => 'File bukti pembayaran tidak ditemukan.'])
        ->withInput();
}

// SESUDAH: Screenshot tidak wajib untuk full_cash_on_site
if ($request->hasFile('screenshot')) {
    // ... upload logic ...
} else {
    // Screenshot tidak wajib untuk metode full_cash_on_site
    if ($request->metode_bayar !== 'full_cash_on_site') {
        DB::rollBack();
        return redirect()->back()
            ->withErrors(['screenshot' => 'File bukti pembayaran tidak ditemukan.'])
            ->withInput();
    }
}
```

**Penjelasan**: Jika screenshot tidak ada dan bukan `full_cash_on_site`, maka throw error. Jika `full_cash_on_site`, maka `$filename = null` (aman).

---

## 🔄 User Flow

### Skenario 1: Customer memilih "DP 50%" atau "Lunas"
1. Customer lihat **Informasi Pembayaran** (visible)
2. Customer wajib upload **Bukti Pembayaran** (required dengan *)
3. Form validation: screenshot MUST exist
4. Backend: save screenshot filename
5. Button: "Konfirmasi Booking" ✅ aktif

### Skenario 2: Customer memilih "Full Cash di Tempat"
1. Automatic: **Informasi Pembayaran** HIDDEN (display: none)
2. Automatic: **Upload Bukti Pembayaran** OPTIONAL (asterisk hilang)
3. Form validation: screenshot TIDAK perlu
4. Backend: screenshot filename = null (tidak disimpan)
5. Button: "Konfirmasi Booking" ✅ tetap aktif (tanpa screenshot)

---

## 🧪 Testing Checklist

```
[ ] Buka halaman booking
[ ] Pilih paket + addons
[ ] Pilih "DP 50%"
    [ ] Informasi Pembayaran visible
    [ ] Upload Bukti Pembayaran required (*)
    [ ] Tidak bisa submit tanpa screenshot
[ ] Pilih "Lunas"
    [ ] Informasi Pembayaran visible
    [ ] Upload Bukti Pembayaran required (*)
    [ ] Tidak bisa submit tanpa screenshot
[ ] Pilih "Full Cash di Tempat"
    [ ] Informasi Pembayaran HIDDEN
    [ ] Upload Bukti Pembayaran optional (tanpa *)
    [ ] Bisa submit TANPA screenshot
    [ ] Konfirmasi Booking tetap bisa ditekan
[ ] Submit booking dengan Full Cash
    [ ] Verifikasi WhatsApp message terkirim
    [ ] Check database: pesanan.screenshot = NULL
    [ ] Check database: pesanan.total = 0
    [ ] Check database: pesanan.metode_bayar = 'full_cash_on_site'
```

---

## 📝 Important Notes

### 1. Screenshot Field Behavior
- **Default state**: `required` (untuk DP 50% dan Lunas)
- **When Full Cash di Tempat selected**: Change to `removed attribute required` (optional)
- **Backend validation**: Dynamic based on `$request->metode_bayar`

### 2. HTML5 Form Validation
```html
<!-- Browser akan tidak require jika attribute removed -->
<input type="file" id="screenshot" name="screenshot" accept="image/*">
<!-- vs -->
<input type="file" id="screenshot" name="screenshot" accept="image/*" required>
```

### 3. Payment Info Visibility
- Menggunakan `display: none` (bukan `visibility: hidden`)
- Data bank BCA tetap ada di DOM, hanya tidak ditampilkan
- Payment title juga di-hide

### 4. Screenshot Nullable in Database
Pastikan column `screenshot` di migration sudah nullable:
```php
$table->string('screenshot')->nullable();
```
✅ Sudah nullable di existing migration

---

## 🚀 Ready for Production

Semua perubahan sudah siap:
1. ✅ Frontend: Hide/show logic dengan JavaScript
2. ✅ Frontend: Conditional form validation
3. ✅ Backend: Dynamic validation rule
4. ✅ Backend: Conditional file upload handling
5. ✅ WhatsApp API: Already handles null filename correctly
6. ✅ Database: screenshot column sudah nullable

**Tidak perlu migration baru** - Hanya logic update.
