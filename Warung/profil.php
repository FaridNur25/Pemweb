<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != TRUE){
        echo '<script>window.location="login.php"</script>';
    }

    $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."' ");
    $d = mysqli_fetch_object($query);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" conteent="width-device-width, initial-scale=1">
	<title>Toko Mugi Jaya</title>
	<link rel="stylesheet" type="text/css" href="css/dcdk.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicsand&display=swap" rel="stylesheet">
</head>
<body>
	<header>
		<div class="container">
		<h1><a href="dashboard.php">Toko Mugi Jaya</a></h1>
		<u1>
			<li><a href="dashboard.php">Dashboard</a></li>
			<li><a href="profil.php">Profil</a></li>
			<li><a href="data-kategori.php">Data Kategori</a></li>
			<li><a href="data-produk.php">Data Produk</a></li>
			<li><a href="keluar.php">Keluar</a></li>
		</u1>
		</div>
	</header>

	<div class="section">
		<div class="container">
			<h3>Profil</h3>
			<div class="box">
				<form action="" method="POST">
                    <h4>Nama Lengkap</h4>
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name ?>" required>
                    <h4>Username</h4>
                    <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username ?>" required>
                    <h4>Nomor Telepon</h4>
                    <input type="text" name="hp" placeholder="No HP" class="input-control" value="<?php echo $d->admin_telp ?>" required>
                    <input type="submit" name="submit" value="Ubah Profil" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])){
                        $nama = ucwords($_POST['nama']);
                        $user = $_POST['user'];
                        $hp   = $_POST['hp'];

                        $update = mysqli_query($conn, "UPDATE tb_admin SET
                                        admin_name = '".$nama."',
                                        username = '".$user."',
                                        admin_telp = '".$hp."'
                                        WHERE admin_id = '".$d->admin_id."'");
                        if($update){
                            echo '<script>alert("Profil Berhasil Diubah!")</script>';
                            echo '<script>window.location="profil.php"</script>';
                        }else{
                            echo 'gagal' .mysqli_error($conn);
                        }
                    }
                ?>
			</div>

            <h3>Ubah Password</h3>
			<div class="box">
				<form action="" method="POST">
                    <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                    <input type="password" name="pass2" placeholder="Konfirmasi Password" class="input-control" required>
                    <input type="submit" name="ubah_password" value="Ubah Password" class="btn">
                </form>
                <?php
                    if(isset($_POST['ubah_password'])){
                        $pass1 = $_POST['pass1'];
                        $pass2 = $_POST['pass2'];

                        if($pass2 != $pass1){
                            echo '<script>alert("Konfirmasi Password Baru Tidak Sesuai")</script>';
                        }else{
                            $upass = mysqli_query($conn, "UPDATE tb_admin SET
                                        password = '".md5($pass1)."'
                                        WHERE admin_id = '".$d->admin_id."'");
                            if($upass){
                                echo '<script>alert("Password Berhasil Diubah!")</script>';
                                echo '<script>window.location="profil.php"</script>';
                            }else{
                                echo 'gagal' .mysqli_error($conn);
                            }
                        }
                    }
                ?>
			</div>
		</div>

	<footer>
		<div class="container">
			<small>Copyright &copy; 2023 - Warung Web (Farid Nurtaufiq) </small>
		</div>
	</footer>
</body>
</html>