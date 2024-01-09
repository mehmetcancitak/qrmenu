<?php 
session_start();



function filter($veriable)
{
    if($veriable!='')
    {
        $one   = trim($veriable); //Boşlukları temizledik
        $two   = stripslashes($one); //Boşlukları temizledik
        $three   = strip_tags($two); //Zararlı yazılımlara karsı koruduk(Html icerikleri siliniyor)
        $four   = htmlspecialchars($three,ENT_QUOTES); //Sql injextiona karsı onlem. Html taglarını siliyor.
        $five   = addslashes($four); //Sql injextiona karsı onlem. Html taglarını siliyor.
        $result = $four;

        
        return $result;
    }
    else{
        return "";
    }
  
}
function AddWhere(array $getArray)
{
    $returnWhere='';
    if(count($getArray)>0 && isset($getArray))
    {

        foreach ($getArray as $array => $value)
        {
            if($array==0){
                $returnWhere.='WHERE ' . $value;
            }
            else{
                $returnWhere.=' AND '.$value;
            }
        }
    }
    return $returnWhere;
    
}
function isEmpty(array $emptyListArray,string $controlLanguage='')
{
    $return=false;
    if($controlLanguage!='') $controlLanguage='_'.$controlLanguage;
    for ($i=0; $i <count($emptyListArray); $i++) 
    { 
        if(filter($_POST[$emptyListArray[$i].$controlLanguage])=='') $return=true;
    }
    return $return;
}
function writeToLog($message) {
    $logFilePath = "../../logs/log.txt"; // Log dosyasının yolu

    // Log dizini yoksa oluşturma ve izinleri ayarlama
    if (!is_dir(dirname($logFilePath))) {
        if (!mkdir(dirname($logFilePath), 0755, true)) {
            echo "Log dizini oluşturulamadı.";
            return;
        }
    }

    // Log dosyasını açma ve mesajı yazma
    if ($handle = fopen($logFilePath, "a")) {

        $logMessage = date("Y-m-d H:i:s") . " - " . $message .' - İşlemi yapan kullanıcı : ' .$_SESSION['username']. PHP_EOL;
        fwrite($handle, $logMessage);
        fclose($handle);
    } else {
        echo "Log dosyasına erişim sağlanamadı.";
    }
}


function get_client_ip() {
    $ip = $_SERVER['REMOTE_ADDR'];

    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $ip;
}

//girişte login olurken bir
function log_failed_login_attempt($ip) 
{
    if (!isset($_SESSION['login_attempts'][$ip])) {

        $_SESSION['login_attempts'][$ip] = 1;
    } else {
        $_SESSION['login_attempts'][$ip]++;
    }
}

function ban_ip($ip) 
{

    $filePath = path.'/logs/ban_list.txt'; 
    if (file_exists($filePath)) {
        // Dosyanın içeriğini oku ve IP kontrolü yap
        $dosyaIcerik = file_get_contents($filePath);
        
        if (strpos($dosyaIcerik, $ip) === false) {
            // IP adresi dosyada bulunmuyorsa, dosyaya ekleyin
            file_put_contents(path.'/logs/ban_list.txt', $ip . "\n", FILE_APPEND);
            $_SESSION['login_attempts'][$ip]=0;

           
        } 
    } 
   

}

function AllTable(int $t_id=0,int $limit=0)
{

    global $db;

    $addWhere='';
    $addLimit='';
    if($t_id>0)
    {
        $addWhere ="WHERE t_id=".$t_id;
    }

    if($limit >0)
    {
        $addLimit="LIMIT $limit";
    }
    $query=$db->prepare("SELECT * FROM tables $addWhere ORDER BY t_id ASC $addLimit");
    $query->execute();
    $returnUser = $query->fetchAll(PDO::FETCH_ASSOC);

    return $returnUser;
}

function AllLanguage($language='',$active=0)
{
    global $db;
    $whereArray=array();
    if($language!='') array_push($whereArray,'language=:language');
    if($active>0) array_push($whereArray,'active=:active');


    $addWhere=AddWhere($whereArray);
    

    $query=$db->prepare("SELECT * FROM language $addWhere");

    if($language!='')  $query->bindValue(':language', $language, PDO::PARAM_STR);
    if($active>0) $query->bindValue(':language', $language, PDO::PARAM_STR);

    $query->execute();
    $return = $query->fetchAll(PDO::FETCH_ASSOC);

    return $return;
}

function AllTableCategory(int $c_id=0,int $limit=0)
{

    global $db;

    $addWhere='';
    $addLimit='';
    if($c_id>0)
    {
        $addWhere ="WHERE c_id=".$c_id;
    }

    if($limit >0)
    {
        $addLimit="LIMIT $limit";
    }
    $query=$db->prepare("SELECT * FROM tables_category $addWhere ORDER BY c_id ASC $addLimit");
    $query->execute();
    $returnUser = $query->fetchAll(PDO::FETCH_ASSOC);

    return $returnUser;
}

function AllProductCategory(int $c_id=0,int $limit=0)
{

    global $db;

    $addWhere='';
    $addLimit='';
    if($c_id>0)
    {
        $addWhere ="WHERE c_id=".$c_id;
    }

    if($limit >0)
    {
        $addLimit="LIMIT $limit";
    }
    $query=$db->prepare("SELECT * FROM product_category $addWhere ORDER BY c_id ASC $addLimit");
    $query->execute();
    $returnUser = $query->fetchAll(PDO::FETCH_ASSOC);

    return $returnUser;
}
function dene(array $getArray)
{
    echo '<pre>';

    if($_POST!='')
    {
        var_dump($_POST);
    }

    if($getArray!='')
    {
        var_dump($getArray);
        
    }
    echo 'calisticcccc';
    exit;
}
function AllProduct(int $p_id=0,int $limit=0)
{

    global $db;

    $addWhere='';
    $addLimit='';
    if($p_id>0)
    {
        $addWhere ="WHERE p_id=".$p_id;
    }

    if($limit >0)
    {
        $addLimit="LIMIT $limit";
    }
    $tableName='product_'.lang;
    $query=$db->prepare("SELECT * FROM $tableName $addWhere ORDER BY p_id ASC $addLimit");
    $query->execute();
    $returnUser = $query->fetchAll(PDO::FETCH_ASSOC);

    return $returnUser;
}




 ?>