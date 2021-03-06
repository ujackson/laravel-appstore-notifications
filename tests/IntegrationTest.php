<?php

namespace Appvise\AppStoreNotifications\Tests;

use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Route;
use Appvise\AppStoreNotifications\Model\AppleNotification;

class IntegrationTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Queue::fake();

        Route::post('/webhook/apple', "\Appvise\AppStoreNotifications\WebhooksController");

        config(
            [
                'appstore-server-notifications.jobs' => [
                    'initial_buy' => DummyJob::class,
                ],
                'appstore-server-notifications.shared_secret' => 'VALID_APPLE_PASSWORD',
                'appstore-server-notifications.bundle_id' => 'com.example.app.ios',
            ]
        );
    }

    /** @test */
    public function it_can_handle_a_valid_request()
    {
        $this->withExceptionHandling();
        $payload = include_once __DIR__ . '/__fixtures__/request.php';
        $payload['password'] = 'VALID_APPLE_PASSWORD';
        $payload['bid'] = 'com.example.app.ios';

        $this
            ->postJson('/webhook/apple', $payload)
            ->assertSuccessful();

        $this->assertCount(1, AppleNotification::get());

        $notification = AppleNotification::first();

        $this->assertEquals('initial_buy', $notification->type);
        $this->assertInstanceOf(AppleNotification::class, $notification);

        Queue::assertPushed(DummyJob::class);
    }

    /** @test */
    public function a_request_with_an_invalid_password_wont_be_logged()
    {
        $payload = include_once __DIR__ . '/__fixtures__/request.php';
        $payload['password'] = 'NON_VALID_APPLE_PASSWORD';

        $this
            ->postJson('/webhook/apple', $payload)
            ->assertStatus(500);

        $this->assertCount(0, AppleNotification::get());
        $this->assertNull(AppleNotification::first());

        Queue::assertNotPushed(DummyJob::class);
    }

    /** @test */
    public function a_request_with_an_invalid_payload_will_be_logged_but_jobs_will_not_be_dispatched()
    {
        $payload = ['payload' => 'INVALID'];

        $this
            ->postJson('/webhook/apple', $payload)
            ->assertStatus(500);

        Queue::assertNotPushed(DummyJob::class);
    }
}
