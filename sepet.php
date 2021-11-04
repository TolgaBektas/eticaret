<?php
include 'header.php';
if (isset($_SESSION['userkullanici_mail'])) {


	$sepetsor=$db->prepare("SELECT * FROM sepet where kullanici_id=:kullanici_id");
	$sepetsor->execute(array(
    'kullanici_id'=>$kullanicicek['kullanici_id']//ayar_id deki veri 0 ise çekme işlemi olur
));
	if (!$sepetsor->rowCount()) {
		header('location:index?durum=sepetbos');
	}else{
		$toplam_fiyat=0;
		?>


		<div class="container">

			<div class="title-bg">
				<div class="title">Sepetim 
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
							<th>Sil</th>
							<th>Ürün Resmi</th>
							<th>Ürün Adı</th>					
							<th>Ürün Kodu</th>
							<th>Ürün Adeti</th>
							<th>Ürün Fiyatı</th>
							<th>Toplam</th>
							<th>Güncelle</th>
						</tr>
					</thead>
					<tbody>
						<?php while($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC)){ 
							$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:urun_id and urun_durum=:urun_durum");
							$urunsor->execute(array(
								'urun_id'=>$sepetcek['urun_id'],
								'urun_durum'=>1
							));
							$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

							$toplam_fiyat+=$uruncek['urun_fiyat']*$sepetcek['urun_adet'];

							?>
							<tr>
								<form method="POST" action="nedmin/netting/islem.php">

									<td><input type="checkbox" name="sepet_sil" class="form-control"></td>
									<td><img src="images\demo-img.jpg" width="100" alt=""></td>
									<td><?php echo $uruncek['urun_ad'] ?></td>

									<td><?php echo $uruncek['urun_id'] ?></td>
									<td><input type="number" min="1" name="urun_adet" class="form-control quantity" value="<?php echo $sepetcek['urun_adet'] ?>"></td>
									<td><?php echo $uruncek['urun_fiyat'] ?> ₺</td>
									<td><?php echo $uruncek['urun_fiyat']*$sepetcek['urun_adet'] ?> ₺</td>
									<input type="hidden" name="sepet_id" value="<?php echo $sepetcek['sepet_id'] ?>">
									<td><button type="submit" name="sepetguncelle" class="btn btn-default btn-red btn-sm">Güncelle</button></td>
								</form>
							</tr>
						<?php } ?>

					</tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-md-6">


				</div>
				<div class="col-md-3 col-md-offset-3">
					<div class="subtotal-wrap">
						<div class="subtotal">
							<p>Toplam Fiyat : <?php echo $toplam_fiyat; ?> TL</p>
							<p>KDV 18% <?php $kdv=0; $kdv=$toplam_fiyat*18/100; echo $kdv; ?> TL</p>
						</div>
						<div class="total">Toplam Fiyat : <span class="bigprice"><?php echo $toplam_fiyat+$kdv; ?> TL</span></div>
						<div class="clearfix"></div>

						<a href="odeme" class="btn btn-default btn-yellow">Ödeme Sayfası</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="spacer"></div>
		</div>

		<?php include 'footer.php'; ?>
	<?php } 
}else{
	header("Location:index");
}?>
