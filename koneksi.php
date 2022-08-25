<?php
    /*$hostname = 'sql603.main-hosting.eu';
    $username = 'u618838749_virta';
    $password = 'Virta123';
    $dbname   = 'u618838749_db_virta';

    $conn = mysqli_connect($hostname,$username,$password,$dbname) or die ('Gagal terhubung ke database');*/


    if ($_SERVER['SERVER_NAME'] == "localhost") {
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $dbname   = 'virtualtailor';
    } else {
        $hostname = 'localhost';
        $username = 'rgtastyc_virta';
        $password = 'NVcp#go?ldl]';
        $dbname   = 'rgtastyc_virta';
    }
    

    $conn = mysqli_connect($hostname,$username,$password,$dbname) or die ('Gagal terhubung ke database');

?>