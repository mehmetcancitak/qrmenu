<?php
require_once 'pdoconfig.php';



try 
{
    
    $db = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8",$DB_USER,$DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException     $hata)
{
    echo 'hata'."<br>";
    echo "aciklama : " . $hata->getMessage(); //getMessage() ile direk hatanın kaynagını basıyoruz.
    die();
}