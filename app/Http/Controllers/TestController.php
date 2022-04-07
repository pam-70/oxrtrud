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
    //w  swon_result

    public function swonresult(Request $request)
    {
        if ($request->isMethod('post')) {
            $result_test = Result::where("summarie_id", $request->rezult_id)
                ->get();

            $url_dat = [
                'url_result_test' => $result_test,
                //"url_percent" =>$percent,

            ];

            return ($url_dat);
        } else {

            return view('home');
        }
    }

    public function viewcompl(Request $request)
    {
        $task = "2021-01";
        if ($request->isMethod('post')) {
            if ($request->choice == 1) {
                $task = "2021-01";
            }
            if ($request->choice == 2) {
                $task = "2021-02";
            }
            $n_date = Installation::find(3)->data;

            $view = Summary::where("user_id", Auth::user()->id)
                ->where("result", "!=", NULL)
                ->where("numer", $task)
                ->where("date", ">", $n_date)
                ->orderby('created_at', 'desc')
                ->take($request->take)
                ->get();




            $url_dat = [
                'url_view' => $view,
                'url_rr' => $task,

            ];

            return ($url_dat);
        } else {

            return view('home');
        }
    }
    public function allquest(Request $request)
    {
        if ($request->isMethod('post')) {
            $all_quest = Installation::find(1)->data;
            $percent = Installation::find(2)->data;
            $url_dat = [
                'url_all_quest' => $all_quest,
                "url_percent" => $percent,

            ];

            return ($url_dat);
        } else {
            return view('home');
            $all_quest = Result::where("summarie_id", 22)
                ->sum("an_user");
            if ($all_quest < 10) {
            }
            //  dd($all_quest);
        }
    }
    public function addrezult(Request $request)
    {

        ///////////////////////////////////////////////////
        if ($request->isMethod('post')) {
            $clear = Result::find($request->rezult_id);
            $clear1 = Result::where("user_id", $clear->user_id)
                ->where("summarie_id", $clear->summarie_id)
                ->where("variant", $clear->variant)
                ->get();
            $kluh = 0;
            foreach ($clear1 as $clea) {
                if ($kluh != 0) {
                    Result::where("id", $clea->id)
                        ->update([
                            "an_user" => 0
                        ]);
                }
                $kluh++;
            }
            Result::where("id", $request->rezult_id)
                ->update([
                    "an_user" => 1
                ]);
            $numer_testa = $request->numer_testa;
            $all_quest = $request->all_quest;
            $summar_id = $request->summar_id;

            if ($request->all_quest <= $clear->variant) {
                //если последний вопрос подсчитать результат и присвоить переменным 0
                //на все ли вопросы ответил
                $all_qu = Result::where("summarie_id", $summar_id)
                    ->sum("an_user");
                if ($all_qu < $all_quest) {
                    $url_dat = [
                        'url_ans' => $clear1,
                        'numer_testa' => $numer_testa,
                        'all_quest' => $all_quest,
                        'summar_id' => $summar_id,
                        'url_errors' => " Не все вопросы отвечены!"

                    ];

                    return ($url_dat);
                }


                $balls = 0;
                for ($i = 1; $i <= $request->all_quest; $i++) {
                    $summs = Result::where("user_id", $clear->user_id)
                        ->where("summarie_id", $clear->summarie_id)
                        ->where("variant", $i)
                        ->get();
                    foreach ($summs as $summss) {
                        if ($summss->an_user == 1 and $summss->right == 1) {
                            $balls++;
                        }
                    }
                }
                Summary::where('id', $request->summar_id)
                    ->update([
                        'result' => $balls * 100 / $request->all_quest,
                        'date' => date("Y-m-d"),
                        'numer' => $clear->question_number
                    ]);


                $numer_testa = 0;
                $all_quest = 0;
                $summar_id = 0;
            }
            if ($numer_testa >= $all_quest) {
                $numer_testa = $all_quest;
                // $numer_testa = 0;
            } else {
                $numer_testa++;
            }


            $url_dat = [
                'url_ans' => $clear1,
                'numer_testa' => $numer_testa,
                'all_quest' => $all_quest,
                'summar_id' => $summar_id,
                'url_errors' => ""
            ];

            return ($url_dat);
        } else {
            return view('home');
        }
    }
    public function runtest(Request $request)
    {
        //echo (Auth::user()->id . "<br>");
        if ($request->isMethod('post')) {

            //выбираем номер задания

            if ($request->numer_testa == 0) {
                //еще в одном месте подправить
                if ($request->choice_post == 1) {
                    $task = "2021-01";
                }
                if ($request->choice_post == 2) {
                    $task = "2021-02";
                }
                $task = "2021-01"; //убрать когда будет второй тест
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
                        'num_ques' => $task,
                        'qu_an' => $quests->quest,
                        // 'right'=>$quests->quest,
                        'str_right' => $quests->answer,
                        'pict' => $quests->drawing,



                        'variant' => $all_quest,
                        'question_number' => $quests->number,
                        'date' => date("Y-m-d"),
                    ]);

                    // echo($resul_id->id."<br>");

                    $answ = Question::find($arr_quest[$i])->answers;
                    foreach ($answ as $answer) {
                        Result::create([

                            'answer_id' => $answer->id,
                            'right' => $answer->right,
                            'user_id' => Auth::user()->id,
                            'question_id' => $quests->id,
                            'summarie_id' => $summars_id->id,
                            'num_ques' => $summars_id->number,
                            'qu_an' => $answer->answer,
                            'variant' => $all_quest,
                            'question_number' => $quests->number,
                            'an_user' => 0,

                        ]);
                        // echo ($answer->answer . "<br>");

                        # code...
                    }
                    $all_quest++;
                }
                $all_quest--; //Количество вопросов отправить на страницу
                $numer_testa = 1;
                $summar_id = $summars_id->id;
                //здесь запрос на первый вопрос




            } else { // если вопрос не нулевой следующий
                $numer_testa = $request->numer_testa; //номер вопроса теста
                $all_quest = $request->all_quest;
                $summar_id = $request->summar_id;
            }
            //dd($aa);
            //если вопрос занесен в базу
            // делаем запрос на порядковый номер вопроса
            $answer = null;
            $odin_quest = Result::where('summarie_id', $summar_id)
                ->where('variant', $numer_testa)
                ->where('user_id', Auth::user()->id)
                ->get();
            //выдать отвеченный вопрос
            foreach ($odin_quest as $odin_ques) {
                if ($odin_ques->an_user == 1) {
                    $answer = $odin_ques->id;
                }
            }


            $url_dat = [
                'url_numer_testa' => $numer_testa,
                "url_all_quest" => $all_quest,
                "url_summar_id" => $summar_id,
                "url_odin_quest" => $odin_quest,
                "url_answer" => $answer,


            ];

            return ($url_dat);
        } else { // Это гет запрос
            return view('home');
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
