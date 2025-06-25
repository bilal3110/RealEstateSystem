<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'investment';
    protected $primaryKey = 'invest_id';

    protected $fillable = [
        'prop_title',
        'prop_area',
        'prop_loc',
        'seller_name',
        'seller_contact',
        'seller_cnic',
        'buying_price',
        'my_investment',
        'my_equity',
        'is_sold',
        'prop_img',
        'prop_desc'
    ];

    protected $casts = [
        'buying_price' => 'double',
        'my_investment' => 'double',
        'my_equity' => 'double'
    ];


    public function setBuyingPriceAttribute($value)
    {
        $this->attributes['buying_price'] = (double) str_replace(',', '', $value);
    }
    
    public function setMyInvestmentAttribute($value)
    {
        $this->attributes['my_investment'] = (double) str_replace(',', '', $value);
    }
    

    public function buyer()
    {
        return $this->hasOne(InvestDisposed::class, 'investment_id', 'invest_id');
    }

}
