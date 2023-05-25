<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != TRUE){
        echo '<script>window.location="login.php"</script>';
    }

    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."'");
    $p = mysqli_fetch_object($produk);
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
			<h3>Edit Data Produk</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
                    <h4>Nama Kategori</h4>
                    <select class="input-control" name="kategori" required>
                        <option value="">--Pilih Kategori--</option>
                        <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $p->category_id)? 'selected':'' ?>><?php echo $r['category_name']?></option>
                        <?php } ?>
                    </select>
                    
                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $p->product_name ?>" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->product_price ?>" required>
                    <img src="produk/<?php echo $p->product_image ?>" width="100px">
                    <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                    <input type="file" name="gambar" class="input-control">
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1" <?php echo ($p->product_status == 1)? 'selected':''; ?>>Aktif</option>
                        <option value="0" <?php echo ($p->product_status == 0)? 'selected':''; ?>>Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="Tambah Produk" class="btn">
                </form>
                <?php 
                    if(isset($_POST['submit'])){
                        $kategori   = $_POST['kategori'];
                        $nama       = $_POST['nama'];
                        $harga      = $_POST['harga'];
                        $status     = $_POST['status'];
                        $foto       = $_POST['foto'];
                        
                        $filename   = $_FILES['gambar']['name'];
                        $tmp_name   = $_FILES['gambar']['tmp_name'];

                        
                        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                        if($filename != ''){
                            $type1      = explode('.', $filename);
                            $type2      = $type1[1];

                            $newname    = 'produk'.time().'.'.$type2;

                            if(!in_array($type2, $tipe_diizinkan)){
                                echo '<script>alert(Format file tidak diizinkan)</script>';
                            }else{
                                unlink('./produk/.$foto');
                                move_uploaded_file($tmp_name, './produk/'.$newname);
                                $namagambar = $newname;
                            }    
                        }else{

                            $namagambar = $foto;

                        }

                        $update = mysqli_query($conn, "UPDATE tb_product SET
                                                category_id = '".$kategori."',
                                                product_name = '".$nama."',
                                                product_price = '".$harga."',
                                                product_image = '".$namagambar."',
                                                product_status = '".$status."'
                                                WHERE product_id = '".$p->product_id."'");
                        if($update){
                                echo '<script>alert("Produk Berhasil Diedit")</script>';
                                echo '<script>window.location="data-produk.php"</script>';
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
</html>x