<?php 
define('apath', 'http://localhost/qrmenu/');





$dosyaYolu = __FILE__;

// Mevcut dosyanın yolunu dizi olarak böl
$dizinParcalari = explode('/', $dosyaYolu);

// "qrmenu" dizinine ulaşıncaya kadar üst dizinlere çık


// Üst dizine çıktıktan sonra dosya yolu oluştur
$ustDizin = implode('/', $dizinParcalari);


define('path',$ustDizin);



 ?>