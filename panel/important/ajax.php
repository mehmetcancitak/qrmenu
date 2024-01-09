<?php
define('lang','tr');
include('const.php');
include('connect.php');
include('function.php');
$ajax = filter($_POST['ajax']);
$build = filter($_POST['build']);
@$build2 = filter($_POST['build2']);
if($ajax=="true" && $build2==''){

    $responseMessage=array();
    if($build=="AddTableCategory")
    {

       $return = [
            'response'=>'',
            'responseMessage'=>'',
        ];

        $c_name = filter($_POST['c_name']);
        if($c_name!=='')
        {
            $query=$db->prepare("INSERT INTO tables_category(c_name) VALUES(:c_name)");
            $query->bindParam(':c_name',$c_name, PDO::PARAM_STR);
            $query->execute();

            if(isset($query))
            {
                $responseMessage[]="SUCCESSFULLY_ADDED";
                /* 
                $logMessage = 'Masalar için kategori eklendi. Kategori İsmi : '.$c_name .'Ekleyen : '.$_SESSION['username'];
                writeToLog($logMessage);
                */
            }
        }
        else
        {
            $responseMessage[] = "NOT_NULL";
        }

        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);
    }
    else if($build=='denedik')
    {
        $return = [
            'response'=>'',
            'responseMessage'=>'',
        ];

        $return['response']='<h1>aaaaa</h1>';
        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);
    }
    else if($build=="GetCategoryEditDataHtml")
    {

        $return = [
            'response'=>'',
            'responseMessage'=>'',
        ];
        $c_id=filter($_POST['c_id']);
        $category=AllTableCategory($c_id);
        $return['response']='
            <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                <div>
                    <h4 class="text-uppercase">List View Data</h4>
                </div>
                <div class="hide-data-sidebar">
                    <i class="feather icon-x"></i>
                </div>
            </div>
            <div class="data-items pb-3" id="ajax-edit-data">
                <form onclick="return false;" id="table_category_edit_form"> 
                    <input type="hidden"  name="ajax" value="true">
                    <input type="hidden"  name="build" value="EditTableCategory">
                    <input type="hidden"  name="c_id" value="'.$category[0]['c_id'].'">
                    <div class="data-fields px-2 mt-3">
                        <div class="row">
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">İsim</label>
                                <input type="text" class="form-control" id="c_name" name="c_name" value="'.$category[0]['c_name'].'">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                    <div class="add-data-btn">
                        <button class="btn btn-primary" onclick="EditTableCategory('.$category[0]['c_id'].')">Güncelle</button>
                    </div>
                    <div class="cancel-data-btn">
                        <button class="btn btn-outline-danger">Vazgeç</button>
                    </div>
                </div>
            </div>';
        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);
    }
    else if($build=="EditTableCategory")
    {
         $return = [
            'response'=>'',
            'responseMessage'=>'',
        ];
        $c_id=filter($_POST['c_id']);
        $c_name=filter($_POST['c_name']);



        $query= $db->prepare("UPDATE tables_category SET c_name=:c_name WHERE c_id=:c_id");
        $query->bindParam(':c_id', $c_id, PDO::PARAM_STR);
        $query->bindParam(':c_name', $c_name, PDO::PARAM_STR);

        $query->execute();
        ($query->rowCount()>0) ? $responseMessage[] = "UPDATE_1" : $responseMessage[] = "F_UPDATE_1";

        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);


    }
    else if($build=="DeleteTableCategory")
    {

        $return = [
            'response'=>'',
            'responseMessage'=>'',
        ];

        $c_id=filter($_POST['c_id']);
        if(isset($_SESSION['user_id']) && isset($c_id) && is_numeric($c_id))
        {

            $query = $db->prepare("DELETE FROM tables_category WHERE c_id = ?");
            $query->execute([$c_id]);

            if(isset($query))
            {
                $logMessage = 'Masalar için kategori silindi. Kategori Id : ' . $c_id ;
                writeToLog($logMessage);
            }
        }
        else
        {
            $logMessage = 'Masalar için kategori silme işlemi başladı. Kategori Id : ' . $c_id ;
            writeToLog($logMessage);
            die("Geçersiz parametreler.");
        }
       

        (isset($query)) ? $responseMessage[] = "DELETE_SUCCESS" : $responseMessage[] = "DELETE_ERROR";

        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);
    }
    else if($build=="GetAllTableCategory")
    {
         $return = [
            'response'=>'',
            'responseMessage'=>'',
            'dataCount'=>'',
            'script'=>'',
        ];
        $orderBy='';
        $addWhere='';
        $orderByArray=array();

        $page=filter($_POST['page']);
        $count_data=filter($_POST['count_data']);
        $size=filter($_POST['size']);
        $search_key=filter($_POST['search_key']);
        $sort_by_name=filter($_POST['sort_by_name']);
        $sort_by_table_count=$_POST['sort_by_table_count'];

        if($sort_by_name!='')
        {
            if($sort_by_name=='a-z') array_push($orderByArray, 'c_name ASC');
            if($sort_by_name=='z-a') array_push($orderByArray, 'c_name DESC');
        }
        if($sort_by_table_count!='')
        {
            if($sort_by_table_count=='artan') array_push($orderByArray, 'c_id ASC');
            if($sort_by_table_count=='azalan') array_push($orderByArray, 'c_id DESC');
        }


        if(count($orderByArray)>0) 
        {
            if(count($orderByArray)==1)
            {
                for ($i=0; $i < count($orderByArray); $i++) 
                { 
                    $orderBy=' ORDER BY '.$orderByArray[0];
                }
               
            }
            else
            {
                for ($i=0; $i < count($orderByArray); $i++) 
                { 
                    if($i==0)
                    {
                        $orderText=' ORDER BY ' ;
                        $addAnd='';
                    }
                    else
                    {
                        $orderText='';
                        $addAnd=',';
                    }
                    $orderBy.=$orderText.$addAnd.$orderByArray[$i];
                }

            }
            
        }
       
        /* 
        
        $orderBy = ($sort_by_name == 'a-z') ? ' ORDER BY c_name ASC' : (($sort_by_name == 'z-a') ? ' ORDER BY c_name DESC' : '');
        $orderBy = ($sort_by_table_count == 'artan') ? ' ORDER BY c_name ASC' : (($sort_by_name == 'z-a') ? ' ORDER BY c_name DESC' : '');
        */

        
        $continueData=($page-1)*$size;// burda kacıncı veriden devam edeceğimizi aliyoruz
        if($continueData<0) $continueData=0;

        $i=1;

        if (!empty($search_key)) 
        {
            $addWhere=" WHERE c_name LIKE :searchKey";
            $queryCount=$db->prepare("SELECT * FROM tables_category $addWhere ");
            $queryCount->bindValue(':searchKey', '%' . $search_key . '%', PDO::PARAM_STR);
            $queryCount->execute();

            $return['dataCount']=$queryCount->rowCount();
            
        }
        
        $query=$db->prepare("SELECT * FROM tables_category $addWhere $orderBy LIMIT 6 OFFSET $continueData ");

        if (!empty($search_key)) 
        {
            $query->bindValue(':searchKey', '%' . $search_key . '%', PDO::PARAM_STR);
        }
        
        $query->execute();
        $returnTable = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($returnTable as $category)
        {
            $return['response'].='
            <tr>
                <td class="product-name">'.filter($category['c_name']).'</td>
                <td class="product-category">'.$category['c_id'].'</td>
                <td class="product-action">
                    <span class="action-edit" onclick="GetCategoryEditDataHtml(`'.$category['c_id'].'`)"><i class="feather icon-edit"></i></span>
                    <span class="action-delete" onclick="DeleteTableCategory(`'.$category['c_id'].'`)"><i class="feather icon-trash"></i></span>
                </td>
            </tr>';

           $return['script'] = '<script>
                $(\'.action-edit\').on("click", function(e) {
                    e.stopPropagation();
                    $(\'#data-name\').val(\'Altec Lansing - Bluetooth Speaker\');
                    $(\'#data-price\').val(\'$99\');
                    $(".add-new-data").addClass("show");
                    $(".overlay-bg").addClass("show");
                });
            </script>';
            $i++;
        }
        
        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);
    }
    else if($build=="GetAllTable")
    {
         $return = [
            'response'=>'',
            'responseMessage'=>'',
            'dataCount'=>'',
            'script'=>'',
        ];
        $orderBy='';
        $orderByArray=array();
        $whereArray=array();

        $page=filter($_POST['page']);
        if($page=='') $page=1;

        $count_data=filter($_POST['count_data']);
        $size=filter($_POST['size']);
        $search_key=filter($_POST['search_key']);
        $sort_by_name=filter($_POST['sort_by_name']);
        $sort_by_table_count=$_POST['sort_by_table_count'];
        $sort_by_table_category=$_POST['sort_by_table_category'];

        $return['dataCount']=$count_data;
        if($sort_by_name!='')
        {
            if($sort_by_name=='a-z') array_push($orderByArray, 't_name ASC');
            if($sort_by_name=='z-a') array_push($orderByArray, 't_name DESC');
        }
        if($sort_by_table_count!='')
        {
            if($sort_by_table_count=='artan') array_push($orderByArray, 't_number ASC');
            if($sort_by_table_count=='azalan') array_push($orderByArray, 't_number DESC');
        }

        if($sort_by_table_category>0)
        {
            array_push($whereArray,'t_category=:t_category');

        }




        if(count($orderByArray)>0) 
        {
            if(count($orderByArray)==1)
            {
                for ($i=0; $i < count($orderByArray); $i++) 
                { 
                    $orderBy=' ORDER BY '.$orderByArray[0];
                }
               
            }
            else
            {
                for ($i=0; $i < count($orderByArray); $i++) 
                { 
                    if($i==0)
                    {
                        $orderText=' ORDER BY ' ;
                        $addAnd='';
                    }
                    else
                    {
                        $orderText='';
                        $addAnd=',';
                    }
                    $orderBy.=$orderText.$addAnd.$orderByArray[$i];
                }

            }
            
        }
       
        /* 
        
        $orderBy = ($sort_by_name == 'a-z') ? ' ORDER BY c_name ASC' : (($sort_by_name == 'z-a') ? ' ORDER BY c_name DESC' : '');
        $orderBy = ($sort_by_table_count == 'artan') ? ' ORDER BY c_name ASC' : (($sort_by_name == 'z-a') ? ' ORDER BY c_name DESC' : '');
        */

        
        $continueData=($page-1)*$size;// burda kacıncı veriden devam edeceğimizi aliyoruz
        if($continueData<0) $continueData=0;

        $i=1;

        if (!empty($search_key) || !empty($sort_by_table_category) ) 
        {
            if($search_key!='') array_push($whereArray,'t_name LIKE :searchKey');
            $addWhere=AddWhere($whereArray);

            $queryCount=$db->prepare("SELECT * FROM tables $addWhere ");
            

            if($search_key!='') {
                $queryCount->bindValue(':searchKey', '%' . $search_key . '%', PDO::PARAM_STR);

            }


            if($sort_by_table_category!='')
            {
                $queryCount->bindValue(':t_category', $sort_by_table_category, PDO::PARAM_STR);
            } 
            $queryCount->execute();
           
            $return['dataCount']=$queryCount->rowCount();
            
        }
        $addWhere=AddWhere($whereArray);

       
        $query=$db->prepare("SELECT tables.*, tables_category.* FROM tables LEFT JOIN tables_category ON tables.t_category = tables_category.c_id $addWhere $orderBy LIMIT 6 OFFSET $continueData ");

        
        if (!empty($search_key)) 
        {
            $query->bindValue(':searchKey', '%' . $search_key . '%', PDO::PARAM_STR);
        }

        if (!empty($sort_by_table_category)) 
        {
            $query->bindValue(':t_category', $sort_by_table_category, PDO::PARAM_STR);
        }        
        $query->execute();
        $returnTable = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($returnTable as $tables)
        {

            $return['response'].='
            <tr>
                <td class="product-name">'.filter($tables['t_name']).'</td>
                <td class="product-category">'.$tables['t_number'].'</td>
                <td class="product-category">'.$tables['c_name'].' </td>
                <td class="product-action">
                    <span class="action-edit" onclick="GetTableEditDataHtml(`'.$tables['t_id'].'`)"><i class="feather icon-edit"></i></span>
                    <span class="action-delete" onclick="DeleteTable(`'.$tables['t_id'].'`)"><i class="feather icon-trash"></i></span>
                </td>
            </tr>';

           $return['script'] = '<script>
                $(\'.action-edit\').on("click", function(e) {
                    e.stopPropagation();
                    $(\'#data-name\').val(\'Altec Lansing - Bluetooth Speaker\');
                    $(\'#data-price\').val(\'$99\');
                    $(".add-new-data").addClass("show");
                    $(".overlay-bg").addClass("show");
                });
            </script>';
            $i++;
        }
        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);

    }
    else if($build=='pagination')
    {

        $return = [
            'response'=>'',
            'responseMessage'=>'',
            'restartPage'=>'',
        ];

        $page=filter($_POST['page']);
        if($page=='') $page=1;
        $size=filter($_POST['size']);
        $count_data=filter($_POST['count_data']);


        if($count_data>0)
        {
            $restart=filter($_POST['restart']);
            $search_key=filter($_POST['search_key']);

            $count=($count_data>6) ? $count = ceil($count_data/$size) : $count=1;
            
            $return['restartPage']=$restart;
            $return['response'].='
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center" id="deneme1">';
            if($page>1)
            {
                $back = $page-1;
                $return['response'].='
                <li class="page-item">
                    <span class="page-link" onclick="ChangePagePagination('.$back.')">Önceki</span>
                </li>';

            }
            for ($i=1; $i <=$count ; $i++) 
            { 
                $active = ($page==$i) ? ' active' : ''; 
                $return['response'].='
                <li class="page-item'.$active.'">
                    <span class="page-link" onclick="ChangePagePagination('.$i.')">'.$i.'</span>
                </li>';
            }   
            
            if($page!=$count && $count!=1)
            {
                $next=$page+1;
                $return['response'].='
                <li class="page-item">
                    <a class="page-link" onclick="ChangePagePagination('.$next.')">Sonraki</a>
                </li>';

            }     
            $return['response'].='</ul>
            </nav>';

            $return['responseMessage'].=json_encode($responseMessage);
            echo json_encode($return);

        }
        else
        {
            $restart=filter($_POST['restart']);
            $search_key=filter($_POST['search_key']);

            $count=($count_data>6) ? $count = ceil($count_data/$size) : $count=1;
            
            $return['restartPage']=$restart;
            $return['response'].='';

            $return['responseMessage'].=json_encode($responseMessage);
            echo json_encode($return);

        }


        

    }
    else if($build=="AddTable")
    {
        $return = [
            'response'=>'',
            'responseMessage'=>'',
        ];

        $t_name = filter($_POST['t_name']);
        $t_number = filter($_POST['t_number']);
        $t_category = filter($_POST['t_category']);


        if($t_name!=='' && $t_number!=='')
        {
          


            $query=$db->prepare("INSERT INTO tables(t_name,t_number,t_category) VALUES(:t_name,:t_number,:t_category)");
            $query->bindParam(':t_name',$t_name, PDO::PARAM_STR);
            $query->bindParam(':t_number',$t_number, PDO::PARAM_STR);
            $query->bindParam(':t_category',$t_category, PDO::PARAM_STR);
            $query->execute();

            if(isset($query))
            {
                $responseMessage[]="SUCCESSFULLY_ADDED";
                /* 
                $logMessage = 'Masalar için kategori eklendi. Kategori İsmi : '.$c_name .'Ekleyen : '.$_SESSION['username'];
                writeToLog($logMessage);
                */
            }
        }
        else
        {
            $responseMessage[] = "NOT_NULL";
        }

        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);
    }
    else if($build=="DeleteTable")
    {

        $return = [
            'response'=>'',
            'responseMessage'=>'',
        ];

        $t_id=filter($_POST['t_id']);
        if(isset($_SESSION['user_id']) && isset($t_id) && is_numeric($t_id))
        {

            $query = $db->prepare("DELETE FROM tables WHERE t_id = ?");
            $query->execute([$t_id]);

            if(isset($query))
            {
                $logMessage = 'Masa silindi. Masa Id : ' . $t_id ;
                writeToLog($logMessage);
            }
        }
        else
        {
            $logMessage = 'Masa silerken hata oluştu.Masa Id : ' . $c_id ;
            writeToLog($logMessage);
            die("Geçersiz parametreler.");
        }
       

        (isset($query)) ? $responseMessage[] = "DELETE_SUCCESS" : $responseMessage[] = "DELETE_ERROR";

        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);
    }
    else if($build=="GetTableEditDataHtml")
    {

        $return = [
            'response'=>'',
            'responseMessage'=>'',
        ];
        $t_id=filter($_POST['t_id']);
        $tables=AllTable($t_id);
        $return['response']='
            <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                <div>
                    <h4 class="text-uppercase">List View Data</h4>
                </div>
                <div class="hide-data-sidebar">
                    <i class="feather icon-x"></i>
                </div>
            </div>
            <div class="data-items pb-3" id="ajax-edit-data">
                <form onclick="return false;" id="table_edit_form"> 
                    <input type="hidden"  name="ajax" value="true">
                    <input type="hidden"  name="build" value="EditTable">
                    <input type="hidden"  name="t_id" value="'.$tables[0]['t_id'].'">
                    <div class="data-fields px-2 mt-3">
                        <div class="row">
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">İsim</label>
                                <input type="text" class="form-control" id="t_name" name="t_name" value="'.$tables[0]['t_name'].'">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Masa Numarası</label>
                                <input type="number" class="form-control" id="t_number" name="t_number" value="'.$tables[0]['t_number'].'">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <select class="form-select form-control"  name="t_category">
                                <option value="">-- Seçiniz-- </option>';
                                $allCategory=AllTableCategory();
                                foreach ($allCategory as $category) 
                                {
                                    $selected=($category['c_id']==$tables[0]['t_category']) ? ' selected' : ' ';
                                    $return['response'].='<option '.$selected.' value="'.filter($category['c_id']).'">'.filter($category['c_name']).'</option>';
                                }
                                $return['response'].='                    
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                    <div class="add-data-btn">
                        <button class="btn btn-primary" onclick="EditTable('.$tables[0]['t_id'].')">Güncelle</button>
                    </div>
                    <div class="cancel-data-btn">
                        <button class="btn btn-outline-danger">Vazgeç</button>
                    </div>
                </div>
            </div>';
        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);
    }
    else if($build=="EditTable")
    {
         $return = [
            'response'=>'',
            'responseMessage'=>'',
        ];
        $t_id=filter($_POST['t_id']);
        $t_name=filter($_POST['t_name']);
        $t_number=filter($_POST['t_number']);
        $t_category=filter($_POST['t_category']);



        $query= $db->prepare("UPDATE tables SET t_name=:t_name,t_category=:t_category,t_number=:t_number WHERE t_id=:t_id");
        $query->bindParam(':t_id', $t_id, PDO::PARAM_STR);
        $query->bindParam(':t_name', $t_name, PDO::PARAM_STR);
        $query->bindParam(':t_number', $t_number, PDO::PARAM_STR);
        $query->bindParam(':t_category', $t_category, PDO::PARAM_STR);

        $query->execute();
        ($query->rowCount()>0) ? $responseMessage[] = "UPDATE_1" : $responseMessage[] = "F_UPDATE_1";

        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);


    }
    else if($build=='AddProductCategory')
    {
        $return = [
            'response'=>'',
            'responseMessage'=>'',
        ];
        $c_name = filter($_POST['c_name']);
        $c_active = filter($_POST['c_active']);
        $c_active=($c_active!='') ? '1' : '0'; 
        if($c_name!=='')
        {
            $query=$db->prepare("INSERT INTO product_category(c_name,c_active) VALUES(:c_name,:c_active)");
            $query->bindParam(':c_name',$c_name, PDO::PARAM_STR);
            $query->bindParam(':c_active',$c_active, PDO::PARAM_STR);
            $query->execute();

            if(isset($query))
            {
                $responseMessage[]="SUCCESSFULLY_ADDED";
                /* 
                $logMessage = 'Masalar için kategori eklendi. Kategori İsmi : '.$c_name .'Ekleyen : '.$_SESSION['username'];
                writeToLog($logMessage);
                */
            }
        }
        else
        {
            $responseMessage[] = "NOT_NULL";
        }

        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);
    }
    else if($build=="GetAllProductCategory")
    {
         $return = [
            'response'=>'',
            'responseMessage'=>'',
            'dataCount'=>'',
            'script'=>'',
        ];
        $orderBy='';
        $addWhere='';
        $orderByArray=array();

        $page=filter($_POST['page']);
        $count_data=filter($_POST['count_data']);
        $size=filter($_POST['size']);
        $search_key=filter($_POST['search_key']);

        $sort_by_name=filter($_POST['sort_by_name']);
        $sort_by_table_count=$_POST['sort_by_table_count'];

        if($sort_by_name!='')
        {
            if($sort_by_name=='a-z') array_push($orderByArray, 'c_name ASC');
            if($sort_by_name=='z-a') array_push($orderByArray, 'c_name DESC');
        }
        if($sort_by_table_count!='')
        {
            if($sort_by_table_count=='artan') array_push($orderByArray, 'c_id ASC');
            if($sort_by_table_count=='azalan') array_push($orderByArray, 'c_id DESC');
        }


        if(count($orderByArray)>0) 
        {
            if(count($orderByArray)==1)
            {
                for ($i=0; $i < count($orderByArray); $i++) 
                { 
                    $orderBy=' ORDER BY '.$orderByArray[0];
                }
               
            }
            else
            {
                for ($i=0; $i < count($orderByArray); $i++) 
                { 
                    if($i==0)
                    {
                        $orderText=' ORDER BY ' ;
                        $addAnd='';
                    }
                    else
                    {
                        $orderText='';
                        $addAnd=',';
                    }
                    $orderBy.=$orderText.$addAnd.$orderByArray[$i];
                }

            }
            
        }
       
        /* 
        
        $orderBy = ($sort_by_name == 'a-z') ? ' ORDER BY c_name ASC' : (($sort_by_name == 'z-a') ? ' ORDER BY c_name DESC' : '');
        $orderBy = ($sort_by_table_count == 'artan') ? ' ORDER BY c_name ASC' : (($sort_by_name == 'z-a') ? ' ORDER BY c_name DESC' : '');
        */

        if($page=='') $page=1;
        $continueData=($page-1)*$size;// burda kacıncı veriden devam edeceğimizi aliyoruz
        if($continueData<0) $continueData=0;

        $i=1;

        if (!empty($search_key)) 
        {
            $addWhere=" WHERE c_name LIKE :searchKey";
            $queryCount=$db->prepare("SELECT * FROM product_category $addWhere ");
            $queryCount->bindValue(':searchKey', '%' . $search_key . '%', PDO::PARAM_STR);
            $queryCount->execute();

            $return['dataCount']=$queryCount->rowCount();
            
        }
        
        $query=$db->prepare("SELECT * FROM product_category $addWhere $orderBy LIMIT 6 OFFSET $continueData ");

        if (!empty($search_key)) 
        {
            $query->bindValue(':searchKey', '%' . $search_key . '%', PDO::PARAM_STR);
        }
        
        $query->execute();
        $returnTable = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($returnTable as $category)
        {
            $return['response'].='
            <tr>
                <td class="product-name">'.filter($category['c_name']).'</td>
                <td class="product-action">
                    <span class="action-edit" onclick="GetProductCategoryEditDataHtml(`'.$category['c_id'].'`)"><i class="feather icon-edit"></i></span>
                    <span class="action-delete" onclick="DeleteTableCategory(`'.$category['c_id'].'`)"><i class="feather icon-trash"></i></span>
                </td>
            </tr>';

           $return['script'] = '<script>
                $(\'.action-edit\').on("click", function(e) {
                    e.stopPropagation();
                    $(\'#data-name\').val(\'Altec Lansing - Bluetooth Speaker\');
                    $(\'#data-price\').val(\'$99\');
                    $(".add-new-data").addClass("show");
                    $(".overlay-bg").addClass("show");
                });
            </script>';
            $i++;
        }
        
        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);
    }
    else if($build=="GetProductCategoryEditDataHtml")
    {
        $return = [
            'response'=>'',
            'responseMessage'=>'',
        ];
        $c_id=filter($_POST['c_id']);
        $category=AllProductCategory($c_id);
        $return['response'].='
            <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                <div>
                    <h4 class="text-uppercase">List View Data</h4>
                </div>
                <div class="hide-data-sidebar">
                    <i class="feather icon-x"></i>
                </div>
            </div>
            <div class="data-items pb-3" id="ajax-edit-data">
                <form  id="product_category_edit_form"> 
                    <input type="hidden"  name="ajax" value="true">
                    <input type="hidden"  name="build" value="EditProductCategory">
                    <input type="hidden"  name="c_id" value="'.$category[0]['c_id'].'">
                    <div class="data-fields px-2 mt-3">
                        <div class="row">
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">İsim</label>
                                <input type="text" class="form-control" id="c_name" name="c_name" value="'.$category[0]['c_name'].'">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Aktif Kategori</span>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="vs-checkbox-con vs-checkbox-primary">';
                                        $active=($category[0]['c_active']==1) ? ' checked' : '';
                                        $return['response'].='<input type="checkbox" '.$active.' name="c_active">';
                                    $return['response'].='
                                                <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                    <div class="add-data-btn">
                        <button class="btn btn-primary" onclick="EditProductCategory('.$category[0]['c_id'].')">Güncelle</button>
                    </div>
                    <div class="cancel-data-btn">
                        <button class="btn btn-outline-danger">Vazgeç</button>
                    </div>
                </div>
            </div>';
        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);
    }
    else if($build=="EditProductCategory")
    {
         $return = [
            'response'=>'',
            'responseMessage'=>'',
        ];
        
        $c_id=filter($_POST['c_id']);
        $c_name=filter($_POST['c_name']);
        $c_active = @$_POST['c_active'];
        $c_active=($c_active!='') ? '1' : '0';

        


        $query= $db->prepare("UPDATE product_category SET c_name=:c_name,c_active=:c_active WHERE c_id=:c_id");
        $query->bindParam(':c_id', $c_id, PDO::PARAM_STR);
        $query->bindParam(':c_name', $c_name, PDO::PARAM_STR);
        $query->bindParam(':c_active', $c_active, PDO::PARAM_STR);

        $query->execute();
        ($query->rowCount()>0) ? $responseMessage[] = "UPDATE_1" : $responseMessage[] = "F_UPDATE_1";

        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);


    }
    else if($build=="AddProduct")
    {
        $return = [
            'response'=>'',
            'responseMessage'=>'',
        ];

        $controlLanguage='tr';
        $emptyCheckList=array('p_name','p_price');
        $language=[
            'tr',
            'en'
        ];

        foreach ($language as $lang) 
        {


            if($lang==$controlLanguage)
            {
                if(isEmpty($emptyCheckList,$controlLanguage))
                {

                    $responseMessage[] = "NOT_NULL";
                }
            }
            
            //array_search yoksa false dönüyor.Var ise int bir degerle dizinin indisini dönüyor.
            if(array_search('NOT_NULL', $responseMessage)===false)
            {
                $p_name = filter($_POST["p_name_$lang"]);
                $p_category = !empty($_POST["p_category_id_$lang"]) ? filter($_POST["p_category_id_$lang"]) : 0;
                $p_price = !empty($_POST["p_price_$lang"]) ? filter($_POST["p_price_$lang"]) : 0;
                $p_discount = filter($_POST["p_discount_$lang"]);
                $p_discount = !empty($_POST["p_discount_$lang"]) ? filter($_POST["p_discount_$lang"]) : 0;
                $p_active = !empty($_POST["p_active_$lang"]) ? filter($_POST["p_active_$lang"]) : 0;

                $p_active= ($p_active=='on') ? '1' : 0;

                $tableName='product_'.$lang;
           
                $query = $db->prepare("INSERT INTO $tableName (p_name, p_category, p_price, p_discount, p_active) VALUES (:p_name, :p_category, :p_price, :p_discount, :p_active)");
                $query->bindParam(':p_name', $p_name, PDO::PARAM_STR);
                $query->bindParam(':p_category', $p_category, PDO::PARAM_STR);
                $query->bindParam(':p_price', $p_price, PDO::PARAM_STR);
                $query->bindParam(':p_discount', $p_discount, PDO::PARAM_STR);
                $query->bindParam(':p_active', $p_active, PDO::PARAM_STR);
                $query->execute();
            }
        }
        if(isset($query))
        {
            $responseMessage[]="SUCCESSFULLY_ADDED";
            /* 
            $logMessage = 'Masalar için kategori eklendi. Kategori İsmi : '.$c_name .'Ekleyen : '.$_SESSION['username'];
            writeToLog($logMessage);
            */
        }

        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);
    }
    else if($build=='GetProductById')
    {

        $return = [
            'response'=>'',
        ];
        $p_id=$_POST['p_id'];
        $query= $db->prepare("SELECT * FROM product_tr WHERE p_id=$p_id");
        $query->execute();
        $returnTable = $query->fetchAll(PDO::FETCH_ASSOC);
        $return['response'] = $returnTable; // $returnTable'ı $return dizisine atadık
        echo json_encode($return);

    }
    else if($build=='GetProductOption')
    {

        $return = [
            'response'=>'',
        ];
        $p_id=$_POST['p_id'];
        $query= $db->prepare("SELECT * FROM product_tr WHERE p_id=$p_id");
        $query->execute();
        $returnTable = $query->fetchAll(PDO::FETCH_ASSOC);
        $ProductCategory=AllProductCategory();
        $return['response'].='
        <label for="data-category"> Kategorisi </label>
        <select class="form-control" id="data-category">
        <option value="">-- Seçiniz-- </option>';
        foreach ($ProductCategory as $category) 
        {
            $selected=($category['c_id']==$returnTable[0]['p_category']) ? ' selected' : '';
            $return['response'].='<option '.$selected.' value="'.filter($category['c_id']).'">'.filter($category['c_name']).'</option>';
        }
        $return['response'].='</select>';
        echo json_encode($return);

    }
    else if($build=="GetAllProduct")
    {
        $return = [
            'response'=>'',
            'responseMessage'=>'',
            'dataCount'=>'',
            'script'=>'',
        ];
        $orderBy='';
        $orderByArray=array();
        $whereArray=array();

        $page=filter($_POST['page']);
        if($page=='') $page=1;

        $count_data=filter($_POST['count_data']);
        $size=filter($_POST['size']);
        $search_key=filter($_POST['search_key']);
        $sort_by_name=filter($_POST['sort_by_name']);
        $sort_by_table_count=$_POST['sort_by_table_count'];
        @$sort_by_table_category=$_POST['sort_by_table_category'];

        $return['dataCount']=$count_data;
        if($sort_by_name!='')
        {
            if($sort_by_name=='a-z') array_push($orderByArray, 't_name ASC');
            if($sort_by_name=='z-a') array_push($orderByArray, 't_name DESC');
        }
        if($sort_by_table_count!='')
        {
            if($sort_by_table_count=='artan') array_push($orderByArray, 't_number ASC');
            if($sort_by_table_count=='azalan') array_push($orderByArray, 't_number DESC');
        }

        if($sort_by_table_category>0)
        {
            array_push($whereArray,'t_category=:t_category');

        }




        if(count($orderByArray)>0) 
        {
            if(count($orderByArray)==1)
            {
                for ($i=0; $i < count($orderByArray); $i++) 
                { 
                    $orderBy=' ORDER BY '.$orderByArray[0];
                }
               
            }
            else
            {
                for ($i=0; $i < count($orderByArray); $i++) 
                { 
                    if($i==0)
                    {
                        $orderText=' ORDER BY ' ;
                        $addAnd='';
                    }
                    else
                    {
                        $orderText='';
                        $addAnd=',';
                    }
                    $orderBy.=$orderText.$addAnd.$orderByArray[$i];
                }

            }
            
        }
       
        /* 
        
        $orderBy = ($sort_by_name == 'a-z') ? ' ORDER BY c_name ASC' : (($sort_by_name == 'z-a') ? ' ORDER BY c_name DESC' : '');
        $orderBy = ($sort_by_table_count == 'artan') ? ' ORDER BY c_name ASC' : (($sort_by_name == 'z-a') ? ' ORDER BY c_name DESC' : '');
        */

        $tableName='product_'.lang;
        $continueData=($page-1)*$size;// burda kacıncı veriden devam edeceğimizi aliyoruz
        if($continueData<0) $continueData=0;

        $i=1;

        if (!empty($search_key) || !empty($sort_by_table_category) ) 
        {
            if($search_key!='') array_push($whereArray,'t_name LIKE :searchKey');
            $addWhere=AddWhere($whereArray);

            $queryCount=$db->prepare("SELECT * FROM $tableName $addWhere ");
            

            if($search_key!='') {
                $queryCount->bindValue(':searchKey', '%' . $search_key . '%', PDO::PARAM_STR);

            }


            if($sort_by_table_category!='')
            {
                $queryCount->bindValue(':p_category', $sort_by_table_category, PDO::PARAM_STR);
            } 
            $queryCount->execute();
           
            $return['dataCount']=$queryCount->rowCount();
            
        }
        $addWhere=AddWhere($whereArray);

        
        $query=$db->prepare("SELECT $tableName.*, product_category.* FROM $tableName LEFT JOIN product_category ON $tableName.p_category = product_category.c_id $addWhere $orderBy LIMIT 6 OFFSET $continueData ");

        
        if (!empty($search_key)) 
        {
            $query->bindValue(':searchKey', '%' . $search_key . '%', PDO::PARAM_STR);
        }

        if (!empty($sort_by_table_category)) 
        {
            $query->bindValue(':t_category', $sort_by_table_category, PDO::PARAM_STR);
        }        
        $query->execute();
        $returnTable = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($returnTable as $tables)
        {

            $active=($tables['p_active']==1) ? 'Aktif' : 'Pasif';
            $return['response'].='
            <tr>
                <td class="product-name">'.filter($tables['p_name']).'</td>
                <td class="product-category">'.$tables['c_name'].'</td>
                <td class="product-category">'.$tables['p_price'].' </td>
                <td class="product-category">'.$tables['p_discount'].' </td>
                <td class="product-category">'.$active.' </td>
                <td class="product-action">
                    <a style="color: inherit;" href="index.php?state=add&page=product_image&p_id='.$tables['p_id'].'" class="action-edit" onclick="GetTableEditDataHtml(`'.$tables['p_name'].'`)"><i class="feather icon-image"></i></a>
                    <span class="action-edit" onclick="GetProductEditDataHtml(`'.$tables['p_id'].'`)"><i class="feather icon-edit"></i></span>
                    <span class="action-delete" onclick="DeleteTable(`'.$tables['p_name'].'`)"><i class="feather icon-trash"></i></span>
                </td>
            </tr>';

           $return['script'] = '<script>
                $(\'.action-edit\').on("click", function(e) {
                    e.stopPropagation();
                    $(\'#data-name\').val(\'Altec Lansing - Bluetooth Speaker\');
                    $(\'#data-price\').val(\'$99\');
                    $(".add-new-data").addClass("show");
                    $(".overlay-bg").addClass("show");
                });
            </script>';
            $i++;
        }
        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);

    }
    else if($build=="EditProduct")
    {
        $return = [
            'response' => '',
            'responseMessage' => '',
        ];

        $p_id = filter($_POST['p_id']);
        $p_name = filter($_POST['p_name']);
        $p_category = filter($_POST['p_category']);
        $p_price = filter($_POST['p_price']);
        $p_discount = filter($_POST['p_discount']);
        $p_percentage = filter($_POST['p_percentage']);
        if(isset($_POST['p_active']))
        {
           $p_active=1;
        }
        else
        {
           
            $p_active=0;
        }

        $query = $db->prepare("UPDATE product SET p_name=:p_name,p_category=:p_category, p_price=:p_price, p_discount=:p_discount, p_percentage=:p_percentage, p_active=:p_active WHERE p_id=:p_id");
        $query->bindParam(':p_id', $p_id, PDO::PARAM_STR);
        $query->bindParam(':p_name', $p_name, PDO::PARAM_STR);
        $query->bindParam(':p_category', $p_category, PDO::PARAM_STR);
        $query->bindParam(':p_price', $p_price, PDO::PARAM_STR);
        $query->bindParam(':p_discount', $p_discount, PDO::PARAM_STR);
        $query->bindParam(':p_percentage', $p_percentage, PDO::PARAM_STR);
        $query->bindParam(':p_active', $p_active, PDO::PARAM_STR);


        $query->execute();
        ($query->rowCount() > 0) ? $responseMessage[] = "UPDATE_1" : $responseMessage[] = "F_UPDATE_1";

        $return['responseMessage'] .= json_encode($responseMessage);
        echo json_encode($return);


    }


}
else if($ajax=='true' && $build2!='')
{
    if($build2=="EditProductPrice")
    {

        $return = [
            'response'=>'',
            'responseMessage'=>'',
        ];

        $originalPrice = $_POST['p_price'];
        $discountedPrice = $_POST['p_discount'];




       
        if ($originalPrice > 0) {
            $percentageDiscount = ((($originalPrice - $discountedPrice) / $originalPrice) * 100);
        } else {
            $percentageDiscount = 0;
        }



        $c_name = filter($_POST['c_name']);
        if($c_name!=='')
        {
            $query=$db->prepare("INSERT INTO tables_category(c_name) VALUES(:c_name)");
            $query->bindParam(':c_name',$c_name, PDO::PARAM_STR);
            $query->execute();

            if(isset($query))
            {
                $responseMessage[]="SUCCESSFULLY_ADDED";
                /* 
                $logMessage = 'Masalar için kategori eklendi. Kategori İsmi : '.$c_name .'Ekleyen : '.$_SESSION['username'];
                writeToLog($logMessage);
                */
            }
        }
        else
        {
            $responseMessage[] = "NOT_NULL";
        }

        $return['responseMessage'].=json_encode($responseMessage);
        echo json_encode($return);
    }
}
