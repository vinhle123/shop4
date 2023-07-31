<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php if (isset($title_for_layout) && $title_for_layout){ echo $title_for_layout; } ?>
    </title>
    <!-- <?= $this->Html->meta('icon') ?> -->

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['normalize.min','cake']) ?>
    <?= $this->Html->css(['bootstrap.min', 'style', 'responsive','custom','admin']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <link rel="shortcut icon" href="<?php echo $this->Url->webroot('images/icon.ico'); ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo $this->Url->webroot('images/apple-touch-icon.png'); ?>">
   

<?php 
    if(empty($menu_active)){
        $menu_active = 'products';
    }
 ?>
</head>
<body>
    <main class="main-content">
        <div class="container-main">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>   
</body>
<script type="text/javascript">
    var full_url = "<?php  echo  $this->Url->build('/', ['fullBase' => true]); ?>";
</script>
 <?php echo $this->Html->script(['jquery-3.2.1.min','popper.min','bootstrap.min','jquery.superslides.min','bootstrap-select','inewsticker','bootsnav','images-loded.min','isotope.min','owl.carousel.min','baguetteBox.min','form-validator.min','contact-form-script','custom','admin']); ?>
</html>
