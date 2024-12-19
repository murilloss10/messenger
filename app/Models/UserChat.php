<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo as MongoDB_BelongsTo;

class UserChat extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * @var string
     */
    protected $collection = 'user_chats';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'chat_id',
    ];

    /**
     * Relacionamento com o model User.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relacionamento com o model Chat.
     * 
     * @return \MongoDB\Laravel\Relations\BelongsTo
     */
    public function chat(): MongoDB_BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
