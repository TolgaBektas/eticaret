<?php include 'header.php'; 



$menusor=$db->prepare("SELECT * FROM menu where menu_id=:id");
$menusor->execute(array(
	'id'=>$_GET['menu_id']
));
$say=$menusor->rowCount();//burdakı sorgu her türlü çalışacak ve çalıştığında sorgu sağlanmaz ise sıfır değer dönecek
$menucek=$menusor->fetch(PDO::FETCH_ASSOC);

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
					<h2>Menü Düzenleme<small>
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
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menü Ad<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="menu_ad" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $menucek['menu_ad'] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menü Detay<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<textarea class="ckeditor" id="editor1" name="menu_detay"><?php echo $menucek['menu_detay'] ?></textarea>               
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
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menü Url<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="menu_url" id="first-name" class="form-control col-md-7 col-xs-12" value="<?php echo $menucek['menu_url'] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menü Sıra<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="menu_sira" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $menucek['menu_sira'] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menü Durum<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select id="heard" class="form-control" name="menu_durum" required="">
									<option value="1" <?php echo $menucek['menu_durum']=='1' ? 'selected=""' : ''; ?>>Aktif</option>
									<option value="0" <?php echo $menucek['menu_durum']=='0' ? 'selected=""' : ''; ?>>Pasif</option>
								</select>
							</div>
						</div>
						<input type="hidden" name="menu_id" value="<?php echo $menucek['menu_id'] ?>">


						<div class="ln_solid"></div>
						<div class="form-group">
							<div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

								<button type="submit" name="menuduzenle" class="btn btn-success">Güncelle</button>
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