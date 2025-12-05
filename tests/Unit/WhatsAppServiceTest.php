<?php

namespace Tests\Unit;

use App\Services\WhatsAppService;
use PHPUnit\Framework\TestCase;

class WhatsAppServiceTest extends TestCase
{
    private WhatsAppService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new WhatsAppService();
    }

    /**
     * Test phone number formatting dengan berbagai input format
     */
    public function test_format_phone_number_with_leading_zero()
    {
        $result = $this->service->formatPhoneNumber('081234567890');
        $this->assertEquals('6281234567890', $result);
    }

    public function test_format_phone_number_with_62()
    {
        $result = $this->service->formatPhoneNumber('6281234567890');
        $this->assertEquals('6281234567890', $result);
    }

    public function test_format_phone_number_with_spaces_and_dashes()
    {
        $result = $this->service->formatPhoneNumber('08 1234-567890');
        $this->assertEquals('6281234567890', $result);
    }

    public function test_format_phone_number_without_leading_zero()
    {
        $result = $this->service->formatPhoneNumber('81234567890');
        $this->assertEquals('6281234567890', $result);
    }

    /**
     * Test configuration check
     */
    public function test_is_configured_returns_boolean()
    {
        $result = $this->service->isConfigured();
        $this->assertIsBool($result);
    }

    /**
     * Test that service is properly initialized
     */
    public function test_service_can_be_instantiated()
    {
        $service = new WhatsAppService();
        $this->assertInstanceOf(WhatsAppService::class, $service);
    }

    /**
     * Test message type methods exist
     */
    public function test_send_booking_notification_method_exists()
    {
        $this->assertTrue(method_exists($this->service, 'sendBookingNotification'));
    }

    public function test_send_confirmation_notification_method_exists()
    {
        $this->assertTrue(method_exists($this->service, 'sendConfirmationNotification'));
    }

    public function test_send_cancellation_notification_method_exists()
    {
        $this->assertTrue(method_exists($this->service, 'sendCancellationNotification'));
    }

    public function test_send_reminder_notification_method_exists()
    {
        $this->assertTrue(method_exists($this->service, 'sendReminderNotification'));
    }
}
