<?php 
$helper = $this->loadHelper("core");
?>
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Sản Phẩm</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $this->Url->build('/', ['fullBase' => true]); ?>">Trang Chủ</a></li>
                    <li class="breadcrumb-item active">Sản Phẩm</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="about-box-main">
    <div class="container">
        <div class="product">
            <div class="list-pro">
                <div class="row list-pro">
                    <div class="title">
                        <h2><a href="javascript:void(0)">Sản phẩm từ Đông Trùng Hạ Thảo</a></h2>
                    </div>
                    <?php
                    foreach($products as $product):
                        ?>
                        <div class="col-xs-6 col-md-3">
                         <?php echo $this->element('product',array('product' => $product));  ?>
                     </div>
                 <?php endforeach; ?> 
             </div>
         </div>
     </div>
 </div>
</div>