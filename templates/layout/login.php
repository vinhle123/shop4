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
    <main class="main-content">
        <div class="container-main">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>   
</body>
</html>
