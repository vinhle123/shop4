<?php 
$helper = $this->loadHelper("core");
?>
<div class="container-cart">
  <div class="cart-group">
    <h3 class="heading">Chi tiết đơn đặt hàng</h3>
    <div class="cart-body">
      <div class="table-responsive">          
        <table class="table">
          <tbody id="tbody_cart">
            <?php if(!empty($carts['product'])): ?>
                <?php foreach($carts['product'] as $cart): ?>
                <tr class="card-item" id="i_cart_<?php echo $cart['id']; ?>">
                  <td data-title="Ảnh">
                    <img class="cart-img" src="<?php echo $this->Url->build('/webroot/photos/'.$cart['id'].'/'.$cart['img'], ['fullBase' => false]); ?>" alt="<?php echo $cart['name']; ?>" class="img-thumbnail">
                  </td>
                  <td id="shopping-item-name">
                    <div class="col-lg-12">
                      <div class="col-lg-6">
                        <?php echo $cart['name']; ?>
                      </div>
                      <div class="col-lg-6">
                        <div class="quatity" >
                          <button onclick="quatityminus(<?php echo $cart['id']; ?>,'quatitycart')" type="button" class="change-quatity-btn">-</button><span id="quatitycart<?php echo $cart['id']; ?>"><?php echo $cart['quality']; ?></span><button onclick="quatityplus(<?php echo $cart['id']; ?>,'quatitycart')" type="button"  class="change-quatity-btn">+</button>
                        </div>
                        <div class="quatity_price">
                         &nbsp;&nbsp; x &nbsp;<b>  <?php echo $helper->price($cart['price']); ?> <u itemprop="priceCurrency" content="đ">đ</u></b>
                       </div>
                       <div class="clear"></div>
                     </div>
                   </div>
                  </td>
                  <td data-title="Xóa" id="shopping-item-del"><a href="javascript:void(0)" class="btn btn-danger" onclick="deleteitemcart(<?php echo $cart['id']; ?>,'quatitycart')"><i class="fa fa-trash"></i></a></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td id="no_cart_item">Giỏ hàng chưa có sản phẩm nào</td>
              </tr>
            <?php endif; ?>
         </tbody>
       </table>
     </div>
     <?php if(!empty($carts['totol_price'])): ?>
      <div id="name_price_cart">
      Giá trị đơn hàng của quý khách là: <b id='total_price'><?php echo $helper->price($carts['totol_price']); ?> <u itemprop="priceCurrency" content="đ">đ</u></b>
      </div>
      <?php endif; ?>
  </div>
</div>
</div>