<?php 
$helper = $this->loadHelper("core");
?>


<div class="admin-content">
<h1>Liên Hệ</h1>

<table>
	<tr>
		<th style="width: 20px;"><?php echo $this->Paginator->sort('id', 'ID') ?>*</th>
		<th><?php echo $this->Paginator->sort('name', 'Tên') ?>*</th>
		<th><?php echo $this->Paginator->sort('email', 'Email') ?>*</th>
		<th><?php echo 'Số điện thoại'; ?></th>
		<th><?php echo 'Ngày tạo'; ?></th>
		<th><?php echo 'Nội dung'; ?></th>
		<th><?php echo 'Xóa'; ?></th>
	</tr>
	<?php foreach($contacts as $contact): ?>
	<tr>
		<td><?php echo $contact['id']; ?></td>
		<td><?php echo $contact['name']; ?></td>
		<td><?php echo $contact['email']; ?></td>
		<td><?php echo $contact['phone']; ?></td>
		<td><?php 
                $date = new DateTime($contact['modified'], new DateTimeZone('GMT'));
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                 echo date("d/m/Y h:i A", $date->format('U'));
           ?>	</td>
		<td><?php echo $contact['message']; ?></td>
		<td style="text-align: center;">
			<a href="javascript:void(0)" onclick="deleteContact(<?php echo $contact['id'];?>)"  data-id="<?php echo $contact['id'];?>" ><?php echo 'Xóa'; ?></a>
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