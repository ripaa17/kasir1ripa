
<?php
include 'config.php';
session_start();
// remove all session variables
// session_unset();

// print_r($_SESSION);

if (isset($_POST['masuk'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($dbconnect, "SELECT * FROM user WHERE username='$username' and password='$password'");

    //mendapatkan hasil dari data
    $data = mysqli_fetch_assoc($query);
    // return var_dump($data);

    //mendapatkan nilai jumlah data
    $check = mysqli_num_rows($query);
    // return var_dump($check);

    if (!$check) {
        $_SESSION['error'] = 'Username & password salah';
    } else {
        $_SESSION['userid'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role_id'] = $data['role_id'];

        header('location:index.php');
    }
}

?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
		<meta name="generator" content="Jekyll v4.0.1">
		<title>Masuk Dulu ya!!</title>

		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<style>
			body {
            background-color: #212529; 
        }
        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: auto;
			color: #f5f5f5;
        }
        .form-signin .checkbox {
            font-weight: 400;
        }
        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="text"],
        .form-signin input[type="password"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="checkbox"] {
            margin-bottom: 10px;
        }
        .form-signin input[type="submit"] {
            font-size: 16px;
        }
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
			font-size: 3.5rem;
			}
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
    <!-- Custom styles for this template -->
    <link href="/css/signin.css" rel="stylesheet">
  	</head>
	<body class="text-center" style="background-color: #212529;">
		<form method="post" class="form-signin">
			<img class="mb-4" src="image/cewe.png" alt="" width="200" height="200">
			<!-- Alert -->
			<?php if (isset($_SESSION['error']) && $_SESSION['error'] != '') { ?>
				<div class="alert alert-danger" role="alert">
					<?=$_SESSION['error']?>
				</div>
			<?php }
                $_SESSION['error'] = '';
            ?>
			<h1 class="h3 mb-3 font-weight-normal">Sign in Dulu Yaa>.<</h1>
            <br>
			<label for="inputEmail" class="sr-only">Username</label>
			<input type="text" class="form-control" name="username" placeholder="Username">
            <br>
            <div class="loading-overlay" id="loadingOverlay">
                <div class="loading-spinner"></div>
            </div>

			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" class="form-control" name="password" placeholder="Password">
			<br>
            <div class="checkbox mb-3">
				<label>
					<input type="checkbox" value="remember-me"> Sudah
				</label>
			</div>
			<input type="submit" name="masuk" value="Sign in" class="btn btn-lg btn-primary btn-block"/>
			<p class="mt-5 mb-3 text-muted">&copy; Saripah - 20221310044</p>
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

                // Simulasikan proses loading selama 2,5 detik
                setTimeout(function() {
                    // Sembunyikan loading setelah 2,5 detik
                    hideLoading();
                }, 2500);
            </script>
		</form>
	</body>
</html>


