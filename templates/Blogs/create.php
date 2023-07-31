<div class="admin-content">
<h1>Thêm Bài Viết</h1>
	<div class="container-admin">
		<?php
        echo $this->Form->create(null, [
        	'id' => 'frm_blog',
        	'url' => [
		        'controller' => 'Products
Blogs',
		        'action' => 'create'
		    ]
		]);
        ?>
        <?php echo $this->Form->hidden('id',array('class' => 'form-control','value' => !empty($blog) ? $blog['id'] : '' )); ?>
        <?php echo $this->Form->control('title',array('label' => 'Tên','class' => 'form-control name_sp','value' => !empty($blog) ? $blog['title'] : '' )); ?>
        <?php echo $this->Form->control('title_key',array('label' => 'Từ Khóa(Link)','class' => 'form-control name_key','value' => !empty($blog) ? $blog['title_key'] : '')); ?>
        <?php echo $this->Form->hidden('old_key',array('class' => 'form-control ','value' => !empty($blog) ? $blog['title_key'] : '' )); ?>
        <?php echo $this->Form->hidden('old_img',array('class' => 'form-control ','value' => !empty($blog) ? $blog['photo'] : '' )); ?>
        <div class="input text class-pading-top">
            <?php echo $this->Form->control('photo_main',array('label' => 'Ảnh chính (350 x 260)','class' => 'form-control','type' => 'file','multiple' => true)); ?>
            <?php if(!empty( $blog['photo'])): ?>
                <img width="200" height="200" src="<?php echo $this->Url->build('/webroot/photos/blogs/'.$blog['id'].'/'.$blog['photo'], ['fullBase' => false]); ?>">
            <?php endif; ?> 
        </div>
        <div class="input text class-pading-top">
            <label>Nội dung</label> 
            <textarea id="mytextareablog" name="description"><?php echo !empty($blog) ? $blog['description'] : '' ?></textarea>
        </div>

        <div class="alert alert-danger error-message" style="display:none;" role="alert"></div>

       	<div class="input text class-pading-top">
       		 <a  class="btn button" href="javascript:void(0)" id="btn_save_blogs">Save</a>
       	</div>
       
     <?php $this->Form->end(); ?>



	</div>
</div

