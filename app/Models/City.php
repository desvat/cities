<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';
    protected $primaryKey = 'city_id';

    protected $fillable = [
        'city_id',
        'city_type',
        'city_name',
        'city_mayor',
        'city_district',
        'city_county',
        'city_region',
        'city_address',
        'city_phone',
        'city_fax',
        'city_email',
        'city_web',
        'city_crest_img',
    ];

}
