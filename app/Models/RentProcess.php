<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Testing\Constraints\SoftDeletedInDatabase;

class RentProcess extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "rent_process";
    protected $primaryKey = "prop_id";

    protected $casts = [
        'prop_rent' => 'double',
        'advance' => 'double',
        'commision' => 'double'
    ];
    public function getPropRentAttribute($value)
    {
        return (double) str_replace(',', '', $value);
    }
    
    public function getAdvanceAttribute($value)
    {
        return (double) str_replace(',', '', $value);
    }
    
    public function getCommisionAttribute($value)
    {
        return (double) str_replace(',', '', $value);
    }
    
}
