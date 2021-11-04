<?php
include 'header.php';
if (isset($_SESSION['userkullanici_mail'])) {


	$sepetsor=$db->prepare("SELECT * FROM sepet where kullanici_id=:kullanici_id");
	$sepetsor->execute(array(
    'kullanici_id'=>$kullanicicek['kullanici_id']//ayar_id deki veri 0 ise çekme işlemi olur
));
	$toplam_fiyat=0;
	?>


	<div class="container">
		<form action="nedmin/netting/islem.php" method="POST">
			<div class="title-bg">
				<div class="title">Ödeme Sayfası 
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

							<th>Ürün Resmi</th>
							<th>Ürün Adı</th>					
							<th>Ürün Kodu</th>
							<th>Ürün Adeti</th>
							<th>Ürün Fiyatı</th>
							<th>Toplam</th>

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


									<td><img src="images\demo-img.jpg" width="100" alt=""></td>
									<td><?php echo $uruncek['urun_ad'] ?></td>

									<td><?php echo $uruncek['urun_id'] ?></td>
									<td><?php echo $sepetcek['urun_adet'] ?></td>
									<td><?php echo $uruncek['urun_fiyat'] ?> ₺</td>
									<td><?php echo $uruncek['urun_fiyat']*$sepetcek['urun_adet'] ?> ₺</td>
									<input type="hidden" name="sepet_id" value="<?php echo $sepetcek['sepet_id'] ?>">
								</form>
								<!--<input type="hidden" name="urun_id[]" value="<?php echo $uruncek['urun_id'] ?>">-->
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
						<div class="total">Toplam Fiyat : <span class="bigprice"><?php echo $toplam_fiyat+=$kdv; ?> TL</span></div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="tab-review">
				<ul id="myTab" class="nav nav-tabs shop-tab">
					<li class="active in"><a href="#kredi" data-toggle="tab">Kredi</a></li>
					<li class=""><a href="#havale" data-toggle="tab">Havale</a></li>			
				</ul>
				<div id="myTabContent" class="tab-content shop-tab-ct">
					<div class="tab-pane fade active in" id="kredi">	
						iyico api gelecek					
					</div>

					<div class="tab-pane fade" id="havale">

						<?php 
						$bankasor=$db->prepare("SELECT * FROM banka");
						$bankasor->execute();
						while ($bankacek=$bankasor->fetch(PDO::FETCH_ASSOC)) {
							if ($bankacek['banka_durum']==1) {?>
								<input type="radio" name="banka_id" required="" value="<?php echo $bankacek['banka_id'] ?>"><?php echo $bankacek['banka_ad'] ?><br>		
							<?php } ?>
							
						<?php }	
						?>
						<div class="spacer"></div>
						<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']; ?>">
						<input type="hidden" name="siparis_toplam" value="<?php echo $toplam_fiyat; ?>">

						<button type="submit" name="bankasiparisekle" class="btn btn-success">Sipariş Ver</button>

					</div>

				</div>
			</div>
			<div class="spacer"></div>
		</form>
	</div>

	<?php include 'footer.php';

}else{
	header("Location:index");
}
?>