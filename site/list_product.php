<?php
$allProduct=AllProduct(limit:6);
$pageCount=AllProduct();

?>
<!-- Data list view starts -->
<section id="data-list-view" class="data-list-view-header">
    
<div class="container">
    <div class="row">
        <div class="col-md-3  mb-2">
            <select class="form-select form-control"  name="sort_by_name" onchange="ChangeSortByName(this.value);">
              <option selected>İsme Göre Sırala</option>
              <option value="a-z">A - Z ye sıralama</option>
              <option value="z-a">Z - A ya sıralama</option>
            </select>
        </div>
        <div class="col-md-3  mb-2">
            <select class="form-select form-control"  name="sort_by_price" onchange="ChangeSortByPrice(this.value);">
              <option selected>Fiyata Göre Sırala</option>
              <option value="max">Önce En yüksek</option>
              <option value="min">Önce En Düşük</option>
            </select>
        </div>
         <div class="col-md-3 mb-2">
            <input type="text" id="search-input" id="search" class="form-control mb-3" placeholder="İsim Ara" oninput="AjaxSearch()">
        </div>
        <div class="col-md-3 mb-2">
            <input type="button" id="clear-filter" class="form-control btn-warning mb-3" value="Filtreleri Temizle" onclick="ClearFilter()">
        </div>
    </div>
    <form  onclick="return false;" id="pagination-form">
        <input type="hidden" name="ajax" value="true">
        <input type="hidden" name="build" value="pagination">
        <input type="hidden" name="page" value="1">
        <input type="hidden" name="count_data"  id="count_data" value="<?php echo count($pageCount); ?>">
        <input type="hidden" name="size" value="6">
        <input type="hidden" name="restart" value="GetAllProduct">
        <input type="hidden" name="search_key" id="hidden-search" value="">
        <input type="hidden" name="sort_by_name" id="hidden-search" value="">
        <input type="hidden" name="sort_by_price" id="hidden-search" value="">
        <input type="hidden" name="sort_by_table_count" id="hidden-search" value="">
    </form>
    
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>İsim</th>
                <th>Kategori</th>
                <th>Fiyat</th>
                <th>İndirimli Fiyat</th>
                <th>Aktif</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody id="all-category">

        </tbody>
    </table>
        <!-- Sayfalama Eklemesi -->
        <div id="pagination">
            
        </div>
    </div>
    <input type="button" onclick="denedik();" value="dene">
    <div class="add-new-data-sidebar">
        <div class="overlay-bg"></div>
        <div class="add-new-data" id="ajax-edit-data">
            
        </div>
    </div>
