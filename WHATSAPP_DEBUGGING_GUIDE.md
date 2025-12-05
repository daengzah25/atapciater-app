# WhatsApp Fonnte API - Debugging Guide

## 🔍 Masalah: WhatsApp Tidak Terkirim

Jika WhatsApp tidak terkirim, ikuti langkah-langkah debugging ini:

---

## 📋 Step 1: Verify Configuration

### Check .env File
```bash
grep FONNTE_API_TOKEN /home/daeng/Projects/atap-ciater/.env
```

**Expected Output:**
```
FONNTE_API_TOKEN=dD2vsDdk5k3LXTXqCC5N
```

**If NOT set or default value:**
1. Open `.env` file
2. Add/Update: `FONNTE_API_TOKEN=your_actual_token`
3. Save file
4. Run: `php artisan config:clear`

### Verify Token is Valid
- Login to Fonnte dashboard: https://fonnte.com
- Check if token is active and not expired
- If expired, regenerate new token and update `.env`

---

## 🧪 Step 2: Run Configuration Test

```bash
cd /home/daeng/Projects/atap-ciater
php test-fonnte.php
```

**Expected Output:**
```
✅ WhatsAppService is properly configured!
```

**If ERROR:**
- Token not configured
- Check Step 1 again
- Clear cache: `php artisan config:clear && php artisan cache:clear`

---

## 📤 Step 3: Test Direct API Call

Test sending message directly to Fonnte API:

```bash
php test-send-message.php 081234567890 "Test message"
```

**Expected Output:**
```
✅ Message sent successfully!
Message ID: msg_1234567890
```

**Possible Errors:**

### Error 1: Invalid Token
```json
{
  "status": false,
  "reason": "Invalid token"
}
```
**Solution:** Verify token in `.env` and Fonnte dashboard

### Error 2: Invalid Phone Number
```json
{
  "status": false,
  "reason": "Invalid phone number format"
}
```
**Solution:** Use format `6281234567890` or `081234567890`

### Error 3: Rate Limit
```json
{
  "status": false,
  "reason": "Rate limit exceeded"
}
```
**Solution:** Wait a few minutes before sending again

### Error 4: Network Timeout
```
Connection timeout
```
**Solution:** Check internet connection, Fonnte server might be down

---

## 💾 Step 4: Check with Real Pesanan

If direct API test works, test with actual pesanan from database:

```bash
# Show available pesanan
php test-with-pesanan.php

# Test with specific pesanan
php test-with-pesanan.php 123456
```

**Expected Output:**
```
✓ SUCCESS
```

---

## 📝 Step 5: Check Logs

View logs for detailed error information:

```bash
# View last 100 lines
tail -100 storage/logs/laravel.log

# Filter WhatsApp/Fonnte logs
tail -100 storage/logs/laravel.log | grep -i "whatsapp\|fonnte"

# Follow logs in real-time
tail -f storage/logs/laravel.log | grep -i "whatsapp\|fonnte"
```

### Log Format Examples

**Success Log:**
```
[2025-12-05 14:30:45] local.INFO: Mengirim WhatsApp via Fonnte (Attempt 1/3):
[2025-12-05 14:30:46] local.INFO: ✅ WhatsApp berhasil dikirim via Fonnte
```

**Error Log:**
```
[2025-12-05 14:30:45] local.WARNING: ⚠️ Fonnte API error, akan retry: Connection timeout
[2025-12-05 14:30:47] local.INFO: Mengirim WhatsApp via Fonnte (Attempt 2/3):
```

**Configuration Error:**
```
[2025-12-05 14:30:45] local.WARNING: Fonnte tidak dikonfigurasi. Plewati pengiriman WhatsApp.
```

---

## 🔧 Common Issues & Solutions

### Issue 1: "Fonnte tidak dikonfigurasi"

**Cause:** Token not set or cache not cleared

**Solution:**
```bash
# 1. Verify .env
cat .env | grep FONNTE_API_TOKEN

# 2. Clear cache
php artisan config:clear
php artisan cache:clear

# 3. Test again
php test-fontte.php
```

### Issue 2: Message Not Received on Phone

**Possible Causes:**
1. Phone number format wrong
2. Fonnte account has no credits
3. Fonnte account suspended
4. Phone number not in Fonnte whitelist

**Solutions:**
1. Check phone format: Should be `62` + number without leading 0
2. Check Fonnte dashboard: Balance > 0
3. Check Fonnte account status: https://fonnte.com/dashboard
4. Add phone to whitelist (if in sandbox mode)

