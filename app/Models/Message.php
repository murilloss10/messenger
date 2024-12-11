<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class Message extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'messages';

    public $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'chat_id',
        'sender',
        'content',
        'viewed_by',
        'received_by',
        'created_at',
        'updated_at',
    ];

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
