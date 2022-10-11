<?php 
$helper = $this->loadHelper("core");
?>

<div class="admin-content">
<h1>Chi Tiết Đơn Hàng</h1>

<?php 
    $date = new DateTime($order['created'], new DateTimeZone('GMT'));
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $created = date("d/m/Y h:i A", $date->format('U'));

    $total = 0;
    foreach($items as $item1){
    	$total += $item1['quality']*$item1['product']['price'];
    }

?>	

<div>
	<p><b>Code:</b> <?php echo $order['code'] ?></p>
	<p><b>Tên KH:</b> <?php echo $order['name'] ?></p>
	<p><b>SDT:</b> <?php echo $order['phone'] ?></p>
	<p><b>Email:</b> <?php echo $order['email'] ?></p>
	<p><b>Địa chỉ:</b> <?php echo $order['address'] ?></p>
	<p><b>Note:</b> <?php echo $order['note'] ?></p>
	<p><b>Phương thức thanh toán:</b> <?php echo $order['method'] ?></p>
	<p><b>Ngày tạo:</b> <?php echo $created ?></p>
	<p><b>Trạng Thái:</b> <?php if($order['status'] == STATUS_PEDDING){echo 'Đơn hàng mới';}elseif ($order['status'] == STATUS_CONFIRM) {echo 'Đã xác nhận';}else{echo 'Thành công';} ?></p>
	<p><b>Tổng sản phẩm:</b> <?php echo count($items) ?></p>
	<p><b>Tổng giá trị đơn hàng:</b> <?php echo $helper->price($total); ?></p>
</div>

<table>
	<tr>
		<th style="width: 20px;"><?php echo $this->Paginator->sort('id', 'ID') ?>*</th>
		<th>Hình</th>
		<th>Tên</th>
		<th>Giá</th>
		<th>Số lượng</th>
		<th>Tổng</th>
		
	</tr>
	<?php foreach($items as $item): ?>
	<tr>
		<td><?php echo $item['id']; ?></td>
		<td><img style="width: 50px;height: 50px;" src="<?php echo $this->Url->build('/webroot/photos/'.$item['product']['id'].'/'.$item['product']['photo'], ['fullBase' => false]); ?>" alt="<?php echo $item['product']['name']; ?>"></td>
		<td><?php echo $item['product']['name']; ?></td>
		<td><?php echo $helper->price($item['product']['price']); ?></td>
		<td><?php echo $item['quality']; ?></td>
		<td><?php echo $helper->price($item['quality']*$item['product']['price']); ?></td>
	</tr>
	<?php endforeach; ?>
</table>
</div>