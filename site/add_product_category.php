<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Kategori Ekleme İşlemleri</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal" id="product_category" >
                            <input type="hidden" name="ajax" value="true">
                            <input type="hidden" name="build" value="AddProductCategory">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <span>Kategori İsmi</span>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="c_name" class="form-control" name="c_name" placeholder="Kategori İsmi">
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <span>Aktif Kategori</span>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" checked name="c_active">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1" onclick="addProductCategory();">Ekle</button>
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
</section>
<script>
    function addProductCategory()
    {
    	event.preventDefault(); 
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?php echo apath; ?>' +'panel/important/ajax.php',
            data: $("#product_category").serialize(),
            success: function(data) {
                var resMessageData = jQuery.parseJSON(data['responseMessage']);
                autoSystemMessage(resMessageData);
                $("#content-page").html(data['response']);


            }
        });
    }
</script>