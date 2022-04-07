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