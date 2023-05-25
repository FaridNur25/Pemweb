<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != TRUE){
        echo '<script>window.location="login.php"</script>';
    }
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
			<h3>Tambah Data Produk</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
                    <h4>Nama Kategori</h4>
                    <select class="input-control" name="kategori" required>
                        <option value="">--Pilih Kategori--</option>
                        <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
                        <?php } ?>
                    </select>
                    
                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                    <input type="file" name="gambar" class="input-control" required>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="Tambah Produk" class="btn">
                </form>
                <?php 
                    if(isset($_POST['submit'])){
                        //print_r($_FILES['gambar']);
                        $kategori   = $_POST['kategori'];
                        $nama       = $_POST['nama'];
                        $harga      = $_POST['harga'];
                        $status     = $_POST['status'];

                        $filename   = $_FILES['gambar']['name'];
                        $tmp_name   = $_FILES['gambar']['tmp_name'];

                        $type1      = explode('.', $filename);
                        $type2      = $type1[1];

                        $newname    = 'produk'.time().'.'.$type2;

                        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                        if(!in_array($type2, $tipe_diizinkan)){
                            echo '<script>alert(Format file tidak diizinkan)</script>';
                        }else{
                            move_uploaded_file($tmp_name, './produk/'.$newname);
                            $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
                                        null,
                                        '".$kategori."',
                                        '".$nama."',
                                        '".$harga."',
                                        '".$newname."',
                                        '".$status."',
                                        null
                                            )");   
                            if($insert){
                                echo '<script>alert("Produk Berhasil Ditambah")</script>';
                                echo '<script>window.location="data-produk.php"</script>';
                            }else{
                                echo 'gagal'.mysqli_error($conn) ;
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