<?php 
$helper = $this->loadHelper("core");
?>


<div class="admin-content">
<h1>Quản Lý Blogs</h1>
<div class="container-admin">

	 <?php
        // Start the form
        echo $this->Form->create(null, [
		    'url' => [
		        'controller' => 'Blogs',
		        'action' => 'admin'
		    ]
		]);
        ?>

       	<input style="min-width: 300px;" type="" name="search" id="key_search_sp_admin" placeholder="Tên bài viết">
        <button  class="btn button" type="submit">Search</button>
     <?php $this->Form->end(); ?>


	
</div>
<div>
	<a href="<?php echo $this->Url->build('/blogs/create', ['fullBase' => true]);  ?>" style="margin-bottom: 10px;" class="btn button" href="">Thêm Bài Viết</a>
</div>


<table>
	<tr>
		<th style="width: 20px;"><?php echo $this->Paginator->sort('id', 'ID') ?>*</th>
		<th><?php echo $this->Paginator->sort('title', 'Tiêu đề') ?>*</th>
		<th><?php echo $this->Paginator->sort('title_key', 'Từ Khóa') ?>*</th>
		<th><?php echo 'Xem | Chỉnh Sửa | Xóa'; ?></th>
	</tr>
	<?php foreach($blogs as $blog): ?>
	<tr>
		<td><?php echo $blog['id']; ?></td>
		<td><a target="_blank" href="<?php echo  $this->Url->build('/thong-tin/'.$blog['title_key'], ['fullBase' => true]); ?>"><?php echo $blog['title']; ?></a></td>
		
		<td><?php echo $blog['title_key']; ?></td>
		<td style="text-align: center;">
			<a target="_blank" href="<?php echo $this->Url->build('/thong-tin/'.$blog['title_key'], ['fullBase' => true]);  ?>"><?php echo 'Xem'; ?></a> | <a href="<?php echo $this->Url->build('/blogs/create/'.$blog['id'], ['fullBase' => true]);  ?>"><?php echo 'Sửa'; ?></a> | <a href="javascript:void(0)" onclick="deleteBlog(<?php echo $blog['id'];?>)"  data-id="<?php echo $blog['id'];?>" ><?php echo 'Xóa'; ?></a>
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