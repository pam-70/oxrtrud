<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model

{
    protected $fillable = [
        'quest', 'number', 'drawing', 'view', 'answer',
    ];
    public function answers()
    {
      return $this->hasMany('App\Answer');
    }
    //
}
