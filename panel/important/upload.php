<?php 

include('const.php');
include('connect.php');
include('function.php');

$target_dir = "../../template/image/";
$target_file = basename($_FILES["file"]["name"]);


if($target_file!='')
{
	$p_id=$_SESSION['p_id'];
	$query=$db->prepare("INSERT INTO product_image(i_path,p_id) VALUES(:i_path,:p_id)");
	$query->bindParam(':i_path',$target_file, PDO::PARAM_STR);
	$query->bindParam(':p_id',$p_id, PDO::PARAM_STR);
	$query->execute();
	if(isset($query))
    {
        $responseMessage[]="SUCCESSFULLY_ADDED";
       
    }

	
}
if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
    $status = 1;
}


 ?>