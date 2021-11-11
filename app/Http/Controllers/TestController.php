<?php

namespace App\Http\Controllers;

use Auth;
use App\Summary;
use App\Answer;
use App\Question;
use App\Installation;
use App\Result;
use App\Result_answer;
use Illuminate\Http\Request;


class TestController extends Controller
{
    //
    public function runtest(Request $request)
    {
        //echo (Auth::user()->id . "<br>");
        if ($request->isMethod('post')) {
            //выбираем номер задания

            if ($request->numer_testa == 0) {
                $task = "2021-01";
                if ($request->choice == "1") {
                    $task = "2021-01";
                }
                if ($request->choice == "2") {
                    $task = "2021-02";
                }

                $all_quests = Question::where("number", $task)
                    ->get();
                $arr_quest = [];
                foreach ($all_quests as $one_quest) {
                    $arr_quest[] = $one_quest->id;
                }
                shuffle($arr_quest);
                shuffle($arr_quest);
                $test_quest = [];
                $kol = 10;
                $kol = Installation::find(1);
                //запись в основную базу summarys
                $summars_id = Summary::create([
                    'user_id' => Auth::user()->id,
                ]);



                $all_quest = 1;
                for ($i = 0; $i < $kol->data; $i++) {
                    $test_quest[] = $arr_quest[$i];
                    $quests = Question::find($arr_quest[$i]); //добавляем id вопросов
                    //echo ($quests . "<br>");
                    //записываем вопросы
                    $resul_id = Result::create([
                        'user_id' => Auth::user()->id,
                        'question_id' => $quests->id,
                        'summarie_id' => $summars_id->id,

                        'variant' => $all_quest,
                        'question_number' => $quests->number,
                        'date' => date("Y-m-d"),
                    ]);
                    $all_quest++;
                    // echo($resul_id->id."<br>");

                    $answ = Question::find($arr_quest[$i])->answers;
                    foreach ($answ as $answer) {
                        Result_answer::create([
                            'result_id' => $resul_id->id,
                            'answer_id' => $answer->id,
                            'right' => $answer->right,
                            // 'answer_user'=>
                            'string_answer' => $answer->answer,
                        ]);
                        // echo ($answer->answer . "<br>");

                        # code...
                    }
                }
                $all_quest--; //Количество вопросов отправить на страницу
                $numer_testa = 1;
                $summar_id = $summars_id->id;
            } else {
                $numer_testa = $request->numer_testa; //номер вопроса теста
                $all_quest = $request->all_quest;
                $summar_id = $request->summar_id;
            }
            //если вопрос занесен в базу
            // делаем запрос на порядковый номер вопроса
            $odin_quest = Result::where('summarie_id', $numer_testa)
                ->where('variant', $summar_id)
                ->get();


            $url_dat = [
                'url_numer_testa' => $numer_testa,
                "url_all_quest" => $all_quest,
                "url_summar_id" => $summar_id,
                "url_odin_quest" => $odin_quest,

            ];

            return ($url_dat);
        } else { // Это гет запрос
           // $odin_quest = Result::where('summarie_id', 12)
            //    ->where('variant', 1)
            //    ->get();
            $odin_quest = Result::where('summarie_id', 12)
                ->where('variant', 1)
                ->get(); 
                foreach ($odin_quest as $odin_qu) {
                    # code...
                    $id_que=$odin_qu->question_id;
                }
              // $qq= Question::find($id_que);
             // Переделать на другую таблицу
               $qq= Question::find($id_que)->answers;
               echo($id_que);

            dd($qq);
        }



        //порядковый номер вопроса
        //$summar_id->id // отправить id деланных тестов
        //


        // $quests = Question::find(10)->answers;
        // $answer_zap = Answer::where('question_id', $test_quest)->get();
        //записать в основную базу summary нужен id пользователя
        //

        // foreach ($quests as $quest) {
        //   $quest_mal[]
        //   # code...
        //}


        //dd($quests);



    }
    // dd($quest_all);




    //ратотаем с текстовым файлом
    /*    $names = file('biletot.txt');
        $zx = 1;
        $questions = 1;
        foreach ($names as $string) {
            if ($string == "\r\n" or $string == "t\r\n") {
                echo ("PUSTO------------- <br>");
                $zx = 1;
            }
            $zx++;
            if ($zx > 3) {
                echo (substr($string, 3) . "<br>");
                $answer = Answer::create([
                    'question_id' => $questions->id,
                    'answer' => substr($string, 3),

                ]);
            } else {
                if ($string != "\r\n") {
                    $questions = Question::create([
                        'quest' =>  substr($string, 3),
                        'view' => "1",
                        "number" => "2021-01",
                    ]);




                    // echo ("VOPROS+++++" . substr($string, 3) . "<br>");
                }
            }
        }
        //fclose($names); */





    //dd($names);
    //$names="7777";
    // return view('native_partic',['name' => $names]);




    //------------------------------------------------
    // $listt = Listt::where('movement', "=", $zp)
    //  ->where('surname', 'like', $request->filtersurname . '%')
    //  ->orderBy('surname', 'asc')
    //  ->get();
    //$url_strok = count($listt);
    /* if ($request->isMethod('post')) {
            if ($request->choice_post == "1") {
                $numer = "2021-01";
            }
            if ($request->choice_post == "2") {
                $numer = "2021-02";
            }
            //раскоментировать потом
          /*   $summary = Summary::create([
                'user_id' =>  Auth::user()->id,
                'date' => date("Y-m-d"),
                "numer" => $numer,
             ]); */
    // dd($summary);





    // echo("aliluaj");
    //  }
    // }
}
