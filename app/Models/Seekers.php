<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seekers extends Model
{
    use HasFactory;
    protected $table = "seekers";
    protected $fillable = [
        'name',
        'contact',
        'preferred_location',
        'area',
        'budget',
        'type',
        'status',
        'description',
    ];
}
