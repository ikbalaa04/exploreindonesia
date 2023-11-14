<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class packetScheduleTour extends Model
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

    protected $table = 'packet_schedule_tours';


    public $fillable = [
        'packet_id',
        'text',
        'stop',
    ];

    public function packetScheduleTourDetail()
    {
        return $this->hasMany(packetScheduleTourDetail::class,'packet_schedule_tour_id','id');
    }
    

}
