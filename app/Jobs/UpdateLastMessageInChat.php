<?php

namespace App\Jobs;

use App\Models\Chat;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateLastMessageInChat implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Chat $chat,
        protected ?string $message
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->chat->last_message = $this->message;
        $this->chat->save();
    }
}
