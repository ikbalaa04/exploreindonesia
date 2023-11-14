<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class banners extends Model
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
    protected $table = 'banners';
    public $fillable = [
        'white_label',
        'status',
        'created_by',
        'updated_by',
    ];

    public function bannerFile()
    {
        return $this->hasOne(bannerFile::class,'banner_id','id');
    }
}
