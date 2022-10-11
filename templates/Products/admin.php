<?php 
$helper = $this->loadHelper("core");
?>


<div class="admin-content">
<h1>Quản Lý Sản Phẩm</h1>
<div class="container-admin">

	 <?php
        // Start the form
        echo $this->Form->create(null, [
		    'url' => [
		        'controller' => 'Products',
		        'action' => 'admin'
		    ]
		]);
        ?>

       	<input style="min-width: 300px;" type="" name="search" id="key_search_sp_admin" placeholder="Tên sản phẩm">
        <button  class="btn button" type="submit">Search</button>
     <?php $this->Form->end(); ?>


	
</div>
<div>
	<a href="<?php echo $this->Url->build('/products/create', ['fullBase' => true]);  ?>" style="margin-bottom: 10px;" class="btn button" href="">Thêm Sản Phẩm</a>
</div>


<table>
	<tr>
		<th style="width: 20px;"><?php echo $this->Paginator->sort('id', 'ID') ?>*</th>
		<th><?php echo 'Hình'; ?></th>
		<th><?php echo $this->Paginator->sort('name', 'Tên') ?>*</th>
		<th><?php echo $this->Paginator->sort('name_key', 'Từ Khóa') ?>*</th>
		<th><?php echo $this->Paginator->sort('id_category', 'Thể Loại') ?>*</th>
		<th><?php echo $this->Paginator->sort('unit', 'Đơn Vị') ?>*</th>
		<th><?php echo $this->Paginator->sort('price', 'Giá') ?>*</th>
		<th><?php echo $this->Paginator->sort('price_disscount', 'Giá KM') ?>*</th>
		<th><?php echo $this->Paginator->sort('type', 'Type') ?>*</th>
		<th><?php echo 'Chỉnh Sửa | Xóa'; ?></th>
	</tr>
	<?php foreach($products as $product): ?>
	<tr>
		<td><?php echo $product['id']; ?></td>
		<td>
			<img style="width: 50px;height: 50px;" src="<?php echo $this->Url->build('/webroot/photos/'.$product['id'].'/'.$product['photo'], ['fullBase' => false]); ?>" alt="<?php echo $product['name']; ?>">
		</td>
		<td><a target="_blank" href="<?php echo  $this->Url->build('/san-pham/'.$product['name_key'], ['fullBase' => true]); ?>"><?php echo $product['name']; ?></a></td>
		
		<td><?php echo $product['name_key']; ?></td>
		<td><?php echo $product['category']['name']; ?></td>
		<td><?php echo $product['unit']; ?></td>
		<td><?php echo $helper->price($product['price']); ?></td>
		<td><?php echo $helper->price($product['price_disscount']); ?></td>
		<td><?php 
			if($product['type'] == TYPE_KM){
				echo 'Khuyến Mãi'; 
			}elseif ($product['type'] == TYPE_BANCHAY) {
				echo 'Bán Chạy'; 
			}
			
		?></td>
		<td style="text-align: center;">
			<a href="<?php echo $this->Url->build('/products/create/'.$product['id'], ['fullBase' => true]);  ?>"><?php echo 'Sửa'; ?></a> | <a href="javascript:void(0)" onclick="deleteProduct(<?php echo $product['id'];?>)"  data-id="<?php echo $product['id'];?>" ><?php echo 'Xóa'; ?></a>
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