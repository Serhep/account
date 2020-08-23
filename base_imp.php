<?php

    require dirname(__FILE__).'/config/config.inc.php';
    
    $trunc = "TRUNCATE TABLE set_quantity";
    if(!Db::getInstance()->execute($trunc)) 
        die("Error truncate");
    
    $itidaexp = array();
    $lines = file("itida_exp.csv", FILE_IGNORE_NEW_LINES);
    if (!$lines) {
    echo "Unable to open file.";
    exit;
    }
    //$lines = explode("\r\n",$rows);
    //$headers = str_getcsv(array_shift($lines));
    //print_r($lines);

    foreach ( $lines as $value )    {
        $itidaexp = str_getcsv($value);
        //$data = str_getcsv($value);
        //$itidaexp = array_combine($headers, $data);
        if(!Db::getInstance()->execute("INSERT INTO `set_quantity` (refer, quant, price, date) VALUES ('$itidaexp[0]', '$itidaexp[1]', '$itidaexp[2]', '$itidaexp[3]')"))
        die("Error insert");
    }
    
?>