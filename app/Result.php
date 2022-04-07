<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    //
    protected $fillable = [
        'user_id', 'question_id', 'summarie_id','answer',
        'variant','question_number','date','result',
        'num_ques','qu_an','str_right','pict' ,'right','an_user'
    ];

}

