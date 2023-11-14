<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aboutUs extends Model
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

    protected $table = 'about_us';

    public $fillable = [
        // 'office_hours_id',
        // 'company_members_id',
        // 'achievement_id',
        'name',
        'nation',
        'email',
        'mobile_phone',
        'whatsapp',
        'twitter',
        'facebook',
        'instagram',
        'youtube',
        'linkedln',
        'address',
        'latitude',
        'longitude',
        'iframe_google_maps',
        'website',
        'playstore',
        'appstore',
        'file',
        'title_idn',
        'title_en',
        'short_description_idn',
        'short_description_en',
        'description_idn',
        'description_en',
        'since',
        'logo',
        'logo_white',
        'favicon',
        'favicon_white',
        'status',
        'created_by',
        'updated_by',
    ];

    public function officeHours()
    {
        return $this->hasMany(officeHours::class,'about_us_id','id');
    }
}
