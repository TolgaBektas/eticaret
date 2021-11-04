<?php include 'header.php'; 
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
					<h2>Ürün Ekleme<small>
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
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<?php 

								$kategorisor=$db->prepare("SELECT * FROM kategori WHERE kategori_ust=:kategori_ust order by kategori_sira");
								$kategorisor->execute(array(
										'kategori_ust'=>0//en baş kategoriler
									));
									?>
									<select class="select2-multiple form-control" required="" name="kategori_id">
										<?php 

										while ($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {
											$kategori_id=$kategoricek['kategori_id'];
											?>
											<option value="<?php echo $kategoricek['kategori_id']; ?>" ><?php echo $kategoricek['kategori_ad']; ?></option>
										<?php } ?>
									</select>

								</div>
							</div>


							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Ad<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="urun_ad" required="" class="form-control col-md-7 col-xs-12">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün Detay<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea class="ckeditor" required="" id="editor1" name="urun_detay"></textarea>               
								</div>
							</div>
							<script type="text/javascript">
								CKEDITOR.replace( 'editor1',
								{
									filebrowserUrl : 'ckfinder/ckfinder.html',
									filebrowserIamgeBrowseUrl:  'ckfinder/ckfinder.html?type=Flash',
									filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
									filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
									filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
									forcePasteAsPlainText:true
								}
								);

							</script>


							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Fiyat<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="urun_fiyat" required="" class="form-control col-md-7 col-xs-12">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Video<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="urun_video" class="form-control col-md-7 col-xs-12">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Keywords<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="urun_keyword" required="" class="form-control col-md-7 col-xs-12">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Stok<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="urun_stok" required="" class="form-control col-md-7 col-xs-12">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Durum<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select id="heard" class="form-control" name="urun_durum" required="">
										<option value="1">Aktif</option>
										<option value="0">Pasif</option>
									</select>
								</div>
							</div>		
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Öne Çıkar<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select id="heard" class="form-control" name="urun_onecikar" required="">

										<option value="0">Pasif</option>
										<option value="1">Aktif</option>
									</select>
								</div>
							</div>					

							<div class="ln_solid"></div>
							<div class="form-group">
								<div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

									<button type="submit" name="urunekle" class="btn btn-success">Ekle</button>
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