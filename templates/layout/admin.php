<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php if (isset($title_for_layout) && $title_for_layout){ echo $title_for_layout; } ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['normalize.min','cake']) ?>
    <?= $this->Html->css(['bootstrap.min', 'style', 'responsive','custom','admin']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <link rel="shortcut icon" href="<?php echo $this->Url->webroot('images/favicon.ico'); ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo $this->Url->webroot('images/apple-touch-icon.png'); ?>">
   

<?php 
    if(empty($menu_active)){
        $menu_active = 'products';
    }
 ?>
</head>
<body>
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo $this->Url->build('/', ['fullBase' => true]); ?>">Home
                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item <?php if($menu_active == 'products'){ echo 'active';} ?>"><a class="nav-link" href="<?php echo $this->Url->build('/admin', ['fullBase' => true]); ?>">Sản Phẩm</a></li>
                        <li class="nav-item <?php if($menu_active == 'category'){ echo 'active';} ?>"><a class="nav-link" href="<?php echo $this->Url->build('/categories/admin', ['fullBase' => true]); ?>">Thể Loại</a></li>
                        <li class="nav-item <?php if($menu_active == 'orders'){ echo 'active';} ?>"><a class="nav-link" href="<?php echo $this->Url->build('/carts/admin', ['fullBase' => true]); ?>">Đơn Hàng</a></li>
                        <li class="nav-item <?php if($menu_active == 'blogs'){ echo 'active';} ?>"><a class="nav-link" href="#">Blogs</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
           
        </nav>
        <!-- End Navigation -->
    </header>



    <main class="main-content">
        <div class="container-main">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    
<script type="text/javascript">
    var full_url = "<?php  echo  $this->Url->build('/', ['fullBase' => true]); ?>";
</script>

    <?php echo $this->Html->script(['jquery-3.2.1.min','popper.min','bootstrap.min','jquery.superslides.min','bootstrap-select','inewsticker','bootsnav','images-loded.min','isotope.min','owl.carousel.min','baguetteBox.min','form-validator.min','contact-form-script','custom','tinymce/tinymce.min','admin']); ?>

    
</body>
</html>
