<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class packetPrice extends Model
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

    protected $table = 'packet_prices';
    
    public $fillable = [
        'price_in_dollars',
        'price_in_rupiah',
        'price_tourist_in_dollars',
        'price_tourist_in_rupiah',
        'fee_in_dollars',
        'fee_in_rupiah',
        'discount_in_dollars',
        'discount_in_rupiah',
        'start_date',
        'end_date',
        'type',
    ];
}
