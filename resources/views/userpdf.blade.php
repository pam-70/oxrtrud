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
            font-size: 14px;
            border-bottom: 2px solid black;
        }

        .nubex2 {
            font-size: 14px;
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

        .tb {
            width: 100%; /* Ширина таблицы */
    border: 1px  /* Рамка вокруг таблицы */
        }




    </style>


</head>

<body>

    <div class="nubex1"> Список сотрудников {{ $name }}</div>
    <div class="nubex2">
    </div>
    <div style="width: 100%; max-width: 960px; margin: auto">

        <table cellspacing="0" border="1" width="100%" bgcolor="#FFFFFF" >

            @foreach ($users as $user)
                <tr class="nubex">
                    <td>
                        {{ $numer++ }}

                    </td>
                    <td>
                        {{ $user->surname }}

                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->password_srt }}
                    </td>
                </tr>


            @endforeach

        </table>

    </div>
</body>

</html>
