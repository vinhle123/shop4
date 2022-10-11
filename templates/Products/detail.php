<?php 
$helper = $this->loadHelper("core");
?>
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Đông Trùng Hạ Thảo</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $this->Url->build('/', ['fullBase' => true]); ?>">Trang Chủ</a></li>
                    <li class="breadcrumb-item active">Đông Trùng Hạ Thảo</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php echo $product['id'];  ?>
<div class="shop-detail-box-main">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6">
                <div id="<?php echo $product['name_key']; ?>" class="single-product-slider carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active"> <img class="d-block w-100" src="<?php echo $this->Url->build('/webroot/photos/'.$product['id'].'/'.$product['photo'], ['fullBase' => false]); ?>" alt="<?php echo $product['name']; ?>"> </div>
                        <?php foreach($photos as $key => $photo): ?>
                            <div class="carousel-item"> <img class="d-block w-100" src="<?php echo $this->Url->build('/webroot/photos/'.$product['id'].'/'.$photo['image'], ['fullBase' => false]); ?>" alt="<?php echo $product['name']; ?>"> </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#<?php echo $product['name_key']; ?>" role="button" data-slide="prev"> 
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                        <span class="sr-only">Previous</span> 
                    </a>
                    <a class="carousel-control-next" href="#<?php echo $product['name_key']; ?>" role="button" data-slide="next"> 
                        <i class="fa fa-angle-right" aria-hidden="true"></i> 
                        <span class="sr-only">Next</span> 
                    </a>
                    <ol class="carousel-indicators">
                        <li data-target="#<?php echo $product['name_key']; ?>" data-slide-to="0" class="active">
                            <img class="d-block w-100 img-fluid" src="<?php echo $this->Url->build('/webroot/photos/'.$product['id'].'/'.$product['photo'], ['fullBase' => false]); ?>" alt="" />
                        </li>
                        <?php foreach($photos as $key => $photo): ?>
                            <li data-target="#<?php echo $product['name_key']; ?>" data-slide-to="1">
                                <img class="d-block w-100 img-fluid" src="<?php echo $this->Url->build('/webroot/photos/'.$product['id'].'/'.$photo['image'], ['fullBase' => false]); ?>" alt="" />
                            </li>
                        <?php endforeach; ?>

                    </ol>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-6">
                <div class="single-product-details">
                    <h2><?php echo $product['name'].' ('.$product['unit'].')'; ?></h2>
                    <?php if(!empty($product['type']) && $product['type'] == 1 && !empty($product['price_disscount'])): ?>
                    <h5> <del><?php echo $helper->price($product['price_disscount']); ?> </del> &nbsp; <?php echo $helper->price($product['price']); ?> <u itemprop="priceCurrency" content="đ">đ</u></h5>
                <?php else: ?>
                   <h5><?php echo $helper->price($product['price']); ?><u itemprop="priceCurrency" content="đ">đ</u></h5>
               <?php endif; ?>

               <h4>Mô Tả:</h4>
               <?php echo $product['description']; ?>
               <ul>
                <li>
                    <div class="form-group quantity-box">
                        <label class="control-label">Số lượng cần mua:</label>
                        <input class="form-control" value="1" min="1" max="20" type="number">
                    </div>
                </li>
            </ul>

            <div class="price-box-bar">
                <div class="cart-and-bay-btn">
                    <a class="btn hvr-hover" data-fancybox-close="" href="#">Mua Ngay</a>
                    <a class="btn hvr-hover" data-fancybox-close="" href="#">Thêm Vào giỏ hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(!empty($product_mores)): ?>
    <div class="row my-5">
        <div class="col-lg-12">
            <div class="title-all text-center">
                <h1>Sản Phẩm Liên Quan</h1>
            </div>
            
            <div class="product">
                <div class="list-pro">
                    <div class="row list-pro">
                        <?php
                        foreach($product_mores as $pr_more):
                            ?>
                            <div class="col-xs-6 col-md-3">
                                <?php echo $this->element('product',array('product' => $pr_more));  ?>
                            </div>
                        <?php endforeach; ?> 
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php endif; ?>
</div>
</div>