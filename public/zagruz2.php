<?php
$erro = "";
$per_result = 0; //переменная выполнение условий
if (!empty($_FILES['file']['name'])) {
    $filename = $_FILES['file']['name'];
   // echo $filename . "<br>";
    //echo substr($filename,8,2) . "<br>";
    //echo strlen($filename) . "  =LEN<br>";
    if (strlen($filename) == 18) {
        //echo "LEN OK <br>";
        $per_result++;
    };
    $dt = date("Y");
    if ($dt == substr($filename, 0, 4)) {
        // echo "OK DATE <br>";
        $per_result++;
    }
    if (substr($filename, 10) == "-sm.xlsx") {
        //echo "OK HVOST <br>";
        $per_result++;
    }
    if (substr($filename, 5, 2) < 13) {
        //echo "OK MESAZZ <br>";
        $per_result++;
    }
    if (substr($filename, 5, 2) < 32) {
        //echo "OK DENN <br>";
        $per_result++;
    }
    if (!empty($_POST['psw'])) {
        if ($_POST['psw'] == "WhmvSCAARlroD4g9o2XbNmLo17hwhKB1BucCml9v") {
            //echo "OK PASSWORD <br>";
            $per_result++;
        } else {
            //echo "NO PASSWORD <br>";

        }
    }
    //6
    //WhmvSCAARlroD4g9o2XbNmLo17hwhKB1BucCml9v
    //echo $dt . "<br>";
    //echo substr($filename, 0, 4) . "<br>";



    //substr("abcdef", -1) сзади


    //echo "per result=".$per."<br>";
}

if ($per_result == 6) {
    if (isset($_FILES) && $_FILES['file']['error'] == 0) { // Проверяем, загрузил ли пользователь файл
        $destiation_dir = 'food/' . $_FILES['file']['name']; // Директория для размещения файла
        move_uploaded_file($_FILES['file']['tmp_name'], $destiation_dir); // Перемещаем файл в желаемую директорию
       // echo 'Файл успешно загружен'; // Оповещаем пользователя об успешной загрузке файла
$erro = <<<HERE
<div class="alert-success-ok" role="alert">
<strong> Файл успешно загружен</strong> 
</div>
HERE;
    } else {
$erro = <<<HERE
<div class="alert-success" role="alert">
<strong>Что то пошло не так</strong> 
</div>
HERE;
    }
} else {
    if ($per_result != 0) {
$erro = <<<HERE
<div class="alert-success" role="alert">
<strong>Что то пошло не так</strong> 
</div>
HERE;
    }
}
//print_r($_POST['psw']);    isset($_POST['psw']) &&
//$psw=$_POST['psw'];
//echo $psw."3333 <br>";
//print_r($_FILES);










//echo"7777";
/*if (isset($_FILES) && $_FILES['inputfile']['error'] == 0) { // Проверяем, загрузил ли пользователь файл
    $destiation_dir = 'food/' . $_FILES['inputfile']['name']; // Директория для размещения файла
    move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiation_dir); // Перемещаем файл в желаемую директорию
    echo 'Файл успешно загружен'; // Оповещаем пользователя об успешной загрузке файла
} else {
    echo 'Файл не загружен'; // Оповещаем пользователя о том, что файл не был загружен
} */
//echo("загрузка")
//print_r($_FILES);
//if (isset($_COOKIE['polls'])) {
//   $arrayPolls = explode(',',$_COOKIE['polls']);
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        .input-container {
            display: -ms-flexbox;
            /* IE10 */
            display: flex;
            width: 100%;
            margin-bottom: 15px;
        }

        .icon {
            padding: 10px;
            background: dodgerblue;
            color: white;
            min-width: 50px;
            text-align: center;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            outline: none;
        }

        .input-field:focus {
            border: 2px solid rgb(30, 255, 105);
        }

        /* Set a style for the submit button */
        .btn {
            background-color: dodgerblue;
            color: white;
            padding: 15px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .form-group {
            background-color: rgb(6, 129, 78);
            color: white;
            padding: 15px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .alert-success {
            background-color: rgb(255, 140, 0);
            color: white;
            padding: 15px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
            text-align: center;
        }
        .alert-success-ok {
            background-color: rgb(0, 100, 0);
            color: white;
            padding: 15px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
            text-align: center;
        }

        .btn:hover {
            opacity: 1;
        }
        .h2 {
            text-align: center;

        }
    </style>
</head>

<body>

    <form method="post" action="zagruz2.php" enctype="multipart/form-data" style="max-width:500px;margin:auto">
    <div class="h2">    
    <h2>Форма загрузки меню</h2>
    <div>
        <div class="input-container">


            <div class="form-group">
                <label for="exampleInputFile">Выбрать файл</label>
                <input type="file" name="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted"></small>
            </div>


        </div>


        <div class="input-container">
            <i class="fa fa-key icon"></i>
            <input class="input-field" type="password" placeholder="Пароль" name="psw">
        </div>
        <div class="input-container">
            <?php echo $erro; ?>
        </div>

        <button type="submit" class="btn">Загрузить</button>
       <p><a target="_blank" href="http://мониторингпитание.рф/otchetregion/Нижегородская%20область.html">Просмотр сводной таблицы</a></p> 
    </form>
    

</body>

</html>