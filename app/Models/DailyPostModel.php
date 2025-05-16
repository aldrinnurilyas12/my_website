<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class DailyPostModel extends Model
{
    use HasFactory;
    protected $table = 'daily_post';

    protected $fillable = [
        'post'
    ];
}
