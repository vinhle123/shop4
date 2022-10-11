<?php 
$helper = $this->loadHelper("core");
?>
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Giỏ hàng</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $this->Url->build('/', ['fullBase' => true]); ?>">Trang Chủ</a></li>
                    <li class="breadcrumb-item active">Giỏ hàng</li>
                </ul>
            </div>
        </div>
    </div>
</div>
    <div class="container">
        <div class="product">
            <div class="list-pro">
                <div class="row list-pro">
                    <?php echo $this->element('cart',array('carts' => $carts));  ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="heading heading-class"><i class="fas fa-address-card"></i> Thông tin quý khách hàng</h3>
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="phone">Điện thoại:<sup> *</sup></i></label>
                                <input type="text" class="form-control" name="phone" id="txtphone" min="9" max="11" value="" required="">
                                <input type="hidden" name="code" id="code" value="<?php echo  $code; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Họ tên:<sup> *</sup></i>
                                </label>
                                <input type="text" class="form-control" name="name" id="txtname" value="" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Email:<sup> *</sup></i></label>
                                <input type="text" name="email" id="txtemail" class="form-control" value="" placeholder="" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Địa chỉ nhận hàng<sup> *</sup></i></label>
                                <input type="text" name="address" class="form-control" value="" required="" placeholder="" id="txtaddress">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="note">Yêu cầu khác:</label>
                        <textarea id="txtnote" class="form-control" name="note" value="" style="height:100px" placeholder="Ví dụ: Yêu cầu thời gian giao hàng; xuất HĐ, MST,..."></textarea>
                    </div>    
                </div>
                <div class="col-md-6">
                    <h3 class="heading heading-class"><i class="fa fa-credit-card"></i> Phương thức thanh toán</h3>
                    <div class="form-group">
                    </div>
                    <div class="radio">
                        <label for="method1">
                            <input checked="" type="radio"  name="method" id="method1" value="ship">
                            &nbsp;&nbsp;Giao hàng thu tiền tận nơi.
                        </label>
                        <span><em>Lưu ý: Phí giao hàng được tính theo quy định của chúng tôi. Vui lòng tham khảo tại đây: <a href="<?php echo $this->Url->build('/phi-giao-hang', ['fullBase' => true]); ?>" style="color:#007bff;" target="blank">Phí giao hàng</a></em></span>
                    </div>
                    <div class="radio">
                        <label for="method2">
                            <input type="radio"  name="method" id="method2" value="bank">
                            &nbsp;&nbsp;Thanh toán thông qua ngân hàng.
                        </label>
                    </div>
                    <div class="list-group form-methods" id="bank_method" style="display: none;">
                        <div class="w-100">
                          <p class="mb-1"><strong>Công ty Lộc Thiên Thảo</strong><i class="fal fa-shield-check float-right text-success"></i></p>
                      </div>
                        <p><i class="fas fa-angle-right"></i> Tên TK Cá nhân: Nguyễn Văn Nhân</p>
                        <p><i class="fas fa-angle-right"></i> Số TK Công ty: 543212345</p>
                        <p><i class="fas fa-angle-right"></i> Ngân hàng: Vietcombank</p>
                        <p><i class="fas fa-angle-right"></i> Nội dung thanh toán: <span id="contenttransferbankcompany">Số điện thoại - <?php echo $code; ?></span></p>
                 
                    </div>
                     <div class="radio">
                        <label for="method2">
                            <input type="radio"  name="method" id="method3" value="momo">
                            &nbsp;&nbsp;Thanh toán thông qua MOMO.
                        </label>
                    </div>
                    <div class="list-group form-methods" id="momo_method" style="display: none;">
                        <div class="w-100">
                          <p class="mb-1"><strong>Công ty Lộc Thiên Thảo</strong><i class="fal fa-shield-check float-right text-success"></i></p>
                      </div>
                        <p><i class="fas fa-angle-right"></i> Số điện thoai: 01234556</p>
                        <p><i class="fas fa-angle-right"></i> Tên TK Cá nhân: Nguyễn Văn Nhân</p>
                        <p><i class="fas fa-angle-right"></i> Nội dung: <span id="contenttransferbankcompany">Số điện thoại - <?php echo $code; ?></span></p>
                 
                    </div>

          <div id="smb-order-cart" class="smbordercart mb-3 mt-3">
            <button id="btn_order" type="button" onclick="checkout()" class="btn btn-lg btn-primary btn-block" name="order"><span>Gửi yêu cầu đặt hàng</span></button>
        </div>
    </div>
</div>
</div>
</div>