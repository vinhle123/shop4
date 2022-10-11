<?php 
$helper = $this->loadHelper("core");
?>


<div class="admin-content">
<h1>Quản Lý Thể Loại</h1>
<div class="container-admin">

	 <?php
        echo $this->Form->create(null, [
		    'url' => [
		        'controller' => 'Categories',
		        'action' => 'admin'
		    ]
		]);
        ?>

       	<input style="min-width: 300px;" type="" name="search" id="key_search_sp_admin" placeholder="Tên thể loại">
        <button  class="btn button" type="submit">Search</button>
     <?php $this->Form->end(); ?>


	
</div>
<div>
	<a href="<?php echo $this->Url->build('/categories/create', ['fullBase' => true]);  ?>" style="margin-bottom: 10px;" class="btn button" href="">Thêm Thể Loại</a>
</div>


<table>
	<tr>
		<th style="width: 20px;"><?php echo $this->Paginator->sort('id', 'ID') ?>*</th>
		<th><?php echo $this->Paginator->sort('name', 'Tên') ?>*</th>
		<th><?php echo $this->Paginator->sort('name_key', 'Từ Khóa') ?>*</th>
		<th><?php echo 'Số lượng sản phẩm'; ?></th>
		<th><?php echo 'Ảnh'; ?></th>
		<th><?php echo 'Hiển thị trang chủ'; ?></th>
		<th><?php echo 'Chỉnh Sửa | Xóa'; ?></th>
	</tr>
	<?php foreach($categories as $category): ?>
	<tr>
		<td><?php echo $category['id']; ?></td>
		<td><?php echo $category['name']; ?></td>
		<td><?php echo $category['name_key']; ?></td>
		<td><?php echo $category['totol_product']; ?></td>
		<td>
			<?php if(!empty($category['photo'])): ?>
			<img width="100" height="100" src="<?php echo $this->Url->build('/webroot/photos/categories/'.$category['photo'], ['fullBase' => false]); ?>">
			<?php endif; ?>
		</td>
		<td><?php echo $category['home']; ?></td>
		<td style="text-align: center;">
			<a href="<?php echo $this->Url->build('/categories/create/'.$category['id'], ['fullBase' => true]);  ?>"><?php echo 'Sửa'; ?></a> | <a href="javascript:void(0)" onclick="deleteCategory(<?php echo $category['id'];?>)"  data-id="<?php echo $category['id'];?>" ><?php echo 'Xóa'; ?></a>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<ul class="pagination">
	<?php echo $this->Paginator->prev("<"); ?>
	<?php echo $this->Paginator->numbers(); ?>
	<?php echo $this->Paginator->next(">"); ?>
</ul>
</div>