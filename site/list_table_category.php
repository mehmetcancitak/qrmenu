<?php
$allCategory=AllTableCategory(limit:6);
$pageCount=AllTableCategory();

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
            <select class="form-select form-control"  name="sort_by_table_count" onchange="ChangeSortByTableCount(this.value);">
              <option selected>Masa Sayısı</option>
              <option value="artan">Artan Masa Sayısı</option>
              <option value="azalan">Azalan Masa Sayısı</option>
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
        <input type="hidden" name="restart" value="GetTableCategoryList">
        <input type="hidden" name="search_key" id="hidden-search" value="">
        <input type="hidden" name="sort_by_name" id="hidden-search" value="">
        <input type="hidden" name="sort_by_table_count" id="hidden-search" value="">
    </form>
    
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>İsim</th>
                <th>Toplam Masa</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody id="all-category">

            <?php 
            /* 
            $index = 1;
            foreach ($allCategory as $category)
            {?>
            <tr>
                <td><?php echo $index++; ?></td>
                <td class="product-name"><?php echo filter($category['c_name']); ?></td>
                <td class="product-category">1</td>
                <td class="product-action">
                    <span class="action-edit" onclick="GetCategoryEditDataHtml(`<?php echo $category['c_id']; ?>`)"><i class="feather icon-edit"></i></span>
                    <span class="action-delete" onclick="DeleteTableCategory(`<?php echo $category['c_id']; ?>`)"><i class="feather icon-trash"></i></span>
                </td>
            </tr>
            <?php 
            }
            */
            ?>
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

    function denedik()
    {
        
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
                            console.log(data);
                            var resMessageData = jQuery.parseJSON(data['responseMessage']);
                            autoSystemMessage(resMessageData);
                            GetTableCategoryList();
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
        $('input[name="sort_by_table_count"]').val('');
        document.getElementById("search-input").value = "";
        document.querySelector('select[name="sort_by_name"]').selectedIndex=0;
        document.querySelector('select[name="sort_by_table_count"]').selectedIndex=0;
        setTimeout(GetTableCategoryList, 10);
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
            GetTableCategoryList();

        } else {
            if (searchInput.value.length === 0) {
                ClearFilter();
            }
            hiddenInput.value = "";
        }
        setTimeout(ChangePagePagination, 150);
    }


    function GetCategoryEditDataHtml(c_id=0)
    {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?php echo apath; ?>' +'panel/important/ajax.php',
            data: 'ajax=true&build=GetCategoryEditDataHtml&c_id='+c_id,
            success: function(data) {
                var resMessageData = jQuery.parseJSON(data['responseMessage']);
                $("#ajax-edit-data").html(data['response']);
            }
        });
        
    }

    function ChangeSortByName(selectedValue) 
    {

        $('input[name="sort_by_name"]').val(selectedValue);
        setTimeout(GetTableCategoryList, 25);

    }
    function ChangeSortByTableCount(selectedValue) 
    {

        $('input[name="sort_by_table_count"]').val(selectedValue);
        setTimeout(GetTableCategoryList, 125);

    }
    function EditTableCategory(c_id=0)
    {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?php echo apath; ?>' +'panel/important/ajax.php',
            data: $("#table_category_edit_form").serialize(),
            success: function(data) {
                var resMessageData = jQuery.parseJSON(data['responseMessage']);
                autoSystemMessage(resMessageData);
                GetTableCategoryList();
                
            }
        });
    }
    function GetTableCategoryList()
    {
        var pageValue = $('input[name="page"]').val();
        var countDataValue = $('input[name="count_data"]').val();
        var size = $('input[name="size"]').val();
        var search_key = $('input[name="search_key"]').val();
        var sort_by_name = $('input[name="sort_by_name"]').val();
        var sort_by_table_count = $('input[name="sort_by_table_count"]').val();

        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?php echo apath; ?>' +'panel/important/ajax.php',
            data: 'ajax=true&build=GetAllTableCategory&page='+pageValue+'&count_data='+countDataValue+'&size='+size+'&search_key='+search_key+'&sort_by_name='+sort_by_name + '&sort_by_table_count=' + sort_by_table_count,
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

            