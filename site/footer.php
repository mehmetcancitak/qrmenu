    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <div id="add-script">
        
    </div>
    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2019<a class="text-bold-800 grey darken-2" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent,</a>All rights Reserved</span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i class="feather icon-heart pink"></i></span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->
    <?php 
    if($state=='list' && $page=='product_image')
    {

        ?>

        <script src="<?php echo apath; ?>template/app-assets/nestable/js/jquery-3.4.1.min.js"></script>
        <script src="<?php echo apath; ?>template/app-assets/nestable/js/jquery.nestable.js"></script>
        <script src="<?php echo apath; ?>template/app-assets/nestable/js/script.js"></script>
        <?php  
    }
     ?>
     
    <!-- BEGIN: Vendor JS-->
    <script src="<?php echo apath; ?>template/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?php echo apath; ?>template/app-assets/vendors/js/extensions/dropzone.min.js"></script>
    <script src="<?php echo apath; ?>template/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="<?php echo apath; ?>template/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="<?php echo apath; ?>template/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="<?php echo apath; ?>template/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="<?php echo apath; ?>template/app-assets/vendors/js/tables/datatable/dataTables.select.min.js"></script>
    <script src="<?php echo apath; ?>template/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?php echo apath; ?>template/app-assets/js/core/app-menu.js"></script>
    <script src="<?php echo apath; ?>template/app-assets/js/core/app.js"></script>
    <script src="<?php echo apath; ?>template/app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <script src="<?php echo apath; ?>template/assets/js/custom.js"></script>
    <script src="<?php echo apath; ?>template/assets/toastr/toastr.min.js"></script>
    <script src="<?php echo apath; ?>template/assets/toastr/toastr.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.7/sweetalert2.min.js" integrity="sha512-IHQXMp2ha/aGMPumvzKLQEs9OrPhIOaEXxQGV5vnysMtEmNNcmUqk82ywqw7IbbvrzP5R3Hormh60UVDBB98yg==" crossorigin="anonymous"></script>
    <!-- BEGIN: Page JS-->
    <script src="<?php echo apath; ?>template/app-assets/js/scripts/ui/data-list-view.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    <script>
        var search_key = $('input[name="search_key"]').val();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?php echo apath; ?>' +'panel/important/ajax.php',
            data: $("#pagination-form").serialize(),
            success: function(data) {
                var resMessageData = jQuery.parseJSON(data['responseMessage']);
                $("#pagination").html(data['response']);
                if(search_key=='')
                {

                    setTimeout(function() {
                        eval(data['restartPage'] + '()'); //fonksiyonu calistircak
                    }, 150);
                    
                }
                
            }
        });

        function ChangePagePagination(page,loop=true)
        {
            var countDataValue = document.getElementById("count_data").value;
            $('input[name="page"]').val(page);
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: '<?php echo apath; ?>' +'panel/important/ajax.php',
                data: $("#pagination-form").serialize(),
                success: function(data) {
                    var resMessageData = jQuery.parseJSON(data['responseMessage']);
                    $("#pagination").html(data['response']);
                    if(loop==true){
                        setTimeout(function() {
                            eval(data['restartPage'] + '()'); //fonksiyonu calistircak
                        }, 150);

                    }
                    
                }
            });
        }

        function AddScript(build='')
        {
            if(build!='')
            {
               $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '<?php echo apath; ?>' +'panel/important/ajax_script.php',
                    data: 'ajax=true&build='+build,
                    success: function(data) {
                        if(data['responseMessage']!='')
                        {
                            var resMessageData = jQuery.parseJSON(data['responseMessage']);
                        }
                        $("#add-script").html(data['response']);
                    }
                }); 
            }
            
        }
        

    </script>
</body>
<!-- END: Body-->

</html>