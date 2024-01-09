<?php 
$allCategory=AllProductCategory();
 ?>
<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ürün Ekleme İşlemleri</h4>
                </div>
                <section id="nav-filled">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card overflow-hidden">
                                <div class="card-content">
                                    <div class="card-body">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab-fill" data-toggle="tab" href="#home-fill" role="tab" aria-controls="home-fill" aria-selected="true">Türkçe</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="profile-tab-fill" data-toggle="tab" href="#profile-fill" role="tab" aria-controls="profile-fill" aria-selected="false">İngilizce</a>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content pt-1">
                                            <div class="tab-pane active" id="home-fill" role="tabpanel" aria-labelledby="home-tab-fill">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <form class="form form-horizontal" id="product_tr">
                                                            <input type="hidden" name="ajax" value="true">
                                                            <input type="hidden" name="build" value="AddProduct">
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-4">
                                                                                <span>Aktif Ürün</span>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                    <input type="checkbox" checked name="p_active_tr">
                                                                                    <span class="vs-checkbox">
                                                                                        <span class="vs-checkbox--check">
                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                        </span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-4">
                                                                                <span>Ürün İsmi</span>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="text" id="p_name_tr" class="form-control" name="p_name_tr" placeholder="Ürün İsmi">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                     <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-4">
                                                                                <span>Ürün Kategorisi</span>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                            <select class="form-select form-control"  name="p_category_id_tr">
                                                                            <?php
                                                                            echo '<option value="">-- Seçiniz-- </option>';
                                                                            foreach ($allCategory as $category) 
                                                                            {
                                                                                echo '<option value="'.filter($category['c_id']).'">'.filter($category['c_name']).'</option>';
                                                                            }
                                                                            ?>
                                                                            </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-4">
                                                                                <span>Ürün Fiyat</span>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="number" id="p_price_tr" class="form-control" name="p_price_tr" placeholder="Ürün Fiyat *">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-4">
                                                                                <span>Ürün İndirimli Fiyatı</span>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="number" id="p_discount_tr" class="form-control" name="p_discount_tr" placeholder="Ürün İndirimli Fiyatı">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-8 offset-md-4">
                                                                        <button type="submit" class="btn btn-primary mr-1 mb-1" onclick="addProduct();">Ekle</button>
                                                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Vazgec</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="profile-fill"  role="tabpanel" aria-labelledby="profile-tab-fill">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <form class="form form-horizontal" id="product_en">
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-4">
                                                                                <span>Aktif Ürün</span>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                    <input type="checkbox" checked name="p_active_en">
                                                                                    <span class="vs-checkbox">
                                                                                        <span class="vs-checkbox--check">
                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                        </span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-4">
                                                                                <span>Ürün İsmi</span>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="text" id="p_name_en" class="form-control" name="p_name_en" placeholder="Ürün İsmi">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                     <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-4">
                                                                                <span>Ürün Kategorisi</span>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                            <select class="form-select form-control"  name="p_category_id_en">
                                                                            <?php
                                                                            echo '<option value="">-- Seçiniz-- </option>';
                                                                            foreach ($allCategory as $category) 
                                                                            {
                                                                                echo '<option value="'.filter($category['c_id']).'">'.filter($category['c_name']).'</option>';
                                                                            }
                                                                            ?>
                                                                            </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-4">
                                                                                <span>Ürün Fiyat</span>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="number" id="p_price_en" class="form-control" name="p_price_en" placeholder="Ürün Fiyat">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-4">
                                                                                <span>Ürün İndirimli Fiyatı</span>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="number" id="p_discount_en" class="form-control" name="p_discount_en" placeholder="Ürün İndirimli Fiyatı">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-8 offset-md-4">
                                                                        <button type="submit" class="btn btn-primary mr-1 mb-1" onclick="addProduct();">Ekle</button>
                                                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Vazgec</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
            </div>
        </div>
        
    </div>
</section>
<script>
    function addProduct()
    {
        event.preventDefault(); 

        var formDataTr = $("#product_tr").serializeArray();
        var formDataEn = $("#product_en").serializeArray();

        // İki formun verilerini birleştir
        var formData = formDataTr.concat(formDataEn);


        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?php echo apath; ?>' +'panel/important/ajax.php',
            data: formData,
            success: function(data) {
                var resMessageData = jQuery.parseJSON(data['responseMessage']);
                autoSystemMessage(resMessageData);
                $("#content-page").html(data['response']);
            }
        });
    }
    
</script>