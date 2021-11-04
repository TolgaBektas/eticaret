<?php include 'header.php'; ?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">


  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Genel Ayarlar <small>
            <?php
            if (isset($_GET['durum'])) {
              if ($_GET['durum']=="ok") {?>
                <b style="color:green;">İşlem Başarılı...</b>
              <?php }elseif ($_GET['durum']=="no") {?>
                <b style="color:red;">İşlem Başarısız...</b>
              <?php }elseif ($_GET['durum']=="izinsizuzanti") {?>
                <b style="color:red;">Geçersiz dosya girdiniz!</b>
              <?php }elseif ($_GET['durum']=="dosyabuyuk") {?>
                <b style="color:red;">Girdiğiniz dosya boyutu çok büyük! Maks. değer 1 MB!</b>
              <?php }
            }  ?>
          </small></h2>
          
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br/>
          <!-- RESİM EKLEME FORMU -->
          <form action="../netting/islem.php" method="POST" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
           <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Logo<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <?php 
              if (!empty($ayarcek['ayar_logo'])) { ?>
                <img width="200" src="../../<?php echo $ayarcek['ayar_logo']; ?>">                  
              <?php }else { ?>
                <img width="200" src="../../dimg/resim-yok.png">
              <?php } ?>             
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Logo Seç<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="file" name="ayar_logo" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <input type="hidden" name="eski_yol" value="<?php echo $ayarcek['ayar_logo']; ?>">
          <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

              <button type="submit" name="logoduzenle" class="btn btn-success">Güncelle</button>
            </div>


        </form>
        <!-- RESİM EKLEME FORMU -->


        <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Başlığı<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="ayar_title" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_title'] ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Açıklaması<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="ayar_description" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_description'] ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Anahtar Kelime<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="ayar_keywords" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_keywords'] ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Yazar<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="ayar_author" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_author'] ?>">
            </div>
          </div>



          <div class="ln_solid"></div>
          <div class="form-group">
            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

              <button type="submit" name="genelayarkaydet" class="btn btn-success">Güncelle</button>
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