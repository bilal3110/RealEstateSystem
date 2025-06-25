<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spendings extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'spendings';
    protected $primaryKey = 's_id';
    protected $fillable = ['s_name','s_amount','s_description'];

    public function getSAmountAttribute($value){
        return number_format($value);
    }
}
