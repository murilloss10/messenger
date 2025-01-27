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
        protected string $chat_id,
        protected ?string $message
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $chat = Chat::select('id', 'last_message')->where('_id', $this->chat_id)->first();
        $chat->last_message = $this->message;
        $chat->save();
    }
}
