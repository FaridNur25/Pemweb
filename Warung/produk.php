<?php
    error_reporting(0);
    include 'db.php';
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
            <h3>Produk</h3>
            <div class="box">
                    <?php 
                    $where = ""; 

                    if (isset($_GET['search']) && $_GET['search'] != '' || $_GET['kat'] != '') {
                        $where = "AND product_name LIKE '%" . $_GET['search'] . "%' AND category_id LIKE '%".$_GET['kat']."%'";
                    }
                    
                    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 $where
                                            ORDER BY product_id DESC");
                    if(mysqli_num_rows($produk) > 0){
                            while($p = mysqli_fetch_array($produk)){
                    ?>
                    <a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
                    <div class="col-4">
                        <img src="produk/<?php echo $p['product_image'] ?>" width="100%">
                        <p class="nama"><?php echo substr($p['product_name'], 0, 30)  ?></p>
                        <p class="harga">Rp. <?php echo $p['product_price'] ?></p>
                    </div>
                    </a>
                    <?php }}else{?>
                        <p>Produk Tidak Ada</p>
                    <?php } ?>
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