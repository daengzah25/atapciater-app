# WhatsApp Fonnte Quick Fixes

Jika WhatsApp tidak terkirim, coba solusi di bawah ini secara berurutan.

## ❌ WhatsApp Tidak Terkirim?

### Fix 1: Clear Laravel Cache (99% Success Rate)
```bash
cd /home/daeng/Projects/atap-ciater
php artisan config:clear
php artisan cache:clear
```

✅ **Paling sering berhasil** - Cache lama mencegah token dibaca

---

### Fix 2: Verify Token in .env
```bash
grep FONNTE_API_TOKEN .env
```

Expected: `FONNTE_API_TOKEN=dD2vsDdk5k3LXTXqCC5N` (atau token lainnya)

If missing or `your_fonnte_api_token_here`:
1. Update `.env` dengan token yang benar
2. Run Fix 1 (clear cache)

---

### Fix 3: Test Configuration
```bash
php test-fontte.php
```

Expected output: `✅ WhatsAppService is properly configured!`

If FAILED:
- Check `.env` FONNTE_API_TOKEN
- Run Fix 1 (clear cache)

---

### Fix 4: Send Test Message
```bash
php test-send-message.php 081234567890 "Test"
```

Expected: `✅ Message sent successfully!`

If FAILED:
- Check phone number format
- Check Fonnte balance
- Check internet connection

---

### Fix 5: Check Logs
```bash
tail -50 storage/logs/laravel.log | grep -i whatsapp
```

Look for:
- `✅ WhatsApp berhasil dikirim` = SUCCESS
- `❌ Fonnte API error` = Check error message
- `⚠️ akan retry` = Retry happening

---

## 🆘 Still Not Working?

Run complete diagnostic:
```bash
# 1. Clear everything
php artisan config:clear && php artisan cache:clear

# 2. Test config
php test-fontte.php

# 3. Test API
php test-send-message.php 081234567890 "Diagnostic Test"

# 4. Check logs
tail -100 storage/logs/laravel.log | grep -i "fonnte\|whatsapp"

# 5. If still failed, check Fonnte dashboard
echo "Go to: https://fonnte.com/dashboard"
```

---

## 📝 Common Fixes Reference

| Problem | Solution | Command |
|---------|----------|---------|
| Config not updated | Clear cache | `php artisan config:clear` |
| Token not working | Verify in .env | `grep FONNTE_API_TOKEN .env` |
| API timeout | Check internet | `ping 8.8.8.8` |
| Rate limited | Wait 5 mins | Re-run test after |
| Balance 0 | Top up Fonnte | Visit fonnte.com |

---

**Quick Link**: See full guide in `WHATSAPP_DEBUGGING_GUIDE.md`
