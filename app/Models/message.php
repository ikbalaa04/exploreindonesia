<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class message extends Model
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

    protected $table = 'messages';


    public $fillable = [
        'from_id',
        'recipient_id',
        'list_message_id',
        'message',
        'file',
        'status',
        'read_on',
        'reply_by',
        'first_chat',
    ];

    public function recipient()
    {
        return $this->hasOne(partners::class,'recipient_id','id');
    }

}
