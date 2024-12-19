<?php

namespace App\Jobs;

use App\Models\Chat;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class MessageNotification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Chat $chat
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
