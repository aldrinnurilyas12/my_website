<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilePictureModel extends Model
{
    use HasFactory;

    protected $table = 'profile';
    protected $fillable = [
        'profile_img',
        'bio'
    ];
}
