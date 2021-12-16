<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'site', 'site_url', 'memo',
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
