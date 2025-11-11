<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\SnsPublisherService;

class SendUserToSNSListener
{
    /**
     * Create the event listener.
     */
    public function __construct(protected SnsPublisherService $snsPublisher)
    {}

    /**
     * Handle the event.
     */
    public function handle(UserCreatedEvent $event): void
    {
        $user = $event->user;

        $this->snsPublisher->publish("Welcome: $user->name", [
            'userId' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
