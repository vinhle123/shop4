<?php 
$helper = $this->loadHelper("core");
?>
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2><?php echo TITLE_BLOG ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $this->Url->build('/thong-tin', ['fullBase' => true]); ?>">Trang Chủ</a></li>
                    <li class="breadcrumb-item active"><?php echo TITLE_BLOG ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="about-box-main">
    <div class="container">
        <div class="blog">
            <div class="list-blog">
                <div class="row list-blog">
                    <div class="title-blog-info col-lg-12">
                        <h2><a href="javascript:void(0)">Chuyên Mục Sức Khỏe</a></h2>
                    </div>
                    <?php
                    foreach($blogs as $blog):
                        ?>
                        <div class="col-sm-4 col-6">
                         <?php echo $this->element('blog',array('blog' => $blog));  ?>
                     </div>
                 <?php endforeach; ?> 
             </div>
         </div>
     </div>
 </div>
</div>