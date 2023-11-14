<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class packet extends Model
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

    protected $table = 'packets';


    public $fillable = [
        'zone_id',
        'categories_id',
        'partner_id',
        'province_id',
        'available_id',
        'price_id',
        'different_prices_for_tourists',
        'title_idn',
        'title_en',
        'short_description_idn',
        'short_description_en',
        'description_idn',
        'description_en',
        'min_ticket',
        'max_ticket',
        'length_of_vacation',
        'status',
        'slug',
        'tag',
        'updated_by',
        'created_by',
    ];
    
    public function allPacketImage()
    {
        return $this->hasMany(packetImage::class,'packet_id','id');
    }
    public function packetImage()
    {
        return $this->hasOne(packetImage::class,'packet_id','id')->orderBy('position','asc');
    }
    public function packetTourDetail()
    {
        return $this->hasMany(packetTourDetail::class,'packet_id','id');
    }
    public function packetPrice()
    {
        return $this->hasOne(packetPrice::class,'id','price_id');
    }
    public function packetScheduleTour()
    {
        return $this->hasMany(packetScheduleTour::class,'packet_id','id')->orderBy('text','asc');
    }
    public function partner()
    {
        return $this->hasOne(partners::class,'id','partner_id');
    }
    public function packetRating()
    {
        return $this->hasMany(packetRatingReview::class,'packet_id','id')->select('packet_id','ratings');
    }

}
