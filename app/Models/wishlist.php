<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class wishlist extends Model
{
    use HasFactory;
    protected static function boot() {
        parent::boot();
        static::creating(function ($model) {
            if ( ! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
    public function getIncrementing()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }

    protected $table = 'wishlists';


    public $fillable = [
        'user_id',
        'packet_id',
    ];

    public function packet()
    {
        return $this->hasOne(packet::class,'id','packet_id')->select('id','categories_id','partner_id','price_id','title_idn','title_en','slug','short_description_idn','short_description_en');
    }
}
