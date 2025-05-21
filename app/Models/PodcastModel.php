<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PodcastModel extends Model
{
    use HasFactory;

    protected $table = 'podcast';
    protected $fillable = [
        'podcast_code',
        'podcast_title',
        'podcast_subtitle',
        'media_files',
        'podcast_banner',
        'podcast_category'
    ];
}
