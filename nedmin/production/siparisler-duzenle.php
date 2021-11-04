<?php include 'header.php'; 
$siparissor=$db->prepare("SELECT * FROM siparis where siparis_id=:id");
$siparissor->execute(array(
	'id'=>$_GET['siparis_id']
));
$say=$siparissor->rowCount();//burdakı sorgu her türlü çalışacak ve çalıştığında sorgu sağlanmaz ise sıfır değer dönecek
$sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC);

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
					<h2>Sipariş Düzenleme<small>
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
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sipariş id<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" disabled="" class="form-control col-md-7 col-xs-12" value="<?php echo $sipariscek['siparis_id'] ?>">
							</div>
						</div>

						


						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sipariş Zaman<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" disabled="" class="form-control col-md-7 col-xs-12" value="<?php echo $sipariscek['siparis_zaman'] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sipariş Toplam Fiyatı<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" disabled="" class="form-control col-md-7 col-xs-12" value="<?php echo $sipariscek['siparis_toplam'] ?> TL">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sipariş Ödeme<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select id="heard" class="form-control" name="siparis_odeme" required="">
									<option value="1" <?php echo $sipariscek['siparis_odeme']=='1' ? 'selected=""' : ''; ?>>Ödeme Alındı. Siparişiniz hazırlanıyor...</option>
									<option value="0" <?php echo $sipariscek['siparis_odeme']=='0' ? 'selected=""' : ''; ?>>Ödeme Alındı mı ? Onay Bekliyor...</option>
								</select>
							</div>
						</div>
						<input type="hidden" name="siparis_id" value="<?php echo $sipariscek['siparis_id'] ?>">


						<div class="ln_solid"></div>
						<div class="form-group">
							<div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

								<button type="submit" name="siparisduzenle" class="btn btn-success">Güncelle</button>
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