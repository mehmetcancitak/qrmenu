<?php
include('const.php');
include('connect.php');
session_start();



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kullanıcıyı veritabanında bul
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    // Kullanıcı var mı ve şifre doğru mu?
    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["userid"];
        $_SESSION["username"] = $user["username"];
        header("Location:".apath.'site');
        exit();
    } else {
    	header("Location:".apath.'panel/index.php?state=ER_FF11');
    	exit();
    }
}else{
	header("Location:../index.php?durum=hata");
}

?>