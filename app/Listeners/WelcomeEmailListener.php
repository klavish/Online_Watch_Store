<?php

namespace App\Listeners;

use App\Events\WelcomeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WelcomeEmailListener implements shouldQueue
{
    public $queue = 'listener';
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WelcomeEvent $event): void
    {
        $user = $event->user;
        $emaildata = [
            'subject' => 'Welcome to Ekart Store',
            'body' => 'Hello All Welcome to my Store',
            'tagline' => 'Purchase any product you need.'
        ];
        Mail::to((string) $user->email)
        ->send(new WelcomeEmail($emailData));
    }
}
