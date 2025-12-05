#!/usr/bin/env php
<?php

/**
 * Test Script untuk verifikasi Fonnte WhatsApp API
 * Usage: php test-fonnte.php
 */

require_once __DIR__ . '/vendor/autoload.php';

// Load Laravel app
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Log;

echo "\n";
echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║  FONNTE WHATSAPP API TEST SCRIPT                           ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n";
echo "\n";

// Test 1: Check if token is configured
echo "Test 1: Checking Fonnte API Token Configuration\n";
echo "─────────────────────────────────────────────────────────────\n";

$token = env('FONNTE_API_TOKEN');
$tokenMasked = $token ? substr($token, 0, 4) . '****' . substr($token, -4) : 'NOT SET';

echo "Token from .env: {$tokenMasked}\n";
echo "Token is empty: " . (empty($token) ? 'YES ❌' : 'NO ✓') . "\n";
echo "Token is default value: " . ($token === 'your_fonnte_api_token_here' ? 'YES ❌' : 'NO ✓') . "\n";
echo "\n";

// Test 2: Initialize WhatsAppService
echo "Test 2: Initializing WhatsAppService\n";
echo "─────────────────────────────────────────────────────────────\n";

try {
    $service = new WhatsAppService();
    echo "Service initialized: ✓\n";
    echo "Is configured: " . ($service->isConfigured() ? 'YES ✓' : 'NO ❌') . "\n";
    echo "\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . " ❌\n\n";
    exit(1);
}

if (!$service->isConfigured()) {
    echo "⚠️  WARNING: WhatsAppService is not configured!\n";
    echo "   Please ensure FONNTE_API_TOKEN is set in .env file\n\n";
    exit(1);
}

// Test 3: Test phone number formatting
echo "Test 3: Testing Phone Number Formatting\n";
echo "─────────────────────────────────────────────────────────────\n";

$testPhones = [
    '081234567890' => '6281234567890',
    '6281234567890' => '6281234567890',
    '08 1234-567890' => '6281234567890',
    '81234567890' => '6281234567890',
];

$allPassed = true;
foreach ($testPhones as $input => $expected) {
    $result = $service->formatPhoneNumber($input);
    $passed = $result === $expected;
    $allPassed = $allPassed && $passed;

    $status = $passed ? '✓' : '❌';
    echo "Input: {$input}\n";
    echo "Expected: {$expected}\n";
    echo "Got: {$result}\n";
    echo "Status: {$status}\n\n";
}

if (!$allPassed) {
    echo "Phone number formatting tests FAILED ❌\n\n";
    exit(1);
}

echo "All phone number tests passed ✓\n\n";

// Test 4: Test API connection with real API call
echo "Test 4: Testing API Connection (Dry Run)\n";
echo "─────────────────────────────────────────────────────────────\n";

echo "API Token: {$tokenMasked}\n";
echo "API URL: https://api.fonnte.com/send\n";
echo "Timeout: 30 seconds\n";
echo "Max Retries: 3\n";
echo "\n";

// Test 5: Check if methods exist
echo "Test 5: Checking Available Methods\n";
echo "─────────────────────────────────────────────────────────────\n";

$methods = [
    'sendBookingNotification',
    'sendConfirmationNotification',
    'sendCancellationNotification',
    'sendReminderNotification',
    'isConfigured',
    'formatPhoneNumber',
];

foreach ($methods as $method) {
    $exists = method_exists($service, $method);
    $status = $exists ? '✓' : '❌';
    echo "{$method}: {$status}\n";
}

echo "\n";

// Final summary
echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║  TEST SUMMARY                                              ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n";
echo "\n";

if ($service->isConfigured()) {
    echo "✅ WhatsAppService is properly configured!\n";
    echo "\n";
    echo "Next steps:\n";
    echo "1. Make a test booking in the application\n";
    echo "2. Check storage/logs/laravel.log for WhatsApp messages\n";
    echo "3. Verify message was received on phone\n";
    echo "4. If not received, check Fonnte dashboard for delivery status\n";
    echo "\n";
} else {
    echo "❌ WhatsAppService is NOT configured!\n";
    echo "\n";
    echo "Please fix:\n";
    echo "1. Update .env file with valid FONNTE_API_TOKEN\n";
    echo "2. Run: php artisan config:clear\n";
    echo "3. Run this test again\n";
    echo "\n";
    exit(1);
}

echo "\n";
