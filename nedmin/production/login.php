<!DOCTYPE html>
<html>
<head>
	<title>Yönetim Paneli | Giriş</title>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="keywords" content="tolga bektaş, python , yazılım, programlama">
	<meta name="author" content="Tolga Bektaş">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="css/loginstyle.css">	
</head>
<body>
	<form class="box" action="../netting/islem.php" method="post">
		<h1>Yönetim Paneli</h1>
		<?php if(isset($_GET['durum'])){
			if ($_GET['durum']=="no") { ?>
				 <b style="color:white;">Hatalı Giriş...</b>
			<?php }
		} ?>
		<input type="email" name="kullanici_mail" placeholder="Mail">
		<input type="password" name="kullanici_password" placeholder="Şifre">
		<input type="submit" name="admingiris" value="Giriş">
	</form>

</body>
</html>