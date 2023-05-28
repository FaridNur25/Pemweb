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
			<h3>Data Kategori</h3>
			<div class="box">
				<p><a href="tambah-kategori.php" class="btn">Tambah kategori</a></p>
				<br>
				<table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Kategori</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php
							$no = 1;
							$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
							while($row = mysqli_fetch_array($kategori)){
								
							
						?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['category_name']?></td>
                            <td>
                                <a href="edit_kategori.php?id=<?php echo $row['category_id']?>">Edit</a> || <a href="proses-hapus.php?idk=<?php echo $row['category_id']?>" onclick="return confirm('Yakin ingin dihapus ?')">Hapus</a>
                            </td>
                        </tr>
						<?php }}else{ ?>
							<tr> 
								<td colspan="3">Tidak ada data</td>
						</tr>
                    </tbody>
                </table>
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