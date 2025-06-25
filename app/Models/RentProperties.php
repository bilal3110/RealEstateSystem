<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentProperties extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "rent_prop";
    protected $primaryKey = "seller_id";

    public function getDemandAttribute($value)
    {
        return is_numeric($value) ? number_format((float) $value, 0) : 0;
    }

    protected $casts = [
        'prop_img' => 'array',
    ];
    
}

