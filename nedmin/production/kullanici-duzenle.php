<?php include 'header.php'; 



$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_id=:id");
$kullanicisor->execute(array(
	'id'=>$_GET['kullanici_id']
));
$say=$kullanicisor->rowCount();//burdakı sorgu her türlü çalışacak ve çalıştığında sorgu sağlanmaz ise sıfır değer dönecek
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

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
					<h2>Kullanıcı Düzenleme<small>
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
					<br />
					<form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
						
						

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tc<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="kullanici_tc" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $kullanicicek['kullanici_tc'] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ad Soyad<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="kullanici_adsoyad" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $kullanicicek['kullanici_adsoyad'] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mail<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="email" disabled="" name="kullanici_mail" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $kullanicicek['kullanici_mail'] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Gsm<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="kullanici_gsm" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $kullanicicek['kullanici_gsm'] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Durum<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select id="heard" class="form-control" name="kullanici_durum" required="">
									<option value="1" <?php echo $kullanicicek['kullanici_durum']=='1' ? 'selected=""' : ''; ?>>Aktif</option>
									<option value="0" <?php echo $kullanicicek['kullanici_durum']=='0' ? 'selected=""' : ''; ?>>Pasif</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yetki<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<?php
								if ($kullanicicek['kullanici_yetki']==5) { ?>
									<input type="text" disabled="" class="form-control col-md-7 col-xs-12" value="Admin">									
								<?php }else { ?>
									<input type="text" disabled="" class="form-control col-md-7 col-xs-12" value="Standart Kullanıcı">									
								<?php } ?>
							</div>
						</div>
						<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">


						<div class="ln_solid"></div>
						<div class="form-group">
							<div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

								<button type="submit" name="kullaniciduzenle" class="btn btn-success">Güncelle</button>
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