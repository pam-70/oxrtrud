<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function edittest(Request $request)
    {
        
        $quest_numer = Question::find($request->numer_post);

        // echo ($flight1->quest . "<br>");
        $answer = Question::find($quest_numer->id)->answers;
        $addradio = 0;
        foreach ($answer  as $answer_id) {
            if ($answer_id->right == 1) {
                $addradio = $answer_id->id;
            }
            // echo $flight->answer . "<br>";
        }

        $url_dat = [
            'url_answer' => $answer,
            "url_question" => $quest_numer->quest,
            "url_addradio" => $addradio,
        ];
        //echo
        return ($url_dat);
    }
    public function addanswer(Request $request)
    {

        if ($request->id_test > 0) {
            $question_id = Answer::find($request->id_test);
            Answer::where("question_id", $question_id->question_id)
                ->update([
                    "right" => 0
                ]);

            Answer::where("id", $request->id_test)
                ->update([
                    "right" => 1
                ]);
            $recorded = "Записано!";
        } else {
            $recorded = "";
        }

        $url_dat = [
            'url_answer' => $request->id_test,
            "url_recorded" => $recorded,
        ];
        //echo
        return ($url_dat);
    }
}
