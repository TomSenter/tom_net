<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Friends extends Model
{
    use HasFactory;
    protected $table = 'user_friends';
   

    // mark when deleted rather than fully delete
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'friends',     
    ];
}
