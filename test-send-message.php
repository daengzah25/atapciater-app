#!/usr/bin/env php
<?php

/**
 * Direct Fonnte API Test - Send actual message
 * Usage: php test-send-message.php <phone_number> <message>
 * Example: php test-send-message.php 081234567890 "Test message"
 */

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

echo "\n";
echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║  FONNTE API DIRECT TEST - SEND MESSAGE                     ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n";
echo "\n";

// Parse arguments
$phone = $argv[1] ?? null;
$message = $argv[2] ?? 'Test message dari Atap Ciater';

if (!$phone) {
    echo "Usage: php test-send-message.php <phone_number> [message]\n";
    echo "Example: php test-send-message.php 6281234567890 'Test message'\n\n";
    exit(1);
}

// Format phone number
$phone = preg_replace('/[^0-9]/', '', $phone);
if (substr($phone, 0, 1) === '0') {
    $phone = '62' . substr($phone, 1);
}

echo "Input Phone: " . $argv[1] . "\n";
echo "Formatted Phone: {$phone}\n";
echo "Message: {$message}\n\n";

// Get token
$token = env('FONNTE_API_TOKEN');
if (!$token || $token === 'your_fonnte_api_token_here') {
    echo "❌ ERROR: FONNTE_API_TOKEN not configured in .env\n\n";
    exit(1);
}

echo "Token: " . substr($token, 0, 4) . '****' . substr($token, -4) . "\n";
echo "\n";

// Send message
echo "Sending message...\n";
echo "─────────────────────────────────────────────────────────────\n";

try {
    $response = Http::withHeaders([
        'Authorization' => $token,
    ])
        ->timeout(30)
        ->asForm()
        ->post('https://api.fonnte.com/send', [
            'target' => $phone,
            'message' => $message,
            'delay' => '2',
            'countryCode' => '62',
        ]);

    echo "Status Code: " . $response->status() . "\n";
    echo "Response:\n";

    $responseData = $response->json();
    echo json_encode($responseData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    echo "\n";

    if ($response->successful() && isset($responseData['status']) && $responseData['status'] === true) {
        echo "✅ Message sent successfully!\n";
        echo "Message ID: " . ($responseData['data']['id_message'] ?? 'N/A') . "\n";
        echo "\nCheck your WhatsApp for the message.\n";
    } else {
        echo "❌ Failed to send message\n";
        echo "Reason: " . ($responseData['reason'] ?? 'Unknown error') . "\n";
        exit(1);
    }
} catch (\Exception $e) {
    echo "❌ Exception occurred:\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    exit(1);
}

echo "\n";
