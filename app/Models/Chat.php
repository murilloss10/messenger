<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasMany;

class Chat extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'chats';

    protected $fillable = [
        'participants',
        'last_message',
        'created_at',
        'updated_at',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
