<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    //
    protected $fillable = [
        'user_id', 'date', 'result','numer',
    ];
    public function results()
    {
      return $this->hasMany('App\Result','summarie_id','id');
    }
}
