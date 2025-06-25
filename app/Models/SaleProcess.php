<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Testing\Constraints\SoftDeletedInDatabase;

class SaleProcess extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "sale_process";
    protected $primaryKey = "prop_id";


    protected $casts = [
        'prop_price' => 'double',
        'advance' => 'double',
        'commission' => 'double'
    ];

    public function getPropPriceAttribute($value)
    {
        return (double) str_replace(',', '', $value);
    }

    public function getAdvanceAttribute($value)
    {
        return (double) str_replace(',', '', $value);
    }

    public function getCommissionAttribute($value)
    {
        return (double) str_replace(',', '', $value);
    }
}
