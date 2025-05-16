<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkingExperienceModel extends Model
{
    use HasFactory;
    protected $table = 'working_experience';

    protected $fillable = [
        'company_name',
        'position',
        'industry',
        'job_description',
        'achievement',
        'software_tools',
        'start_date',
        'end_date'
    ];
}
