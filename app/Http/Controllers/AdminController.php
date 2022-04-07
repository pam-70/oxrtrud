<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Institution;
use App\Installation;
use App\Result;
use App\User;
use App\Summary;
use Hash;
use PDF;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function printuser(Request $request)
    {
        if ($request->isMethod('post')) {
            echo "888";
        } else {

            $users = User::where("institution_id", $request->istitut_ids)
                ->where("role", "student")
                ->get();
            // $surname=Summary::find($request->summarie_ids)->date;
            $numer=1;
            $pdf = PDF::loadView('userpdf', [
                'users' => $users,
                'name' => Institution::find($request->istitut_ids)->name,
                'numer'=>$numer,

            ]);
            //$pdf = PDF::loadView('invoice');    
            //return $pdf->download('printpdf.pdf');
            return $pdf->stream();
            // echo $request->istitut_ids;
        }
    }
    public function printresult(Request $request)
    {
        if ($request->isMethod('post')) {
            // $url_dat = [
            //    'url_i' => $request->id_result,

            // ];
            // return ($url_dat);
            // $result=Result::where('surname_id',$request->id_result)
            //  ->get();
            //$result = "999999";
            return view('home');

            // $total = collect($products)->sum('totals');

            // $pdf = PDF::loadView('invoice', compact('products', 'total'));
            //$pdf = PDF::loadView('printpdf');
            //$pdf = PDF::loadView('invoice');    
            //return $pdf->download('invoice.pdf');

            //  $data=[
            // 'fio'=>$id_user->surname,
            // 'sh'=>$id_user->sh,
            //  'dt'=>date("Y")."  год",
            // 'pr'=>$rez*10,
            // 'n_sert'=>$id_user->id,

            //  ];
            //  $pdf = PDF::loadView('invoice',['data'=>$data])->setPaper('a4', 'landscape');//, $data); 
            //$pdf = PDF::loadView('invoice');    
            //return $pdf->download('invoice.pdf');
            //return $pdf->stream(); // показ в окне
        } else {
            // $pdf = PDF::loadView('printpdf');
            //$pdf = PDF::loadView('invoice');    
            //  return $pdf->download('invoice.pdf');
            //return view('home');
            //  echo "767676767 <br>";
            //echo $request->summarie_ids."<br>";
            $summar = Summary::find($request->summarie_ids);
            $surname = User::find($summar->user_id)->surname;
            // $surname=Summary::find($request->summarie_ids)->date;
            $result_ = Result::where('summarie_id', $request->summarie_ids)
                ->get();

            $num = 1;
            $pdf = PDF::loadView('printpdf', [
                'num_bil' => $request->summarie_ids,
                'result_' => $result_,
                'num' => $num,
                'date' => $summar->date,
                'surname' => $surname,
                'ball' => $summar->result,
            ]);
            //$pdf = PDF::loadView('invoice');    
            //return $pdf->download('printpdf.pdf');
            return $pdf->stream();

            // dd($result_);

        }
    }
    public function filtersurname(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->del == '0') {
                $rols = 'student';
            } else {
                $rols = 'del';
            }
            if ($request->asc == '1') {
                $institution = User::where(
                    "institution_id",
                    $request->id_institution
                )
                    ->where(
                        "role",
                        $rols
                    )
                    ->orderBy('surname', 'asc')
                    ->where('surname', 'like', $request->surname . '%')
                    ->get();
            } else {
                $institution = User::where(
                    "institution_id",
                    $request->id_institution
                )
                    ->where(
                        "role",
                        $rols
                    )
                    ->where('surname', 'like', $request->surname . '%')
                    ->get();
            }



            $url_dat = [
                'url_institution' => $institution,

            ];
            return ($url_dat);
        } else {
            return view('home');
        }
    }
    public function adminresult(Request $request)
    {
        if ($request->isMethod('post')) {
            $n_dt = Installation::find(3)->data;
            //фильтр по дате и по номеру задания

            if ($request->choice == 1) {
                $id = 4;
            }
            if ($request->choice == 2) {
                $id = 5;
            }
            $surnameres = User::find($request->user_id)->surname;
            $per_nomer = Installation::find($id)->data;
            $rezult = Summary::where('user_id', $request->user_id)
                ->where('date', ">", $n_dt)
                ->where('numer', $per_nomer)
                ->orderby('result', 'desc')
                ->get();
            $url_dat = [
                'url_rezult' => $rezult,
                'url_surnameres' => $surnameres,

                // 'url_user_id' => $request->user_id,
            ];
            return ($url_dat);
        } else {
            // $rezult = Summary::where('user_id', 2)
            //    ->lists('result');
            // ->pluck('result', 'id');
            // ->orderBy('result', 'desc')
            // ->get();
            //->orderBy('name', 'desc')

            // ->select('date','result')
            //->max('result');
            // ->avg('result');
            //  $arr_result=[];
            // foreach ($rezult as $rezults) {
            //     echo $rezults->result . "<br>";
            //    $arr_result[] = $rezults->result;
            // }
            //  rsort($arr_result);
            // dd($rezult);
            return view('home');
        }
    }
    public function swonuser(Request $request)
    {
        if ($request->isMethod('post')) {

            $user = User::find($request->user_id);
            $url_dat = [
                'url_user' => $user->surname,
                'url_user_id' => $request->user_id,
            ];
            return ($url_dat);
        } else {
            return view('home');
        }
    }
    public function updatuser(Request $request)
    {
        if ($request->isMethod('post')) {

            $id_institution = $request->id_institution;
            if ($id_institution == 0) {
                $id_institution = 1;
            }
            if ($request->del == "1") {
                $del = "del";
            } else {
                $del = "student";
            }
            User::where('id', $request->user_id)
                ->update([
                    'surname' => $request->surname,
                    'institution_id' => $request->id_institution,
                    'role' => $del,
                ]);

            $url_dat = [
                'url_1' => $request->user_id,
            ];

            return ($url_dat);
        } else {


            return view('home');
        }
    }
    public function adduser(Request $request)
    {
        if ($request->isMethod('post')) {
            $log1 = rand(0, 9) . rand(0, 9) . rand(0, 9);
            $log2 = rand(0, 9) . rand(0, 9) . rand(0, 9);
            $log3 = rand(0, 9) . rand(0, 9) . rand(0, 9);
            $login = $log1 . "+" . $log2 . "+" . $log3;
            $pass1 = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
            $pass2 = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
            $pass = $pass1 . "-" . $pass2;
            $id_institution = $request->id_institution;
            if ($id_institution == 0) {
                $id_institution = 1;
            }

            $flight = User::create([
                'surname' => $request->surname,
                'institution_id' => $id_institution,
                'name' => $login,
                'password_srt' => $pass,
                'password' => Hash::make($pass),
                'role' => "student",
            ]);
            $url_dat = [
                'url_1' => $request->id_institution,

            ];

            return ($url_dat);
        } else {


            return view('home');
        }
    }
    public function showlist(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->del == '0') {
                $rols = 'student';
            } else {
                $rols = 'del';
            }
            if ($request->asc == '1') {
                $institution = User::where(
                    "institution_id",
                    $request->id_institution
                )
                    ->where(
                        "role",
                        $rols
                    )
                    ->orderBy('surname', 'asc')
                    ->get();
            } else {
                $institution = User::where(
                    "institution_id",
                    $request->id_institution
                )
                    ->where(
                        "role",
                        $rols
                    )
                    ->get();
            }


            $url_dat = [
                'url_institution' => $institution,
                'url_in' => $rols,

            ];
            return ($url_dat);
        } else {


            return view('home');
        }
    }
    public function admupdat(Request $request)
    {
        if ($request->isMethod('post')) {
            $istitutation = Institution::all();
            $url_dat = [
                'url_istitutation' => $istitutation,

            ];
            return ($url_dat);
        } else {
            return view('home');
        }
    }
    //exp_txt
    public function exptxt(Request $request)
    {
        //exptxt.txt
        $all_quest = Question::all();


        $exptxt = fopen("exptxt.txt", 'w') or die("не удалось открыть файл");
        $sob = "@@";

        fwrite($exptxt, $sob);
        // fwrite($exptxt, "\r\n");
        // echo ("@ <br>");
        foreach ($all_quest as $on_quest) {
            fwrite($exptxt, $on_quest->quest);
            // echo ($on_quest->quest . "<br>");

            $all_answ = Question::find($on_quest->id)->answers;
            foreach ($all_answ as $on_answ) {
                $dfr = substr($on_answ->answer, -2);
                $aser = $on_answ->right . "=" . $on_answ->answer;
                // echo ( $on_answ->right . "<br>");

                // $aser=$dfr."-".$on_answ->right;
                fwrite($exptxt, $aser);
                //  echo ($on_answ->answer . "=" . $on_answ->right . "<br>");
            }
            // echo ("@ <br>");
            fwrite($exptxt, $sob);
            // fwrite($exptxt, "\r\n");
        }
        fclose($exptxt);
        $ttt = file('exptxt.txt');


        dd($ttt);

        dd($all_quest);
    }



    public function addtxt(Request $request)
    { //biletot.txt
        $bilet = file('biletot.txt');
        $v = 1;
        $x = 1;
        $nv = 1;
        foreach ($bilet as $bilet_srt) {

            if ($v == 0) {

                echo "<span><B><center>Вопрос №" . $nv . "</center></B></span>  " . (substr($bilet_srt, 3) . '<br>');
                // echo "Вопрос №" $nv."  ".(substr($bilet_srt, 3) . "  @Сам вопрос <br> строка = " . $x);
                $x++;
                $nv++;
            }
            if ($v == 1 and $bilet_srt != '\r\n') {
                if (!empty(substr($bilet_srt, 3))) {
                    echo '-' . (substr($bilet_srt, 3) . '<br>');
                }
                //echo (substr($bilet_srt, 3) . "  @Сам ответ<br>  строка = " . $x);
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
