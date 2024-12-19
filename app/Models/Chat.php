<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasMany;

class Chat extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * @var string
     */
    protected $collection = 'chats';

    /**
     * @var array
     */
    protected $fillable = [
        'participants',
        'last_message',
        'created_at',
        'updated_at',
    ];

    /**
     * Relacionamento com o model Message.
     * 
     * @return \MongoDB\Laravel\Relations\HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Relacionamento com o model UserChat.
     * 
     * @return \MongoDB\Laravel\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(UserChat::class, 'chat_id', 'id');
    }
}
