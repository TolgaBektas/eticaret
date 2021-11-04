<?php include 'header.php'; 



$yorumsor=$db->prepare("SELECT * FROM yorumlar where yorum_id=:id");
$yorumsor->execute(array(
	'id'=>$_GET['yorum_id']
));
$say=$yorumsor->rowCount();//burdakı sorgu her türlü çalışacak ve çalıştığında sorgu sağlanmaz ise sıfır değer dönecek
$yorumcek=$yorumsor->fetch(PDO::FETCH_ASSOC);
?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">


	</div>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Yorum Onaylama<small>
						<?php 
						if (isset($_GET['durum'])) {
							

							if ($_GET['durum']=="ok") {?>

								<b style="color:green;">İşlem Başarılı...</b>

							<?php   }  elseif ($_GET['durum']=="no") {?>

								<b style="color:red;">İşlem Başarısız...</b>

							<?php }

						} 
						?>
					</small></h2>					
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<?php 

					$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_id=:kullanici_id");
					$kullanicisor->execute(array(
						'kullanici_id'=>$yorumcek['kullanici_id']
					));
					$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

					$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:urun_id");
					$urunsor->execute(array(
						'urun_id'=>$yorumcek['urun_id']
					));
					$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

					?>
					<br />
					<form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yorumu Yapan Kişinin Adı Soyadı<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" disabled="" class="form-control" value="<?php echo $kullanicicek['kullanici_adsoyad'] ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yorumu Yapan Kişinin Kullanıcı Adı<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" disabled="" class="form-control" value="<?php echo $kullanicicek['kullanici_mail'] ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yorumu Yapılan Ürün<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" disabled="" class="form-control" value="<?php echo $uruncek['urun_ad'] ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yorum Detay<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<textarea class="form-control" disabled="" name="yorum_detay"><?php echo $yorumcek['yorum_detay'] ?></textarea>               
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yorum Zaman<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" disabled="" class="form-control col-md-7 col-xs-12" value="<?php echo $yorumcek['yorum_zaman'] ?>">
							</div>
						</div>

						


						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yorum Onay<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select id="heard" class="form-control" name="yorum_onay" required="">
									<option value="1" <?php echo $yorumcek['yorum_onay']=='1' ? 'selected=""' : ''; ?>>Onaylandı</option>
									<option value="0" <?php echo $yorumcek['yorum_onay']=='0' ? 'selected=""' : ''; ?>>Onaylanmadı</option>
								</select>
							</div>
						</div>
						
						<input type="hidden" name="yorum_id" value="<?php echo $yorumcek['yorum_id'] ?>">


						<div class="ln_solid"></div>
						<div class="form-group">
							<div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

								<button type="submit" name="yorumonayla" class="btn btn-success">Onayla</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div> 
</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>