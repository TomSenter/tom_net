<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Messages extends Model
{
    use HasFactory;
    protected $table = 'user_messages';
    protected $primaryKey = 'message_id';


    
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    protected $fillable = [
        'chat_id',
        'message_content',
        'sender',
        'receiver',
        'read'
    
    ];
}
