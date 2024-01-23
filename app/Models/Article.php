<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Article extends Model
{

    protected $fillable = [
        'ad_soyad',
        'telefon',
        'mail',
        'ziyaret_tarihi',
        'ziyaret_amaci',
        'ziyaret_gerceklesme_tarihi',
        'iadeyi_ziyaret_durumu',
        'iadeyi_ziyaret_tarihi',
        'slug',
        'category_id', // category_id sütunu eklendi
        'updated_at',
        'created_at',
    ];
    use SoftDeletes;


}
