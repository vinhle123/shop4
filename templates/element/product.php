<?php 
$helper = $this->loadHelper("core");
?>
<div class="item">
    <div class="item-image">
        <a href="<?php echo  $this->Url->build('/san-pham/'.$product['name_key'], ['fullBase' => true]); ?>" title="<?php echo $product['name']; ?>" class="name"><img  src="<?php echo $this->Url->build('/webroot/photos/'.$product['id'].'/'.$product['photo'], ['fullBase' => false]); ?>" alt="<?php echo $product['name']; ?>"></a>
    </div>
    <?php if(!empty($product['photos'])): ?>
       <?php
       foreach($product['photos'] as $photo):
        ?>
        <div class="thumblist">
            <a target="_blank" href="<?php echo $this->Url->build('/webroot/photos/'.$product['id'].'/'.$photo['image'], ['fullBase' => false]); ?>">
                <img  src="<?php echo $this->Url->build('/webroot/photos/'.$product['id'].'/'.$photo['image'], ['fullBase' => false]); ?>" alt="<?php echo $product['name']; ?>">
            </a>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
<div class="item-info-group">
    <a href="<?php echo  $this->Url->build('/san-pham/'.$product['name_key'], ['fullBase' => true]); ?>" title="<?php echo $product['name']; ?>" class="name"> <?php echo $product['name'].' ('.$product['unit'].')'; ?></a>
    <div class="group-price"><span class="price"><?php echo $helper->price($product['price']); ?> <u itemprop="priceCurrency" content="đ">đ</u></span></div>
    <div class="item-button">
        <a href="javascript:void(0)" onclick="byproduct(<?php echo $product['id']; ?>,<?php echo $product['price']; ?>,'<?php echo $product['name']; ?>','<?php echo $product['name_key']; ?>','<?php echo $product['photo']; ?>')" data-product="<?php echo $product['id']; ?>"  class="item-phone hvr-ripple-out hvr-icon-wobble-horizontal btn-order"  rel="nofollow"><i class="fa fa-shopping-bag hvr-icon"></i> Thêm vào giỏ hàng</a>
    </div>

</div>
</div>