<?php
	$id_tipe = $_GET['id_tipe_kamar'];
	$query = $con->query("SELECT * FROM tipe_kamar WHERE id_tipe = $id_tipe ");

	foreach ($query as $data) {
		# code...
	}

?>
<div class="row">
	<div class="leftcolumn">
		<div class="card">
			<h2 align="center"> <?php echo $data['tipe_kamar'] ?> </h2>
			<br>
			<img style="height: 550px;" src="admin/image/<?php echo $data['image']; ?>">
			<p>Fasilitas:</p>
			<p>
				<?php echo $data['fasilitas'] ?>
			</p>
			<br>
			<hr>
			<br>
			<a href="?page=booking&id_tipe=<?php echo $id_tipe ?>">
				booking
			</a>
		</div>
	</div>
</div>