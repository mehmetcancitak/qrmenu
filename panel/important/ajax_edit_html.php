<?php
include('const.php');
include('connect.php');
include('function.php');
$ajax = filter($_POST['ajax']);
$build = filter($_POST['build']);
if($ajax=="true"){

    $responseMessage=array();
    if($build=="GetProductEditDataHtml")
    {

        $return = [
            'response'=>'',
            'responseMessage'=>'',
            'script'=>'',
        ];
        $p_id=filter($_POST['p_id']);
        $product=AllProduct($p_id);

        $originalPrice = $product[0]['p_price'];
        $discountedPrice = $product[0]['p_discount'];


        if ($originalPrice > 0) {
            $percentageDiscount = ((($originalPrice - $discountedPrice) / $originalPrice) * 100);
        } else {
            $percentageDiscount = 0;
        }


        $active=($product[0]['p_id']=="1") ? ' checked' : '';
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
                <form  id="edit_product"> 
                    <input type="hidden"  name="ajax" value="true">
                    <input type="hidden"  name="build" value="EditProduct">
                    <input type="hidden"  name="p_id" value="'.$product[0]['p_id'].'">
                    <div class="col-sm-12 data-field-col">
                        <div class="row">
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Aktif Ürün</label>
                                <div class="vs-checkbox-con vs-checkbox-primary">
                                <input type="checkbox"'.$active.' id="p_active" name="p_active">
                                <span class="vs-checkbox">
                                    <span class="vs-checkbox--check">
                                        <i class="vs-icon feather icon-check"></i>
                                    </span>
                                </span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 data-field-col">
                        <div class="row">
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Ürün İsmi</label>
                                <input type="text" class="form-control" id="p_name" name="p_name" value="'.$product[0]['p_name'].'">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 data-field-col">
                        <label for="data-name">Kategori</label>
                        <select class="form-select form-control"  name="p_category">
                        <option value="">-- Seçiniz-- </option>';
                        $allCategory=AllProductCategory();
                        foreach ($allCategory as $category) 
                        {
                            $selected=($category['c_id']==$product[0]['p_category']) ? ' selected' : ' ';
                            $return['response'].='<option '.$selected.' value="'.filter($category['c_id']).'">'.filter($category['c_name']).'</option>';
                        }
                        $return['response'].='                    
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-4 data-field-col">
                                <label for="data-name">Ürün Fiyat</label>
                                 <input type="number" id="p_price" class="form-control" name="p_price" value="'.$product[0]['p_price'].'" oninput="calculatePercentageDiscount(`price`)">
                            </div>
                            <div class="col-sm-4 data-field-col">
                                <label for="data-name">Ürün İnd. Fiyat</label>
                                 <input type="number" id="p_discount" class="form-control" name="p_discount" value="'.$product[0]['p_discount'].'" oninput="calculatePercentageDiscount()">
                            </div>
                            <div class="col-sm-4 data-field-col">
                                <label for="data-name">İndirim Yüzdesi</label>
                                 <input type="number" id="p_percentage" class="form-control" name="p_percentage" oninput="calculatePercentageDiscount(`yuzde`)" value="'.$percentageDiscount.'" max="99">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="add-data-footer d-flex justify-content-around  mt-2">
                    <div class="add-data-btn">
                        <button class="btn btn-primary p-1" onclick="EditProduct('.$product[0]['p_id'].')">Güncelle</button>
                    </div>
                    <div class="cancel-data-btn ">
                        <button class="btn btn-outline-danger">Vazgeç</button>
                    </div>
                </div>
            </div>';
        $return['script'].='ProductPriceScript';
        $return['responseMessage'].=json_encode($responseMessage);


        echo json_encode($return);
       
    }
    else if($build=='scriptgetir')
    {


        $return = [
            'response'=>'',
            'responseMessage'=>'',
            'script'=>'',
        ];

        
        $return['script'].= "
        <script>
        function denebak()
        {
            alert('calisti');
        }
        </script>
        ";

        echo json_encode($return);
    }


}
