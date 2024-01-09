<?php 

include('const.php');
include('connect.php');
include('function.php');
$ip=get_client_ip();
$filePath = path.'/logs/ban_list.txt'; // Metin dosyasının yolu
// banlı ip kontrolü
if (file_exists($filePath)) {

    
    // Dosyayı satır satır oku
    $dosyaIcerik = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Her satırı kontrol et
    foreach ($dosyaIcerik as $satir) {
        if (strpos($satir, $ip) !== false) {
            die("Bir süre oturumunuz kapatıldı.Site sahibi ile iletişime geçiniz...");
            exit;
        }
    }
}

$currentURL = $_SERVER['REQUEST_URI']; // Mevcut URL'yi al

$parts = explode('/', rtrim($currentURL, '/')); // URL'yi "/" karakterine göre bölelim

$page = end($parts); // URL'deki son bölümü alalım (sayfa adı veya parametre olabilir)

// Eğer sayfa adında ".php" varsa, kaldıralım
$page = str_replace('.php', '', $page);





if (!isset($_SESSION["user_id"]) && $page!='index') {
    $ip=get_client_ip();
    log_failed_login_attempt($ip);

    if ($_SESSION['login_attempts'][$ip] >= 3) {
        ban_ip($ip);
        die("Çok fazla başarısız giriş denemesi. IP adresiniz yasaklanmıştır.");
    }

    header("Location:".apath.'panel/index.php');
    exit();

}

?>
