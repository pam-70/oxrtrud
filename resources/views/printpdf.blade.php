<!DOCTYPE html>
<html>

<head>
    <title>bilet oxrtruda</title>

    <style>
        @page {
            margin: 10px 30px 10px 40px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
        }

        /*/русские буквы шрифт */
        .nubex {
            font-size: 9px;
        }

        .nubex2 {
            font-size: 12px;
            text-align: center;
        }
        .podval {
            font-size: 12px;
            text-align: center;
        }

        .nubex1 {
            font-size: 19px;
            text-align: center;
        }
        .sp {
            font-size: 12px;
            text-align: right;
        }

        .tdsurname {
            font-size: 12px;
            text-decoration: underline;
            font-style: italic;
            font-weight: bold;

        }

    </style>


</head>

<body>

    <div class="nubex1"> Билет № {{ $num_bil }} </div>
    <div class="nubex2">
        <table class="table" width="100%">

            <tbody>
                <tr>

                    <td>Фамилия имя отчество:</td>
                    <td class="tdsurname">{{ $surname }}</td>
                    <td>дата сдачи </td>
                    <td>{{ date('d', strtotime($date)) . '-' . date('m', strtotime($date)) . '-' . date('Y', strtotime($date)) . ' года.' }}
                    </td>
                </tr>

            </tbody>
        </table>



    </div>
    <div style="width: 100%; max-width: 960px; margin: auto">

        <table width="100%">

            @foreach ($result_ as $result)
                <tr class="nubex">
                    <td>
                        @if ($result->an_user == 1 && $result->right == 1)<span class="sp">+</span>
                        @elseif($result->an_user==1 && $result->right==0)<span class="sp">-</span>
                        @elseif($result->an_user==0 && $result->right==1)<span class="sp">=</span>
                        @elseif(strlen($result->num_ques)>1){{"№ ".$num++}}
                        @endif
                        
                       
                    </td>
                    <td>

                        @if (!empty($result_s->num_ques))

                            {{ $result->qu_an }}
                        @endif

                        {{ $result->qu_an }}
                    </td>
                </tr>


            @endforeach

        </table>
        <div class="podval"> Подпись работника ___________________________________________ набрано {{$ball}} %</div>
    </div>
</body>

</html>
