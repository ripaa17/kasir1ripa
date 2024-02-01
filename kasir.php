<?php
include 'config.php';
session_start();
include 'authcheckkasir.php';

$barang = mysqli_query($dbconnect, 'SELECT * FROM barang');
// print_r($_SESSION);

$sum = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        $sum += ($value['harga'] * $value['qty']) - $value['diskon'];
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Kasir</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<style>
	body {
    background-color: #1565c0; 
	font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #f5f5f5;
        }
	a {
    color: #EFEBE9;
    text-decoration: none;
	}

	.loading-overlay {
		display: none;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: rgba(255, 255, 255, 0.7);
		z-index: 9999;
	}

	.loading-spinner {
		border: 16px solid #f3f3f3;
		border-top: 16px solid #3498db;
		border-radius: 50%;
		width: 80px;
		height: 80px;
		position: absolute;
		top: 50%;
		left: 50%;
		margin-top: -40px;
		margin-left: -40px;
		animation: spin 1s linear infinite;
	}

	@keyframes spin {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(360deg); }
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Kasir</h1>
			<h2>Hai <?=$_SESSION['nama']?></h2>
			<a href="logout.php">Logout</a> |
			<a href="keranjang_reset.php">Reset Keranjang</a> |
			<a href="riwayat.php">Riwayat Transaksi</a>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-8">
			<form method="post" action="keranjang_act.php">
				<div class="form-group">
					<input type="text" name="kode_barang" class="form-control" placeholder="Masukkan Kode Barang" autofocus>
				</div>
			</form>
			<br>
			<form method="post" action="keranjang_update.php">
			<table class="table table-bordered">
				<tr>
					<th>Nama</th>
					<th>Harga</th>
					<th>Qty</th>
					<th>Sub Total</th>
					<th></th>
				</tr>
				<?php if (isset($_SESSION['cart'])): ?>
				<?php foreach ($_SESSION['cart'] as $key => $value) { ?>
					<tr>
						<td>
							<?=$value['nama']?>
							<?php if ($value['diskon'] > 0): ?>
								<br><small class="label label-danger">Diskon <?=number_format($value['diskon'])?></small>
							<?php endif;?>
						</td>
						<td align="right"><?=number_format($value['harga'])?></td>
						<td class="col-md-2">
							<input type="number" name="qty[<?=$key?>]" value="<?=$value['qty']?>" class="form-control">
						</td>
						<td align="right"><?=number_format(($value['qty'] * $value['harga'])-$value['diskon'])?></td>
						<td><a href="keranjang_hapus.php?id=<?=$value['id']?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a></td>
					</tr>
				<?php } ?>
				<?php endif; ?>
			</table>
			<button type="submit" class="btn btn-success">Perbaruhi</button>
			</form>
		</div>
		<div class="loading-overlay" id="loadingOverlay">
			<div class="loading-spinner"></div>
		</div>

		<div class="col-md-4">
			<h3>Total Rp. <?=number_format($sum)?></h3>
			<form action="transaksi_act.php" method="POST">
				<input type="hidden" name="total" value="<?=$sum?>">
			<div class="form-group">
				<label>Bayar</label>
				<input type="text" id="bayar" name="bayar" class="form-control">
			</div>
			<button type="submit" class="btn btn-primary">Selesai</button>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">

	//inisialisasi inputan
	var bayar = document.getElementById('bayar');

	bayar.addEventListener('keyup', function (e) {
        bayar.value = formatRupiah(this.value, 'Rp. ');
        // harga = cleanRupiah(dengan_rupiah.value);
        // calculate(harga,service.value);
    });

    //generate dari inputan angka menjadi format rupiah

	function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    //generate dari inputan rupiah menjadi angka

    function cleanRupiah(rupiah) {
        var clean = rupiah.replace(/\D/g, '');
        return clean;
        // console.log(clean);
    }
</script>
<script>
	// Fungsi untuk menampilkan loading overlay
	function showLoading() {
		document.getElementById('loadingOverlay').style.display = 'block';
	}

	// Fungsi untuk menyembunyikan loading overlay
	function hideLoading() {
		document.getElementById('loadingOverlay').style.display = 'none';
	}

	// Contoh penggunaan: Tampilkan loading saat halaman dimuat
	showLoading();

	// Simulasikan proses loading selama 1 detik
	setTimeout(function() {
		// Sembunyikan loading setelah 1 detik
		hideLoading();
	}, 1000);

</script>
</body>
</html>