# ⚡ QUICK START - Full Cash di Tempat Feature

## 🎯 Apa yang Berubah?

Ketika customer memilih **"Full Cash di Tempat"**:

| Aspect | DP 50% / Lunas | Full Cash di Tempat |
|--------|---|---|
| **Informasi Pembayaran** | ✅ Visible | ❌ Hidden |
| **Upload Bukti Pembayaran** | ✅ Required | ⏸️ Optional |
| **Asterisk (*)** | ✅ Shown | ❌ Hidden |
| **Konfirmasi Booking** | ✅ Allowed | ✅ Allowed |
| **Total Bayar** | ✅ Calculated | 0 (Bayar di tempat) |
| **Screenshot di DB** | ✅ Saved | ❌ NULL |

---

## 📝 User Experience

### Screenshot HIDDEN When Full Cash Selected
```
SEBELUM:
┌─────────────────────────┐
│ Informasi Pembayaran     │  ← ALWAYS VISIBLE
│ Bank BCA: 0551650072    │
│ Atas Nama: Ridwan       │
└─────────────────────────┘
┌─────────────────────────┐
│ Upload Bukti Pembayaran*│  ← ALWAYS REQUIRED
│ [Pilih File...]        │
└─────────────────────────┘
[Konfirmasi Booking]

SESUDAH (Full Cash dipilih):
┌─────────────────────────┐
│ ❌ HIDDEN               │  ← TIDAK TAMPIL
│                          │
└─────────────────────────┘
┌─────────────────────────┐
│ ❌ HIDDEN               │  ← TIDAK TAMPIL
│                          │
└─────────────────────────┘
[Konfirmasi Booking]  ← TETAP AKTIF
```

---

## 🔧 Technical Implementation

### Files Modified: 2

1. **`resources/views/customer/booking.blade.php`**
   - Add HTML IDs untuk targeting
   - Add JavaScript toggle function
   - Update form validation logic

2. **`app/Http/Controllers/CustomerController.php`**
   - Dynamic validation rule
   - Conditional file upload handling

### No Database Migration Needed ✅
- `screenshot` column already nullable
- `metode_bayar` enum already has `full_cash_on_site`

---

## 🧪 Quick Test

### Test 1: Select "DP 50%"
```
1. Buka booking form
2. Klik "DP 50%"
3. ✅ Informasi Pembayaran VISIBLE
4. ✅ Upload Bukti REQUIRED (*)
5. ✅ Try submit tanpa file → ERROR
```

### Test 2: Select "Full Cash di Tempat"
```
1. Klik "Full Cash di Tempat"
2. ✅ Informasi Pembayaran HIDDEN
3. ✅ Upload Bukti OPTIONAL (no *)
4. ✅ Try submit tanpa file → OK
5. ✅ Check DB: screenshot = NULL
```

---

## 💾 Database Check

### Before & After Comparison

**SEBELUM (DP 50% / Lunas)**
```sql
SELECT * FROM pesanan WHERE id_pesanan = 123456;
-- metode_bayar: dp_50%
-- total: 500000 (50% dari harga)
-- screenshot: bukti_123456_1234567890.jpg (NOT NULL)
```

**SESUDAH (Full Cash di Tempat)**
```sql
SELECT * FROM pesanan WHERE id_pesanan = 345678;
-- metode_bayar: full_cash_on_site
-- total: 0 (bayar nanti)
-- screenshot: NULL (optional)
```

---

## ✅ Verification Checklist

Run these to verify implementation:

```bash
# Check front-end changes
grep -n "togglePaymentSection\|bank-info-section" \
  resources/views/customer/booking.blade.php

# Check backend changes
grep -n "screenshotRule\|full_cash_on_site" \
  app/Http/Controllers/CustomerController.php

# Check database
php artisan tinker
>>> DB::table('pesanan')->where('metode_bayar', 'full_cash_on_site')->first();
```

---

## 🚀 Deploy Steps

```bash
# 1. Pull/merge changes
git pull

# 2. Clear caches
php artisan view:clear
php artisan config:clear
php artisan cache:clear

# 3. Test locally
# - Open booking form
# - Test all 3 payment methods
# - Verify hide/show behavior

# 4. Deploy to production
# No database migration needed!
```

---

## 📞 If Issues Occur

**Payment info not hiding?**
- Check browser DevTools → Elements tab
- Verify `togglePaymentSection()` function exists
- Check JavaScript console for errors

**Can't submit without screenshot for DP 50%?**
- This is CORRECT behavior
- Screenshot required for DP 50% and Lunas
- Only optional for Full Cash di Tempat

**Still see "Upload Bukti Pembayaran*" asterisk?**
- Hard refresh: Ctrl+Shift+R
- Clear browser cache
- Check CSS for asterisk display

---

## 🎓 For Developers

### Key Code Snippets

**Frontend - Toggle Function**
```javascript
function togglePaymentSection() {
    const metodeBayar = document.querySelector('input[name="metode_bayar"]:checked');
    const isFullCash = metodeBayar?.value === 'full_cash_on_site';
    
    // Hide/show payment info
    document.getElementById('bank-info-section').style.display = 
        isFullCash ? 'none' : 'block';
    
    // Make screenshot optional/required
    document.getElementById('screenshot').toggleAttribute('required', !isFullCash);
}
```

**Backend - Dynamic Validation**
```php
$screenshotRule = $request->metode_bayar === 'full_cash_on_site' 
    ? 'nullable' 
    : 'required';

$request->validate([
    'screenshot' => $screenshotRule . '|image|mimes:jpeg,png,jpg|max:2048'
]);
```

---

## 📋 Summary

✅ **Implemented**: Hide payment info & optional screenshot for Full Cash  
✅ **Tested**: All 3 payment methods verified  
✅ **Deployed**: Ready for production  
✅ **Documented**: Complete technical guide  

**Status**: 🟢 **PRODUCTION READY**
