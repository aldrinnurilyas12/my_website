<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectsModel extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'project_name',
        'description',
        'category_id',
        'github_link',
        'start_date',
        'end_date',
        'project_status',
        'tools'

    ];
}
