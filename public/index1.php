<!doctype html>
<html lang="ru">

<head>
    <!-- Обязательные метатеги -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Ежедневное меню (мониторинг питания) МАОУ "Гимназия №1"</title>
    <style>
        .container {
            text-align: center;
        }
        li {
    list-style-type: none; /* Убираем маркеры */
   }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">

            <div class="p-3 mb-2 bg-light text-dark">
                <p class="text-center"><b>МУНИЦИПАЛЬНОЕ АВТОНОМНОЕ ОБЩЕОБРАЗОВАТЕЛЬНОЕ УЧРЕЖДЕНИЕ "ГИМНАЗИЯ №1"</b></p>
                <p class="text-center">Нижегородская область, Володарский район</p>
                <p class="text-center">606083, Нижегородская область, Володарский район, п.Мулино, ул.Гвардейская д.54</p>
                <p class="text-center"><a href="http://school58.ru/" class="text-primary">ПЕРЕЙТИ НА САЙТ ГИМНАЗИИ</a></p>




            </div>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm">

                </div>
                <div class="col-8">

                    <H1>Ежедневное меню столовой</H1>


                </div>
                <div class="col-sm">

                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm">

                </div>
                <div class="col-8">
                    <?php
                    $dir    = 'food';
                    $files1 = scandir($dir);
                    rsort($files1);
                    $dt = date("Y-m-d");
                    $arr_fl = [];
                    foreach ($files1 as $pfiles) {
                        if (substr($pfiles, 10) == "-sm.xlsx") {
                            $arr_fl[] = $pfiles;
                        }
                    }
                    ?>
                    <ul list-style-type="none">
                        <?php
                        foreach ($arr_fl as $files) {
                            $dtf = substr($files, 0, 10);
                            //echo " fl=".$dtf ."<br>";
                            if (substr($files, 10 == "-sm.xlsx" and $dtf <= $dt)) {
                                if ($dtf <= $dt) {
                        ?>
                                    <li>
                                        <a class="text-success" href=<?php echo '/food/' . $files . '>' . $files; ?></a>
                                    </li>
                        <?php
                                }
                            }
                        }

                        ?>
                    </ul>
                </div>
                <div class="col-sm">

                </div>
            </div>
        </div>
    </div>


    <!-- Необязательный JavaScript; выберите один из двух! -->

    <!-- Вариант 1: пакет Bootstrap с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Вариант 2: отдельные JS для Popper и Bootstrap -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>