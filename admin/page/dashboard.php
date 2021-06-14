<div class="header">
	<span class="icon"><i class="fa fa-home"></i></span>
	<span class="title">Dashboard</span>
</div>

<div class="cardBox">
	<div class="card">
		<div>
			<div class="numbers">
				<?php
					$sql = "SELECT * FROM tipe_kamar";
					$query = mysqli_query($con,$sql);
					$count = mysqli_num_rows($query);
					echo $count;
				?>
			</div>
			<div class="cardName">Tipe Kamar</div>
		</div>
		<div>
			<div class="iconBox"><i class="fa fa-bars"></i></div>
		</div>
	</div>
	<div class="card">
		<div>
			<div class="numbers">
				<?php
					$sql = "SELECT * FROM kamar";
					$query = mysqli_query($con,$sql);
					$count = mysqli_num_rows($query);
					echo $count;
				?>
			</div>
			<div class="cardName">Kamar</div>
		</div>
		<div>
			<div class="iconBox"><i class="fa fa-map"></i></div>
		</div>
	</div>
	<div class="card">
		<div>
			<div class="numbers">
				<?php
					$sql = "SELECT * FROM tamu";
					$query = mysqli_query($con,$sql);
					$count = mysqli_num_rows($query);
					echo $count;
				?>
			</div>
			<div class="cardName">Tamu</div>
		</div>
		<div>
			<div class="iconBox"><i class="fa fa-user"></i></div>
		</div>
	</div>
	<div class="card">
		<div>
			<div class="numbers">
				<?php
					$sql = "SELECT * FROM reservasi";
					$query = mysqli_query($con,$sql);
					$count = mysqli_num_rows($query);
					echo $count;
				?>
			</div>
			<div class="cardName">Reservasi</div>
		</div>
		<div>
			<div class="iconBox"><i class="fa fa-edit"></i></div>
		</div>
	</div>
	<div class="card">
		<div>
			<div class="numbers">
				<?php
					$sql = "SELECT * FROM transaksi";
					$query = mysqli_query($con,$sql);
					$count = mysqli_num_rows($query);
					echo $count;
				?>
			</div>
			<div class="cardName">Transaksi</div>
		</div>
		<div>
			<div class="iconBox"><i class="fa fa-money"></i></div>
		</div>
	</div>
	<div class="card">
		<div>
			<div class="numbers">
				<?php
					$sql = "SELECT * FROM users";
					$query = mysqli_query($con,$sql);
					$count = mysqli_num_rows($query);
					echo $count;
				?>
			</div>
			<div class="cardName">Users</div>
		</div>
		<div>
			<div class="iconBox"><i class="fa fa-users"></i></div>
		</div>
	</div>
</div>