<?php 
$allCategory=AllProductCategory();
$_SESSION['p_id'] = filter($_GET['p_id']);
 ?>
<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ürün Resim Ekleme İşlemleri</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="../panel/important/upload.php" class="dropzone" id="dropzonewidget">
                        </form>  
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>
<a href="index.php?state=list&page=product_image&p_id=<?php echo $_SESSION['p_id']; ?>" class="btn btn-primary mr-1 mb-1">Resim İşlemlerine Git</a>