</section>
<script>
    function CalculateProductPrice()
    {

        event.preventDefault(); 
        var serializedData = $("#edit_product").serialize() + "&build2=EditProductPrice";
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?php echo apath; ?>' +'panel/important/ajax.php',
            data: serializedData,
            success: function(data) {
                var resMessageData = jQuery.parseJSON(data['responseMessage']);
                autoSystemMessage(resMessageData);
                GetProductCategoryList();
                
            }
        });
    }
    function DeleteTableCategory(CategoryId='')
    {
        if(CategoryId!='')
        {
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Kategoriyi Silmek İstediğinize Emin misiniz ? ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "Vazgeç",
                confirmButtonText: 'Evet, Sil!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        dataType: 'json',
                        url: '<?php echo apath; ?>' +'panel/important/ajax.php',
                        data: 'ajax=true&build=DeleteTableCategory&c_id=' + CategoryId,
                        success: function(data) {
                            var resMessageData = jQuery.parseJSON(data['responseMessage']);
                            autoSystemMessage(resMessageData);
                            GetProductCategoryList();
                        }
                    });
               s }
            })
        }
    }

    function ClearFilter()
    {

        $('input[name="page"]').val(1);
        $('input[name="count_data"]').val(<?php echo count($pageCount); ?>);
        $('input[name="size"]').val(6);
        $('input[name="search_key"]').val('');
        $('input[name="sort_by_name"]').val('');
        $('input[name="sort_by_price"]').val('');
        document.getElementById("search-input").value = "";
        document.querySelector('select[name="sort_by_name"]').selectedIndex=0;
        document.querySelector('select[name="sort_by_price"]').selectedIndex=0;
        setTimeout(GetAllProduct, 10);
        setTimeout(ChangePagePagination, 10);

    }
    function AjaxSearch() 
    {

        var searchInput = document.getElementById("search-input");
        var hiddenInput = document.getElementById("hidden-search");
        var countDataValue = document.getElementById("count_data").value;
        var pageValue = $('input[name="page"]').val();
        var countData = $('input[name="count_data"]').val();

        // İstenilen karakter sınırını burada belirleyebilirsiniz. Örneğin, 3. karakterden itibaren yazdırmak için 2 kullanabilirsiniz.
        var characterLimit = 2;

        if (searchInput.value.length > characterLimit) {
            hiddenInput.value = searchInput.value;
            GetAllProduct();

        } else {
            if (searchInput.value.length === 0) {
                ClearFilter();
            }
            hiddenInput.value = "";
        }
        setTimeout(ChangePagePagination, 150);
    }


    function GetProductCategoryEditDataHtml(c_id=0)
    {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?php echo apath; ?>' +'panel/important/ajax.php',
            data: 'ajax=true&build=GetProductCategoryEditDataHtml&c_id='+c_id,
            success: function(data) {
                var resMessageData = jQuery.parseJSON(data['responseMessage']);
                $("#ajax-edit-data").html(data['response']);
            }
        });
        
    }

    
    function ChangeSortByName(selectedValue) 
    {
        $('input[name="sort_by_name"]').val(selectedValue);
        setTimeout(GetAllProduct, 25);

    }
    function ChangeSortByPrice(selectedValue) 
    {
        $('input[name="sort_by_price"]').val(selectedValue);
        setTimeout(GetAllProduct, 25);

    }
    function ChangeSortByTableCount(selectedValue) 
    {

        $('input[name="sort_by_table_count"]').val(selectedValue);
        setTimeout(GetProductCategoryList, 125);

    }
    function EditProduct(p_id=0)
    {
    	event.preventDefault(); 
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?php echo apath; ?>' +'panel/important/ajax.php',
            data: $("#edit_product").serialize(),
            success: function(data) {
                var resMessageData = jQuery.parseJSON(data['responseMessage']);
                autoSystemMessage(resMessageData);
                GetAllProduct();
                
            }
        });
    }

    function GetProductEditDataHtml(p_id=0)
    {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?php echo apath; ?>' +'panel/important/ajax_edit_html.php',
            data: 'ajax=true&build=GetProductEditDataHtml&p_id='+p_id,
            success: function(data) {
                var resMessageData = jQuery.parseJSON(data['responseMessage']);
                $("#ajax-edit-data").html(data['response']);

                if(data['script']!='')
                {
                    setTimeout(AddScript(data['script']), 150);
                }
                
            }
        });
        
    }

    function GetAllProduct()
    {
        var pageValue = $('input[name="page"]').val();
        var countDataValue = $('input[name="count_data"]').val();
        var size = $('input[name="size"]').val();
        var search_key = $('input[name="search_key"]').val();
        var sort_by_name = $('input[name="sort_by_name"]').val();
        var sort_by_price = $('input[name="sort_by_price"]').val();
        var sort_by_table_count = $('input[name="sort_by_table_count"]').val();
        console.log(search_key);
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?php echo apath; ?>' +'panel/important/ajax.php',
            data: 'ajax=true&build=GetAllProduct&page='+pageValue+'&count_data='+countDataValue+'&size='+size+'&search_key='+search_key+'&sort_by_name='+sort_by_name + '&sort_by_table_count=' + sort_by_table_count+'&sort_by_price=' + sort_by_price,
            success: function(data) {
                var resMessageData = jQuery.parseJSON(data['responseMessage']);
                $("#all-category").html(data['response']);
                $("#all-category").append(data['script']);
                //searchlemeye göre data countu alıyoruz ki paginationu dogru calistiralim
                if(data['dataCount']>0) $('input[name="count_data"]').val(data['dataCount']);
                

            }
        });

    }


</script>
<!-- Data list view end -->

            