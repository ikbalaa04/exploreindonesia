<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class requestTrip extends Model
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

    protected $table = 'request_trips';

    public $fillable = [
        'user_id',
        'destination_request',
        'departure_date',
        'duration_trip',
        'number_of_participant',
        'currency',
        'budget_trip',
        'note',
        'status',
        'approval',
        'first_name',
        'last_name',
        'email',
        'code_phone',
        'phone_number',
        'hear_about_us',
    ];

}
