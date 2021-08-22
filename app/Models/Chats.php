<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chats extends Model
{
    use HasFactory;
    protected $table = 'user_chats';
    protected $primaryKey = 'chat_id';

    
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    protected $fillable = [
        'chat_people',
       
    
    ];
}
