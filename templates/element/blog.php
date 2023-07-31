<?php 
$helper = $this->loadHelper("core");
?>
<div class="item">
    <div class="item-image">
        <a href="<?php echo  $this->Url->build('/thong-tin/'.$blog['title_key'], ['fullBase' => true]); ?>" title="<?php echo $blog['title']; ?>" class="name"><img  src="<?php echo $this->Url->build('/webroot/photos/blogs/'.$blog['id'].'/'.$blog['photo'], ['fullBase' => false]); ?>" alt="<?php echo $blog['title']; ?>"></a>
    </div>
<div class="item-info-group">
    <a href="<?php echo  $this->Url->build('/thong-tin/'.$blog['title_key'], ['fullBase' => true]); ?>" title="<?php echo $blog['title']; ?>" class="name"> <?php echo ucfirst($blog['title']); ?></a>
</div>
</div>