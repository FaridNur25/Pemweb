<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != TRUE){
        echo '<script>window.location="login.php"</script>';
    }
    $kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE category_id = '".$_GET['id']."'");
    if(mysqli_num_rows($kategori) == 0){
        echo '<script>window.location="data-kategori.php"</script>';
    }
    $k = mysqli_fetch_object($kategori);
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
			<h3>Tambah Data Kategori</h3>
			<div class="box">
				<form action="" method="POST">
                    <h4>Edit Kategori</h4>
                    <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" value="<?php echo $k-> category_name ?>" required>
                    <input type="submit" name="submit" value="Tambah Kategori" class="btn">
                </form>
                <?php 
                    if(isset($_POST['submit'])){

                        $nama = ucwords($_POST['nama']);
                        
                        $update = mysqli_query($conn,"UPDATE tb_category SET
                                            category_name = '".$nama."'
                                            WHERE category_id = '".$k->category_id."' ");
                        if($update){
                            echo '<script>alert("Edit Kategori Berhasil")</script>';
                            echo '<script>window.location="data-kategori.php"</script>';
                        }else{
                            echo 'gagal'.mysqli_error($conn) ;
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