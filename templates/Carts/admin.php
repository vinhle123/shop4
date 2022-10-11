<?php 
$helper = $this->loadHelper("core");
?>


<div class="admin-content">
<h1>Quản Lý Đơn Hàng</h1>
<div class="container-admin">

	 <?php
        // Start the form
        echo $this->Form->create(null, [
		    'url' => [
		        'controller' => 'Carts',
		        'action' => 'admin'
		    ]
		]);
        ?>
       	<input style="min-width: 300px;" type="" name="search" id="key_search_sp_admin" placeholder="Tên,sdt,code,email">
        <button  class="btn button" type="submit">Search</button>
     <?php $this->Form->end(); ?>


	
</div>

<table>
	<tr>
		<th style="width: 20px;"><?php echo $this->Paginator->sort('id', 'ID') ?>*</th>
		<th><?php echo $this->Paginator->sort('code', 'Code') ?></th>
		<th><?php echo $this->Paginator->sort('name', 'Tên KH') ?></th>
		<th><?php echo $this->Paginator->sort('phone', 'SDT') ?></th>
		<th><?php echo $this->Paginator->sort('email', 'Email') ?></th>
		<th><?php echo $this->Paginator->sort('address', 'Địa chỉ') ?></th>
		<th><?php echo $this->Paginator->sort('note', 'Note') ?></th>
		<th><?php echo $this->Paginator->sort('method', 'Phương thức thanh toán') ?></th>
		<th><?php echo $this->Paginator->sort('created', 'Ngày tạo') ?></th>
		<th><?php echo $this->Paginator->sort('modified', 'Ngày hoạt động') ?></th>
		<th><?php echo $this->Paginator->sort('status', 'Trạng Thái') ?></th>
		<th><?php echo 'Chi tiết'; ?></th>
	</tr>
	<?php foreach($orders as $order): ?>
	<tr>
		<td><?php echo $order['id']; ?></td>
		<td><?php echo $order['code']; ?></td>
		<td><?php echo $order['name']; ?></td>
		<td><?php echo $order['phone']; ?></td>
		<td><?php echo $order['email']; ?></td>
		<td><?php echo $order['address']; ?></td>
		<td><?php echo $order['note']; ?></td>
		<td><?php echo $order['method']; ?></td>
		<td>
			<?php 
                $date = new DateTime($order['created'], new DateTimeZone('GMT'));
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                 echo date("d/m/Y h:i A", $date->format('U'));
           ?>	
			</td>
		<td>

			<?php 
                $date = new DateTime($order['modified'], new DateTimeZone('GMT'));
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                 echo date("d/m/Y h:i A", $date->format('U'));
           ?>	
			</td>
		<td>

			<select style="color: <?php if($order['status'] == STATUS_PEDDING){echo 'red';}elseif ($order['status'] == STATUS_CONFIRM) {echo 'blue';}else{echo 'green';} ?>" class="order_select" data-id = '<?php echo $order['id']; ?>' >
				<option <?php if($order['status'] == STATUS_PEDDING){echo 'selected';} ?> value="<?php echo STATUS_PEDDING; ?>"><?php echo 'Đơn hàng mới';  ?></option>
				<option <?php if($order['status'] == STATUS_CONFIRM){echo 'selected';} ?> value="<?php echo STATUS_CONFIRM; ?>"><?php echo 'Đã xác nhận';  ?></option>
				<option <?php if($order['status'] == STATUS_SUCCESS){echo 'selected';} ?> value="<?php echo STATUS_SUCCESS; ?>"><?php echo 'Thành công';  ?></option>
			</select>
		</td>
		<td style="text-align: center;">
			<a href="<?php echo $this->Url->build('/carts/detail/'.$order['id'], ['fullBase' => true]);  ?>"><?php echo 'Xem chi tiết'; ?></a>
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