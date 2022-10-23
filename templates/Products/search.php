<?php 
$helper = $this->loadHelper("core");
?>
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Tìm Kiếm</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $this->Url->build('/', ['fullBase' => true]); ?>">Trang Chủ</a></li>
                    <li class="breadcrumb-item active">Tìm Kiếm</li>
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
                        <h2><a href="javascript:void(0)"><?php echo 'Tìm Kiếm'; ?></a></h2>
                    </div>

                    <?php
                    if(!empty($products) && !empty($search)):
                    foreach($products as $product):
                        ?>
                        <div class="col-xs-6 col-md-3">
                            <?php echo $this->element('product',array('product' => $product));  ?>
                        </div>
                    <?php 
                        endforeach; 
                        else:
                    ?> 
                    <?php echo 'Không tìm thấy sản phẩm nào với kết quả "'.$search.'"'; ?>
                    <?php 
                       endif;
                    ?> 
                </div>
            </div>
        </div>
    </div>
</div>