<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Daily_posts_images extends Model
{
    use HasFactory;

    protected $table = 'daily_posts_images';
    protected $fillable = [
        'posts_id',
        'posts_img'
    ];
}
