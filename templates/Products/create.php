<div class="admin-content">
<h1>Thêm Sản Phẩm</h1>
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
        <?php echo $this->Form->hidden('id',array('class' => 'form-control','value' => !empty($product) ? $product['id'] : '' )); ?>
        <?php echo $this->Form->hidden('old_img',array('class' => 'form-control ','value' => !empty($product) ? $product['photo'] : '' )); ?>
        <?php echo $this->Form->hidden('old_key',array('class' => 'form-control ','value' => !empty($product) ? $product['name_key'] : '' )); ?>
        <?php echo $this->Form->hidden('images_remove',array('id' => 'images_remove','class' => 'form-control','value' => '' )); ?>
        <?php echo $this->Form->control('name',array('label' => 'Tên','class' => 'form-control name_sp','value' => !empty($product) ? $product['name'] : '' )); ?>
        <?php echo $this->Form->control('name_key',array('label' => 'Từ Khóa(Link)','class' => 'form-control name_key','value' => !empty($product) ? $product['name_key'] : '')); ?>
        
        <div class="input text class-pading-top">
        <label>Thể Loại</label>	
        <?php echo $this->Form->select('id_category', $categories,array('empty' => false,'class' => 'form-control','value' => !empty($product) ? $product['id_category'] : '')); ?>
        </div>

        <?php echo $this->Form->control('unit',array('label' => 'Đơn Vị','class' => 'form-control','placeholder'=>'VD: 10g X 1 Lọ','value' => !empty($product) ? $product['unit'] : '')); ?>
        <?php echo $this->Form->control('price',array('label' => 'Giá','class' => 'form-control','type' => 'number','value' => !empty($product) ? $product['price'] : '')); ?>
        <?php echo $this->Form->control('price_disscount',array('label' => 'Giá KM (giá trước khi giảm)','class' => 'form-control','type' => 'number','value' => !empty($product) ? $product['price_disscount'] : '')); ?>
        
        <div class="input text class-pading-top">
        <label>Type</label>	
        <?php echo $this->Form->select('type', $types,array('empty' => false,'class' => 'form-control','value' => !empty($product) ? $product['type'] : '')); ?>
        </div>

        <div class="input text class-pading-top">
            <label>Mô tả</label> 
            <textarea id="mytextarea" name="description"><?php echo !empty($product) ? $product['description'] : '' ?></textarea>
        </div>

        <?php echo $this->Form->control('photo_main',array('label' => 'Ảnh chính (600 x 400)','class' => 'form-control','type' => 'file','multiple' => true)); ?>
        <?php if(!empty( $product['photo'])): ?>
            <img width="200" height="200" src="<?php echo $this->Url->build('/webroot/photos/'.$product['id'].'/'.$product['photo'], ['fullBase' => false]); ?>">
        <?php endif; ?> 

        <div class="input text class-pading-top">
              <?php echo $this->Form->control('photo_extras[]',array('label' => 'Ảnh Phụ (6 tấm 600 x 400)','class' => 'form-control','type' => 'file','multiple' => 'multiple')); ?>
              <?php if(!empty($photos)): ?>
                <div id="exercise_image_preview">
                    <?php foreach($photos as $key => $photo): ?>
                    <div class="exercise_img_list  remove_img_old_<?php echo $key; ?>">
                        <img width="111" height="111" src="<?php echo $this->Url->build('/webroot/photos/'.$product['id'].'/'.$photo['image'], ['fullBase' => false]); ?>">
                        <span data-id="<?php echo $key; ?>" data-value="<?php echo $photo['image']; ?>" class="material-icons thumb-review-delete remove_img_old">X</span>
                    </div> 
                     <?php endforeach; ?>
                     <div class="clear"></div>
                </div>
              <?php endif; ?>
            <div class="clear"></div>  
        </div>   

        <div class="alert alert-danger error-message" style="display:none;" role="alert"></div>

       	<div class="input text class-pading-top">
       		 <a  class="btn button" href="javascript:void(0)" id="btn_save">Save</a>
       	</div>
       
     <?php $this->Form->end(); ?>



	</div>
</div

