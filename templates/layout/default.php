<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta name="csrf-token" content="<?php echo $this->request->getAttribute('csrfToken'); ?>" /> -->
    <?php 
        echo $this->Html->scriptBlock(sprintf(
    'var csrfToken = %s;',
    json_encode($this->request->getAttribute('csrfToken'))
));;
    ?>
    <title>
        <?php if (isset($title_for_layout) && $title_for_layout){ echo $title_for_layout; } ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <?= $this->Html->css(['bootstrap.min', 'style', 'responsive','custom','cart']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <link rel="shortcut icon" href="<?php echo $this->Url->webroot('images/favicon.ico'); ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo $this->Url->webroot('images/apple-touch-icon.png'); ?>">

<?php 
    if(empty($menu_active)){
        $menu_active = 'home';
    }
 ?>
</head>
<body>
    <header class="main-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="<?php echo $this->Url->build('/', ['fullBase' => true]); ?>"><img src="<?php echo $this->Url->webroot('images/logo.png'); ?>" alt="<?php echo TITLE_HOME; ?>" >
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item <?php if($menu_active == 'home'){ echo 'active';} ?>"><a class="nav-link" href="<?php echo $this->Url->build('/', ['fullBase' => true]); ?>">Trang chủ</a></li>
                        <li class="nav-item <?php if($menu_active == 'about'){ echo 'active';} ?>"><a class="nav-link" href="<?php echo $this->Url->build('/gioi-thieu', ['fullBase' => true]); ?>">Giới Thiệu</a></li>
                        <li class="dropdown <?php if($menu_active == 'product'){ echo 'active';} ?>">
                            <a href="<?php echo $this->Url->build('/san-pham', ['fullBase' => true]); ?>" class="nav-link dropdown-toggle" data-toggle="dropdown">Sản Phẩm</a>
                            <?php if(!empty($cates)): ?>
                            <ul class="dropdown-menu">
                                <?php foreach($cates as $ctes): ?>
                                <li><a href="<?php echo $this->Url->build('/the-loai/'.$ctes['name_key'], ['fullBase' => true]); ?>"><?php echo $ctes['name']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item <?php if($menu_active == 'contact'){ echo 'active';} ?>"><a class="nav-link" href="<?php echo $this->Url->build('/lien-he', ['fullBase' => true]); ?>">Liên Hệ</a></li>
                    </ul>
                </div>
                <div class="attr-nav">
                    <ul class="card-item">
                        <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                        <li class="side-menu <?php if($menu_active == 'cart'){ echo 'active';} ?>">
                            <a href="javascript:void(0)" id="all_cart">
                                <i class="fa fa-shopping-bag"></i>
                                <?php if(empty($count_cart)){$count_cart=0;} ?>
                                <span class="badge" id='num_cart'><?php echo $count_cart; ?></span>
                                <p>Giỏ Hàng</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </nav>
    </header>


    <div class="top-search">
        <div class="container">
           
            <form method="post" action ="<?php echo $this->Url->build('/tim-kiem', ['fullBase' => true]); ?>" >
            <div class="input-group">
                <span style="cursor: pointer;" class="input-group-addon btn-search"><i class="fa fa-search"></i></span>
                <input type="text" name="search" class="form-control txtsearch" placeholder="Tìm Kiếm">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
            </form>
            
        </div>
    </div>

    <main class="main-content">
        <div class="container-main">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    

    <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-top-box">
                            <h3>Thời gian hoạt động</h3>
                            <ul class="list-time">
                                <li>Thứ 2 - Chủ nhật: 08.00 - 20.00</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link-contact">
                            <h4>Liên Hệ</h4>
                            <ul>
                                <li>
                                    <p><i class="fas fa-map-marker-alt"></i>Quận 7, TP.HMC</p>
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+1-888705770">0123456789</a></p>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: <a href="mailto:locthienthao.contact@gmail.com">locthienthao.contact@gmail.com</a></p>
                                </li>
                            </ul>
                        </div>
                        <div class="footer-top-box">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>

                    </div>

                     <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link">
                            <h4>Chính sách bán hàng</h4>
                            <ul>
                                <li><a href="#">- Cam kết chất lượng dịch vụ</a></li>
                                <li><a href="#">- Chính sách giao nhận hàng</a></li>
                                <li><a href="#">- Chính sách đổi trả</a></li>
                                <li><a href="#">- Chính sách thanh toán</a></li>
                                <li><a href="#">- Bảo mật thông tin</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<!-- cart -->
    <div class="modal fade bottom" id="frameModalCart" 
      aria-hidden="true">
      <div class="modal-dialog modal-frame modal-bottom" role="document">
        <div class="modal-content  modal-top" style="display: flex; width: 100%;">
          <div class="modal-body">
            <div class="justify-content-center align-items-center" id="content-cart">
             
            </div>
             <center>
                <a class="btn btn-danger" href="<?php echo $this->Url->build('/gio-hang', ['fullBase' => true]); ?>">Đến trang đặt hàng</a>
                <button type="button" class="btn btn-success" data-dismiss="modal">Mua Thêm</button>
              </center>
          </div>
        </div>
      </div>
    </div>
<!-- contact -->

     <div class="hotline-phone-ring-wrap">
        <div class="hotline-phone-ring">
            <div class="hotline-phone-ring-circle">

            </div>
            <div class="hotline-phone-ring-circle-fill">

            </div>                   
            <div class="hotline-phone-ring-img-circle">
                <a href="tel:SỐ ĐIỆN THOẠI" class="pps-btn-img">
                    <img src="<?php echo $this->Url->webroot('/images/icon-call-nh.png'); ?>" alt="Gọi điện thoại" width="70">
                </a>
            </div>
        </div>
        <div class="hotline-bar">
            <a href="tel:0327877576">
                <span class="text-hotline">0327877576</span></a>
            </div>
        </div> 

    <ul class="giuseart-pc-contact-bar">
        <li class="facebook">
            <a href="https://m.me/jquangvinhle301" target="_blank" rel="nofollow"></a>
        </li>
        <li class="zalo">
            <a href="https://zalo.me/0327877576" target="_blank" rel="nofollow"></a>
        </li>
    </ul>

    <ul class="giuseart-mobile-contact-bar">
        <li class="facebook">
            <a href="https://m.me/quangvinhle301" target="_blank" rel="nofollow"></a>
        </li>
        <li class="zalo">
            <a href="https://zalo.me/0327877576" target="_blank" rel="nofollow"></a>
        </li>
        <li class="hotline">
            <a href="tel:0327877576" target="_blank" rel="nofollow"></a>
        </li>
    </ul>

    <script type="text/javascript">
     var full_url = "<?php  echo  $this->Url->build('/', ['fullBase' => true]); ?>";
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php echo $this->Html->script(['jquery-3.2.1.min','popper.min','bootstrap.min','jquery.superslides.min','bootstrap-select','inewsticker','bootsnav','images-loded.min','isotope.min','owl.carousel.min','baguetteBox.min','form-validator.min','custom','cart','jquery.validate.min']); ?>
</body>
</html>
