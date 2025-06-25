<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessDetails extends Model
{
    use HasFactory;

    protected $table = "business_details";
    protected $primaryKey = "id";

    protected $fillable = [
        'company_name',
        'logo',
    ];
}
