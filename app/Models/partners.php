<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class partners extends Model
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
    
    protected $table = 'partners';
    public $fillable = [
        'zone_id',
        'name',
        'file',
        'background',
        'pic',
        'mobile_phone',
        'email',
        'address',
        'about',
        'account_chat',
        'website',
        'region',
        'position',
        'status',
        'created_by',
        'updated_by',
    ];

    public function members()
    {
        return $this->hasMany(User::class,'partner_id','id')->select('name','email','partner_id','id');
    }
}
