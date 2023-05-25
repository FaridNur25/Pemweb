<?php
    error_reporting(0);
    include 'db.php';

    $kontak = mysqli_query($conn, "SELECT admin_telp FROM tb_admin WHERE admin_id = 1 ");
    $a =mysqli_fetch_object($kontak);
    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."'");
    $p = mysqli_fetch_object($produk);
    

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" conteent="width-device-width, initial-scale=1">
	<title>Toko Mugi Jaya</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicsand&display=swap" rel="stylesheet">
</head>
<body>
	<header>
		<div class="container">
		<h1><a href="index.php">Toko Mugi Jaya</a></h1>
		<u1>
			<li><a href="produk.php">Produk</a></li>
		</u1>
		</div>
	</header>

    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <h3>Detail Produk</h3>
            <div class="box">
                <div class="col-2">
                    <img src="produk/<?php echo $p->product_image ?>" width="100%">
                </div>
                <div class="col-2">
                    <h4><?php echo $p->product_name ?></h4>
                    <h4>Rp. <?php echo number_format($p->product_price) ?></h4>
                    <br>
                    <p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text=Hai, saya tertarik membeli (isi nama produk)." target="_blank">Hubungi Via WhatsApp</a></p>
                </div>
            </div>
        </div>
    </div>

	<footer>
		<div class="container">
			<small>Copyright &copy; 2023 - Warung Web (Farid Nurtaufiq) </small>
		</div>
	</footer>
</body>
</html>