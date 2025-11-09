<?php

$host = "localhost";
$port = "5432";
$user = "postgres";
$pass = "";
$db   = "prakwebdb";


$koneksi = pg_connect("host=$host port=$port dbname=$db user=$user password=$pass");

if (!$koneksi) {
    die("Koneksi ke database gagal: " . pg_last_error());
}
?>
