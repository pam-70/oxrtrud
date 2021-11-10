<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result_answer extends Model
{
    //
    protected $fillable = [
        'result_id', 'answer_id', 'right', 'answer_user', 'string_answer',
    ];



}
