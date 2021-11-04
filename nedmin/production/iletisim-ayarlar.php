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
          <h2>İletişim Ayarları <small>
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefon Numarası<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="ayar_tel" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_tel'] ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefon Numarası (GSM)<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="ayar_gsm" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_gsm'] ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Faks Numarası<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="ayar_faks" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_faks'] ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mail Adresi<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="email" name="ayar_mail" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_mail'] ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İlçe<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="ayar_ilce" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_ilce'] ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İl<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="ayar_il" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_il'] ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adres<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="ayar_adres" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_adres'] ?>">
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mesai<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="ayar_mesai" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_mesai'] ?>">
              </div>
            </div>



            
            <div class="ln_solid"></div>
            <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                <button type="submit" name="iletisimayarkaydet" class="btn btn-success">Güncelle</button>
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