### Issue 3: Retry Keeps Happening

**Logs:**
```
⚠️ Attempt 1 failed... will retry
⚠️ Attempt 2 failed... will retry
⚠️ Attempt 3 failed...
```

**Possible Causes:**
1. Network/Internet issue
2. Fonnte server down
3. Too many requests (rate limited)

**Solutions:**
```bash
# Check network
ping 8.8.8.8

# Check Fonnte status
# Visit: https://status.fonnte.com

# Wait and try again later
```

### Issue 4: Token Invalid

**Error:**
```json
{
  "status": false,
  "reason": "Invalid token"
}
```

**Solution:**
1. Login to Fonnte: https://fonnte.com
2. Go to Dashboard → API Settings
3. Generate new token
4. Update `.env`: `FONNTE_API_TOKEN=new_token`
5. Clear cache: `php artisan config:clear`

---

## 🚀 Manual Test Flow

### Complete Debug Flow

```bash
# 1. Clear cache
php artisan config:clear && php artisan cache:clear

# 2. Verify configuration
php test-fontte.php

# 3. Test direct API call
php test-send-message.php 081234567890 "Test"

# 4. Check logs
tail -20 storage/logs/laravel.log | grep -i fonnte

# 5. If all passed, make real booking from web interface
# Then check logs again:
tail -f storage/logs/laravel.log | grep -i whatsapp
```

---

## 💡 Pro Tips

### Enable Debug Mode
In `.env`:
```env
APP_DEBUG=true
LOG_LEVEL=debug
```

This will provide more detailed logs.

### Monitor Logs in Real-time
```bash
# In one terminal, follow logs
tail -f storage/logs/laravel.log

# In another terminal, trigger booking
# Then watch logs appear in real-time
```

### Test with Custom Message
```bash
php test-send-message.php 6281234567890 "Halo, ini test dari Atap Ciater!"
```

### Validate Phone Number Format
```php
$phone = '081234567890';
$phone = preg_replace('/[^0-9]/', '', $phone);

if (substr($phone, 0, 1) === '0') {
    $phone = '62' . substr($phone, 1);
}

echo $phone; // Output: 6281234567890
```

---

## 📞 Escalation Path

If still not working:

### 1. Check Fonnte Support
- Website: https://fonnte.com
- Dashboard: https://fonnte.com/dashboard
- Support: Check "Help" section in dashboard

### 2. Verify Logs
- Export logs for analysis: `cat storage/logs/laravel.log > debug.log`
- Look for specific error messages
- Search by date/time of failed booking

### 3. Test Outside Application
- Use Fonnte API directly: `php test-send-message.php`
- This isolates whether issue is in application or Fonnte

### 4. Check Application Logs
```bash
# Search for all errors in last 24 hours
grep "ERROR\|Exception" storage/logs/laravel.log | tail -50

# Get full context around errors
grep -B 5 -A 5 "Fonnte API error" storage/logs/laravel.log
```

---

## ✅ Final Verification

Once you've done all fixes, verify:

```bash
# 1. Configuration test
php test-fonnte.php
# Should show: ✅ WhatsAppService is properly configured!

# 2. Send message test
php test-send-message.php YOUR_PHONE "Test"
# Should show: ✅ Message sent successfully!

# 3. Make test booking
# Go to web interface → Make booking
# Check if receive WhatsApp

# 4. Monitor logs
tail -20 storage/logs/laravel.log | grep -i "whatsapp\|✅"
# Should show: ✅ WhatsApp berhasil dikirim
```

---

## 📊 Troubleshooting Decision Tree

```
WhatsApp tidak terkirim?
│
├─ Test config: php test-fonnte.php
│  ├─ ❌ Not configured → Update .env → Clear cache
│  └─ ✓ Configured → Next
│
├─ Test direct API: php test-send-message.php
│  ├─ ❌ Failed → Check token, phone format, network
│  └─ ✓ Success → Next
│
├─ Check phone received?
│  ├─ ❌ Not received → Check Fonnte balance, rate limit
│  └─ ✓ Received → System working!
│
├─ If still failed → Check logs
│  ├─ grep "FONNTE_API_TOKEN tidak" → Configure token
│  ├─ grep "Invalid phone" → Fix phone format
│  ├─ grep "rate limit" → Wait and retry
│  └─ grep other errors → Search documentation
```

---

**Last Updated**: 5 Desember 2025  
**Version**: 1.0.0
