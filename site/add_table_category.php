<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Kategori Ekleme İşlemleri</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal" id="tables_category" onclick="return false;">
                            <input type="hidden" name="ajax" value="true">
                            <input type="hidden" name="build" value="AddTableCategory">
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
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1" onclick="addTableCategory();">Ekle</button>
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
    function addTableCategory()
    {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?php echo apath; ?>' +'panel/important/ajax.php',
            data: $("#tables_category").serialize(),
            success: function(data) {
                var resMessageData = jQuery.parseJSON(data['responseMessage']);
                autoSystemMessage(resMessageData);
                $("#content-page").html(data['response']);


            }
        });
    }
</script>