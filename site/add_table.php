<?php 
$allCategory=AllTableCategory();
 ?>
<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Masa Bilgileri</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal" onclick="return false;"  id="table_form" method="POST">
                            <input type="hidden" name="ajax" value="true">
                            <input type="hidden" name="build" value="AddTable">
                            <div class="form-body">
                                <div class="row">
                                     <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <span>Masa Kategorisi</span>
                                            </div>
                                            <div class="col-md-8">
                                            <select class="form-select form-control"  name="t_category">
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
                                                <span>Masa İsmi *</span>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="t_name" required class="form-control" name="t_name" placeholder="Masa İsmi">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <span>Masa Numarası *</span>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="number" id="t_number" required class="form-control" name="t_number" placeholder="Masa Numarası">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1" onclick="AddTable();">Ekle</button>
                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Vazgeç</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <script>
                            function AddTable(){
                                $.ajax({
                                    type: "POST",
                                    dataType: 'json',
                                    url: '<?php echo apath; ?>' +'panel/important/ajax.php',
                                    data: $("#table_form").serialize(),
                                    success: function(data) {
                                        var resMessageData = jQuery.parseJSON(data['responseMessage']);
                                        autoSystemMessage(resMessageData);
                                        GetTableCategoryList();
                                        
                                    }
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>