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
<div class="shop-detail-box-main">
    <div class="container">
        <div class="row">
            <div class="col-5  col-sm-6">
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
            <div class="col-7 col-sm-6">
                <div class="single-product-details">
                    <h2><?php echo $product['name'].' ('.$product['unit'].')'; ?></h2>
                    <?php if(!empty($product['type']) && $product['type'] == 1 && !empty($product['price_disscount'])): ?>
                    <h5> <del><?php echo $helper->price($product['price_disscount']); ?> </del> &nbsp; <?php echo $helper->price($product['price']); ?> <u itemprop="priceCurrency" content="đ">đ</u></h5>
                <?php else: ?>
                   <h5><?php echo $helper->price($product['price']); ?><u itemprop="priceCurrency" content="đ">đ</u></h5>
               <?php endif; ?>

               <h4>Mô Tả:</h4>
               <?php echo $product['description']; ?>
              
                    <div class="form-group quantity-box">
                        <label class="control-label"><h4>Số lượng cần mua:</h4></label>
                        <div class="quatity_detail" >
                          <button onclick="quatityminus()" type="button" class="change-quatity-btn">-</button><span class="quatitycartdetail">1</span><button onclick="quatityplus()" type="button"  class="change-quatity-btn">+</button>
                        </div>
                    </div>
              

            <div class="price-box-bar">
                <div class="cart-and-bay-btn">
                    <a class="btn btn-danger" onclick="byproductdetail(<?php echo $product['id']; ?>,<?php echo $product['price']; ?>,'<?php echo $product['name']; ?>','<?php echo $product['name_key']; ?>','<?php echo $product['photo']; ?>',0)" href="javascript:void(0)">Thêm Vào giỏ hàng</a>
                    <a class="btn btn-primary" onclick="byproductdetail(<?php echo $product['id']; ?>,<?php echo $product['price']; ?>,'<?php echo $product['name']; ?>','<?php echo $product['name_key']; ?>','<?php echo $product['photo']; ?>',1)" href="javascript:void(0)">Mua Ngay</a>
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
                            <div class="col-6 col-sm-3">
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