<div class="admin-content">
<h1>Thêm Thể Loại</h1>
	<div class="container-admin">
		<?php
        echo $this->Form->create(null, [
        	'id' => 'frm_product',
        	'url' => [
		        'controller' => 'Products',
		        'action' => 'create'
		    ]
		]);
        ?>
        <?php echo $this->Form->hidden('id',array('class' => 'form-control','value' => !empty($category) ? $category['id'] : '' )); ?>
        <?php echo $this->Form->hidden('old_key',array('class' => 'form-control ','value' => !empty($category) ? $category['name_key'] : '' )); ?>
        <?php echo $this->Form->hidden('old_img',array('class' => 'form-control ','value' => !empty($category) ? $category['photo'] : '' )); ?>
        <?php echo $this->Form->control('name',array('label' => 'Tên','class' => 'form-control name_sp','value' => !empty($category) ? $category['name'] : '' )); ?>
        <div class="input text class-pading-top">
            <input type="checkbox" name="home" <?php if(!empty($category['home'])){echo 'checked';} ?> value="1">
            <label>Hiển thị ở trang chủ</label> 
        </div>
        <?php echo $this->Form->control('name_key',array('label' => 'Từ Khóa(Link)','class' => 'form-control name_key','value' => !empty($category) ? $category['name_key'] : '')); ?>

        <?php echo $this->Form->control('photo_main',array('label' => 'Ảnh(500 x 500)','class' => 'form-control','type' => 'file','multiple' => true)); ?>
        <?php if(!empty( $category['photo'])): ?>
            <img width="200" height="200" src="<?php echo $this->Url->build('/webroot/photos/categories/'.$category['photo'], ['fullBase' => false]); ?>">
        <?php endif; ?> 
        
        <div class="alert alert-danger error-message" style="display:none;" role="alert"></div>
       	<div class="input text class-pading-top">
       		 <a  class="btn button" href="javascript:void(0)" id="btn_save_cate">Save</a>
       	</div>
       
     <?php $this->Form->end(); ?>



	</div>
</div

