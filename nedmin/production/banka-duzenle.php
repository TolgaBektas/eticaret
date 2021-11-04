<?php include 'header.php'; 



$bankasor=$db->prepare("SELECT * FROM banka where banka_id=:id");
$bankasor->execute(array(
	'id'=>$_GET['banka_id']
));
$say=$bankasor->rowCount();//burdakı sorgu her türlü çalışacak ve çalıştığında sorgu sağlanmaz ise sıfır değer dönecek
$bankacek=$bankasor->fetch(PDO::FETCH_ASSOC);

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
					<h2>Banka Düzenleme<small>
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
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banka Ad<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="banka_ad" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $bankacek['banka_ad'] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banka IBAN<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="banka_iban" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $bankacek['banka_iban'] ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banka Hesap Ad Soyad<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="banka_hesapadsoyad"  required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $bankacek['banka_hesapadsoyad'] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Banka Durum<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select id="heard" class="form-control" name="banka_durum" required="">
									<option value="1" <?php echo $bankacek['banka_durum']=='1' ? 'selected=""' : ''; ?>>Aktif</option>
									<option value="0" <?php echo $bankacek['banka_durum']=='0' ? 'selected=""' : ''; ?>>Pasif</option>
								</select>
							</div>
						</div>
						<input type="hidden" name="banka_id" value="<?php echo $bankacek['banka_id'] ?>">


						<div class="ln_solid"></div>
						<div class="form-group">
							<div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

								<button type="submit" name="bankaguncelle" class="btn btn-success">Güncelle</button>
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