<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Result;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //exp_txt
    public function exptxt(Request $request)
    {
        //exptxt.txt
        $all_quest = Question::all();


        $exptxt = fopen("exptxt.txt", 'w') or die("не удалось открыть файл");
        $sob="@@";
        
        fwrite($exptxt, $sob);
       // fwrite($exptxt, "\r\n");
       // echo ("@ <br>");
        foreach ($all_quest as $on_quest) {
            fwrite($exptxt, $on_quest->quest);
           // echo ($on_quest->quest . "<br>");

            $all_answ = Question::find($on_quest->id)->answers;
            foreach ($all_answ as $on_answ) {
                $dfr=substr($on_answ->answer , -2);
                $aser=$on_answ->right."=".$on_answ->answer ;
               // echo ( $on_answ->right . "<br>");

               // $aser=$dfr."-".$on_answ->right;
                fwrite($exptxt, $aser );
              //  echo ($on_answ->answer . "=" . $on_answ->right . "<br>");
            }
           // echo ("@ <br>");
            fwrite($exptxt, $sob);
           // fwrite($exptxt, "\r\n");
        }
        fclose($exptxt);
        $ttt=file('exptxt.txt');


dd($ttt);

        dd($all_quest);
    }



    public function addtxt(Request $request)
    { //biletot.txt
        $bilet = file('biletot.txt');
        $v = 1;
        $x = 1;
        foreach ($bilet as $bilet_srt) {

            if ($v == 0) {

                echo (substr($bilet_srt, 3) . "  @Сам вопрос <br> строка = " . $x);
                $x++;
            }
            if ($v == 1 and $bilet_srt != "\r\n") {
                echo (substr($bilet_srt, 3) . "  @Сам ответ<br>  строка = " . $x);
            }
            if ($bilet_srt == "\r\n") {
                $v = 0;
            } else {
                $v = 1;
            }
        }
        dd($bilet);





        echo ("Route::match(['get', 'post'], '/add_answer', ['as' => 'add_answer', 'uses' => 'AdminController@addanswer']);//addtxt");
    }
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
