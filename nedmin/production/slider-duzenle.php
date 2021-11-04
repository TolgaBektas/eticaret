<?php include 'header.php'; 



$slidersor=$db->prepare("SELECT * FROM slider where slider_id=:id");
$slidersor->execute(array(
	'id'=>$_GET['slider_id']
));
$say=$slidersor->rowCount();//burdakı sorgu her türlü çalışacak ve çalıştığında sorgu sağlanmaz ise sıfır değer dönecek
$slidercek=$slidersor->fetch(PDO::FETCH_ASSOC);

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
					<h2>Slider Düzenleme<small>
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
					<form action="../netting/islem.php" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Slider<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<?php 
								if (!empty($slidercek['slider_resimyol'])) { ?>
									<img width="200" src="../../<?php echo $slidercek['slider_resimyol']; ?>">                  
								<?php }else { ?>
									<img width="200" src="../../dimg/resim-yok.png">
								<?php } ?>             
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Seç<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="file" name="slider_resimyol" required="required" class="form-control col-md-7 col-xs-12">		
							</div>
						</div>
						<div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<input type="hidden" name="eski_yol" value="<?php echo $slidercek['slider_resimyol']; ?>">
							<input type="hidden" name="slider_id" value="<?php echo $slidercek['slider_id']; ?>">

							<button type="submit" name="sliderresimduzenle" class="btn btn-success">Güncelle</button>
						</div>

					</form>
					<form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
						
						

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Ad<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="slider_ad" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $slidercek['slider_ad'] ?>">
							</div>
						</div>						


						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Link<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="slider_link" id="first-name" class="form-control col-md-7 col-xs-12" value="<?php echo $slidercek['slider_link'] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Sıra<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="slider_sira" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $slidercek['slider_sira'] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Detay<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<textarea name="slider_detay" class="form-control col-md-7 col-xs-12" placeholder="Slider Sırasını Giriniz."><?php echo $slidercek['slider_detay'] ?></textarea>
								</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Durum<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select id="heard" class="form-control" name="slider_durum" required="">
									<option value="1" <?php echo $slidercek['slider_durum']=='1' ? 'selected=""' : ''; ?>>Aktif</option>
									<option value="0" <?php echo $slidercek['slider_durum']=='0' ? 'selected=""' : ''; ?>>Pasif</option>
								</select>
							</div>
						</div>
						<input type="hidden" name="eski_yol" value="<?php echo $slidercek['slider_resimyol']; ?>">
						<input type="hidden" name="slider_id" value="<?php echo $slidercek['slider_id']; ?>">


						<div class="ln_solid"></div>
						<div class="form-group">
							<div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

								<button type="submit" name="sliderduzenle" class="btn btn-success">Güncelle</button>
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