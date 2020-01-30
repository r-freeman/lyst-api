<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListModel extends Model
{
    protected $table = 'lists';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
