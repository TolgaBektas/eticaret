<?php
include 'header.php';
if (isset($_SESSION['userkullanici_mail'])) {
	
	

	$siparisdetaysor=$db->prepare("SELECT * FROM siparis where kullanici_id=:kullanici_id");
	$siparisdetaysor->execute(array(
		'kullanici_id'=>$kullanicicek['kullanici_id']

	));
	?>


	<div class="container">
		<?php if (isset($_POST['siparisdetay'])) { 
			$siparisdetaysor=$db->prepare("SELECT * FROM siparisdetay where siparis_id=:siparis_id");
			$siparisdetaysor->execute(array(
				'siparis_id'=>$_POST['siparis_id']
			));

			?>
			<div class="title-bg">
				<div class="title">Siparişlerim - Detay
					<?php
					if (isset($_GET['durum'])) {
						if ($_GET['durum']=="ok") {?>
							<b style="color:green;">İşlem Başarılı...</b>
						<?php   }  elseif ($_GET['durum']=="no") {?>
							<b style="color:red;">İşlem Başarısız...</b>
						<?php }
					}  ?>
				</div>
			</div>


			<div class="table-responsive">
				<table class="table table-bordered chart">
					<thead>
						<tr>
							<th>Ürün Kodu</th>					
							<th>Ürün Adı</th>
							<th>Ürün Adet</th>

							<th>Toplam Fiyat</th>
						</tr>
					</thead>
					<tbody>

						<?php while($sipariscek=$siparisdetaysor->fetch(PDO::FETCH_ASSOC)){ ?>
							<tr>
								<td><?php echo $sipariscek['urun_id'] ?></td>
								<?php 
								$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:urun_id");
								$urunsor->execute(array(
									'urun_id'=>$sipariscek['urun_id']
								));
								$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
								?>
								<td><?php echo $uruncek['urun_ad'] ?></td>
								<td><?php echo $sipariscek['urun_adet'] ?></td>
								<td><?php echo $sipariscek['urun_fiyat'] ?> ₺</td>
							</tr>
						<?php }
						?>

					</tbody>
				</table>
			</div>

			<div class="spacer"></div>
		<?php }else{ ?>
			<div class="title-bg">
				<div class="title">Siparişlerim
					<?php
					if (isset($_GET['durum'])) {
						if ($_GET['durum']=="ok") {?>
							<b style="color:green;">İşlem Başarılı...</b>
						<?php   }  elseif ($_GET['durum']=="no") {?>
							<b style="color:red;">İşlem Başarısız...</b>
						<?php }
					}  ?>
				</div>
			</div>


			<div class="table-responsive">
				<table class="table table-bordered chart">
					<thead>
						<tr>

							<th>Sipariş Kodu</th>					
							<th>Sipariş Zamanı</th>
							<th>Toplam Fiyat</th>
							<th>Ödeme Türü</th>
							<th>Sipariş Durumu</th>

							<th></th>
						</tr>
					</thead>
					<tbody>

						<?php while($sipariscek=$siparisdetaysor->fetch(PDO::FETCH_ASSOC)){ ?>
							<tr>
								<form method="POST" action="">
									<td><?php echo $sipariscek['siparis_id'] ?></td>
									<td><?php echo $sipariscek['siparis_zaman'] ?></td>
									<td><?php echo $sipariscek['siparis_toplam'] ?> TL</td>
									<td><?php echo $sipariscek['siparis_tip'] ?></td>
									<td>
										<?php 
										if ($sipariscek['siparis_odeme']==0) {
											echo "Ödeme Bekleniyor...";
										}else{
											echo "Ödeme Alındı...";
										}
										?>
									</td>

									<input type="hidden" name="siparis_id" value="<?php echo $sipariscek['siparis_id'] ?>">
									<td><button type="submit" name="siparisdetay" class="btn btn-info btn-xs">Detay</button></td>

								</form>
							</tr>
						<?php }
						?>

					</tbody>
				</table>
			</div>

			<div class="spacer"></div>
		<?php } ?>
	</div>

	<?php include 'footer.php'; 
}else{
	header("Location:index");
}
?>