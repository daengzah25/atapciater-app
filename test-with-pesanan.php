#!/usr/bin/env php
<?php

/**
 * Test Send WhatsApp Message dengan Pesanan dari Database
 * Usage: php test-with-pesanan.php <id_pesanan>
 * Example: php test-with-pesanan.php 123456
 */

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\Pesanan;
use App\Services\WhatsAppService;

echo "\n";
echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║  TEST SEND WHATSAPP WITH PESANAN DATA                      ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n";
echo "\n";

$pesananId = $argv[1] ?? null;

if (!$pesananId) {
    echo "Usage: php test-with-pesanan.php <id_pesanan>\n";
    echo "Example: php test-with-pesanan.php 123456\n\n";

    // Show available pesanan
    $pesanans = Pesanan::limit(5)->get();
    if ($pesanans->isNotEmpty()) {
        echo "Available Pesanan IDs:\n";
        foreach ($pesanans as $p) {
            echo "  - {$p->id_pesanan} ({$p->nama_pemesan})\n";
        }
    } else {
        echo "No pesanan found in database\n";
    }
    echo "\n";
    exit(1);
}

// Find pesanan
$pesanan = Pesanan::where('id_pesanan', $pesananId)->first();

if (!$pesanan) {
    echo "❌ Pesanan not found with ID: {$pesananId}\n\n";
    exit(1);
}

echo "Found Pesanan:\n";
echo "ID: {$pesanan->id_pesanan}\n";
echo "Name: {$pesanan->nama_pemesan}\n";
echo "Phone: {$pesanan->no_wa}\n";
echo "Status: {$pesanan->status}\n";
echo "Created: {$pesanan->tanggal_pesan}\n";
echo "\n";

// Initialize service
$service = new WhatsAppService();

if (!$service->isConfigured()) {
    echo "❌ WhatsAppService is not configured!\n\n";
    exit(1);
}

echo "WhatsAppService: ✓ Configured\n\n";

// Get detail addons
$detailAddons = [];
if ($pesanan->detailPesanan) {
    foreach ($pesanan->detailPesanan as $detail) {
        $detailAddons[] = [
            'nama' => $detail->nama_addons,
            'jumlah' => $detail->jumlah,
            'subtotal' => $detail->subtotal,
        ];
    }
}

echo "Sending messages...\n";
echo "─────────────────────────────────────────────────────────────\n\n";

// Test 1: Send booking notification
echo "Test 1: Sending Booking Notification\n";
try {
    $result = $service->sendBookingNotification($pesanan, $detailAddons);
    echo "Result: " . ($result ? '✓ SUCCESS' : '❌ FAILED') . "\n\n";
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n\n";
}

// Test 2: Send confirmation notification
echo "Test 2: Sending Confirmation Notification\n";
try {
    $result = $service->sendConfirmationNotification($pesanan);
    echo "Result: " . ($result ? '✓ SUCCESS' : '❌ FAILED') . "\n\n";
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n\n";
}

// Test 3: Send reminder notification
echo "Test 3: Sending Reminder Notification\n";
try {
    $result = $service->sendReminderNotification($pesanan);
    echo "Result: " . ($result ? '✓ SUCCESS' : '❌ FAILED') . "\n\n";
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n\n";
}

echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║  DONE                                                      ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n";
echo "\n";
echo "Check storage/logs/laravel.log for detailed logs\n";
echo "Example: tail -50 storage/logs/laravel.log\n";
echo "\n";
