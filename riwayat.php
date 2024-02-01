
<?php

include 'config.php';
session_start();

include 'authcheckkasir.php';

$view = $dbconnect->query('SELECT * FROM transaksi');
// return var_dump($view);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Riwayat Transaksi</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<style>
	body {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #EFEBE9;
    background-color: #1565c0;
	}
	a {
		color: #EFEBE9;
		text-decoration: none;
	}
	.btn-primary {
		color: #fff;
		background-color: #607D8B;
		border-color: #2e6da4;
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

	<?php if (isset($_SESSION['success']) && $_SESSION['success'] != '') {?>

		<div class="alert alert-success" role="alert">
			<?=$_SESSION['success']?>
		</div>

	<?php
        }
        $_SESSION['success'] = '';
    ?>

    <h1>Riwayat Transaksi</h1>
    <a href="kasir.php?">Kembali</a>
	<table class="table table-bordered">
		<tr style="background-color:#607D8B">
			<th>#Nomor</th>
			<th>Tanggal</th>
			<th>Total</th>
			<th>Kasir</th>
			<th></th>
		</tr>
		<?php

        while ($row = $view->fetch_array()) { ?>

		<tr>
			<td> <?= $row['nomor'] ?> </td>
			<td><?= $row['tanggal_waktu'] ?></td>
			<td><?=$row['total']?></td>
			<td><?=$row['nama']?></td>
			<td>
                <a href="unduh_struk.php?idtrx=<?=$row['id_transaksi']?>" class="btn btn-primary">Lihat</a>
			</td>
		</tr>

		<?php }
        ?>

	</table>
</div>
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
</div>
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