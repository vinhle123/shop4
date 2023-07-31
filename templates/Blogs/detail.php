<?php 
$helper = $this->loadHelper("core");
?>
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2><?php echo ucwords($blog['title']); ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $this->Url->build('/', ['fullBase' => true]); ?>">Trang Chủ</a></li>
                    <li class="breadcrumb-item active"><?php echo TITLE_BLOG ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="shop-detail-box-main">
    <div class="container">
    <div>
        <h2><a href="javascript:void(0)"><?php echo ucfirst($blog['title']); ?></a></h2>
    </div>    
    <div>
        <?php echo $blog['description']; ?>
    </div>   
<?php if(!empty($product_mores)): ?>
    <div class="row my-5">
        <div class="col-lg-12">
            <div class="title-all text-center">
                <h1>Sản Phẩm Liên Quan</h1>
            </div>
            
            <div class="product">
                <div class="list-pro">
                    <div class="product-view-auto">
                        <?php
                        foreach($product_mores as $pr_more):
                            ?>
                            <div>
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


