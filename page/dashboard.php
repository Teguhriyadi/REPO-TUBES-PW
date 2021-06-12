<section class="services" id="tampil">
	
</section>


<script type="text/javascript">
	function tampil_tipe_kamar() {
		let xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				let data = JSON.parse(xhttp.responseText);
				data.forEach(function(element) {
					document.getElementById("tampil").innerHTML += '<div class="service"> <div class="icon"></div> <h3>'+element.tipe_kamar+'</h3> <br> <p>'+element.deskripsi+'</p> </div>';
				});
			}
		};
		xhttp.open("GET", "http://localhost/REPO-TUBES-PW/admin/page/tipe_kamar/ajax.php?request=1", true);
		xhttp.send();
	}

	tampil_tipe_kamar();
</script>