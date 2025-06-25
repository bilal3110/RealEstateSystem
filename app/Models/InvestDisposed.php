<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class InvestDisposed extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'buyer_id';
    protected $table = 'invest_disposed';

    protected $fillable = [
        'investment_id',
        'buyer_name',
        'buyer_contact',
        'buyer_cnic',
        'sell_price',
        'advance',
        'profit',
        'agreement'
    ];

    public function investment()
    {
        return $this->belongsTo(Investment::class, 'investment_id', 'invest_id');
    }

    public function setSellPriceAttribute($value)
    {
        $this->attributes['sell_price'] = (double) str_replace(',', '', $value);
    }

    public function setProfitAttribute($value)
    {
        $this->attributes['profit'] = (double) str_replace(',', '', $value);
    }

    public function setAdvanceAttribute($value)
    {
        $this->attributes['advance'] = (double) str_replace(',','', $value);
    }
}
