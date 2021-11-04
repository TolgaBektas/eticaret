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
          <h2>Mail Ayarları <small>
            <?php 
            if (isset($_GET['durum'])) {
                        

              if ($_GET['durum']=="ok") {?>

                <b style="color:green;">İşlem Başarılı...</b>

              <?php   }  elseif ($_GET['durum']=="no") {?>

                <b style="color:red;">İşlem Başarısız...</b>

              <?php }

            } ?>
          </small></h2>
          
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Smtp Host<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="ayar_smtphost" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_smtphost'] ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Smtp User<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="ayar_smtpuser" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_smtpuser'] ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Smtp Password<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="ayar_smtppassword" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_smtppassword'] ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Smtp Port<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="ayar_smtpport" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_smtpport'] ?>">
              </div>
            </div>





            
            <div class="ln_solid"></div>
            <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                <button type="submit" name="mailayarkaydet" class="btn btn-success">Güncelle</button>
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