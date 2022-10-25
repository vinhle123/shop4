<div>
	     <!-- Start Slider -->
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
            <li class="text-center">
                <img src="images/banner/banner01.jpg" alt="dong-trung-ha-thao">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong><?php echo TITLE_1; ?></strong></h1>
                            <p class="m-b-40"><?php echo SUB_1; ?></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="images/banner/banner-02.jpg" alt="dong-trung-ha-thao">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong><?php echo TITLE_2; ?></strong></h1>
                            <p class="m-b-40"><?php echo SUB_2; ?></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="images/banner/banner-03.jpg" alt="dong-trung-ha-thao">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong><?php echo TITLE_3; ?></strong></h1>
                            <p class="m-b-40"><?php echo SUB_3; ?></p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End Slider -->


        <!-- Start Products  -->
    <div class="products-box">
        <div class="container product">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Bán Chạy & Khuyến Mãi</h1>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        <?php if(!empty($products)): ?>
            <div class="row special-list list-pro">
                <?php
                   foreach($products as $product):
                ?>
                <div class="col-6 col-sm-3 special-grid top-featured">
                    <?php echo $this->element('product',array('product' => $product));  ?>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        </div>
        <div class="home-more"><a href="<?php echo $this->Url->build('/san-pham', ['fullBase' => true]); ?>">Xem Thêm</a></div>
    </div>
    <!-- End Products  -->


	<!-- Start Categories  -->
    <?php if(!empty($categories)): ?>
        <div class="categories-shop">
            <div class="container">
                <div class="row">
                    <?php foreach($categories as $category): ?>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="shop-cat-box">
                            <img class="img-fluid" src="<?php echo $this->Url->build('/webroot/photos/categories/'.$category['photo'], ['fullBase' => false]); ?>" alt="<?php echo $category['name_key']; ?>" />
                            <a href="<?php echo $this->Url->build('/the-loai/'.$category['name_key'], ['fullBase' => true]); ?>" class="btn hvr-hover" ><?php echo $category['name']; ?></a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- End Categories -->
    
	<div class="box-add-products">
        <div class="container">
            "Chúng tôi hạ giá thành sản phẩm, đồng nghĩa là giảm lợi nhuận để sản phẩm đến với người tiêu dùng dễ dàng hơn. Và điều này không có nghĩa là đông trùng hạ thảo của Lộc Thiên Thảo sẽ kém chất lượng.
        </div>
    </div>

     <!-- Start Blog  -->
    <div class="latest-blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Thông Tin Thêm</h1>
                        <p>Giới thiệu về đông trùng hạ thảo</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="images/blog/blog-img.jpg" alt="dong-trung-ha-thao" />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>Được nuôi cấy tự nhiên</h3>
                                <p>Được nuôi trồng trong phòng thí nghiệm, dưới sự giám sát chặt chẽ của kỹ thuật viên, được tạo điều kiện môi trường sống nhiệt độ, độ ẩm, ánh sáng,… tương tự như ở cao nguyên Tây Tạng. Mô phỏng trực tiếp điều kiện sống ở Tây Tạng, thúc ép trùng thảo sản sinh dược chất quý hiếm.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="images/blog/blog-img-01.jpg" alt="dong-trung-ha-thao" />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>Cách phân biệt loại các loại đông trùng</h3>
                                <p>Màu hơi xám, thân mập, đầu có 2 mắt đỏ và vuông góc. Mùi thơm đặc trưng như nấm, khi uống hơi tanh, ngậm nhấm trong miệng ngọt dịu. Tác dụng ngấm cơ thể sẽ phải 2-3 ngày mới thấy khỏe hơn.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="images/blog/blog-img-02.jpg" alt="dong-trung-ha-thao" />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>Tác dụng của đông trùng hạ thảo</h3>
                                <p>Làm giảm lượng cholesterol trong máu, giảm mỡ máu, gan nhiễm mỡ. Chống mệt mỏi, căng thẳng, giảm stress, giúp giấc ngủ sâu. Chống lão hoá, cải thiên nội tiết tố nữ cho làn da khoẻ và sáng đẹp. Hỗ trợ điều trị các bệnh liên quan đến tim, suy tim mãn tính, điều hòa huyết áp.</p>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog  -->


    <?php if(!empty($products_randoms)): ?>
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
           <?php
                foreach($products_randoms as $random):
            ?>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="<?php echo $this->Url->build('/webroot/photos/'.$random['id'].'/'.$random['photo'], ['fullBase' => false]); ?>" alt="<?php echo $random['name']; ?>" />
                    <div class="hov-in">
                        <a href="<?php echo $this->Url->build('/san-pham/'.$random['name_key'], ['fullBase' => true]); ?>"><i>Chi Tiết</i></a>
                    </div>
                </div>
            </div>
            <?php endforeach;  ?>

        </div>
    </div>
    <?php endif; ?>


</div>