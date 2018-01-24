<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $statuses = [
        'объявление остановлено',
        'объявление запущено',
        'объявление удалено'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function getDayLimitAttribute()
    {
        return $this->attributes['day_limit'] == 0 ? 'Не задан' : $this->attributes['day_limit'];
    }

    public function getCpmAttribute()
    {
        return $this->attributes['cpm'] > 0 ? $this->attributes['cpm'] / 100 : 0;
    }

    public function getStatusAttribute()
    {
        return $this->statuses[$this->attributes['status']];
    }
}
