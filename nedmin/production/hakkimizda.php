<?php include 'header.php'; 
$hakkimizdasor=$db->prepare("SELECT * FROM hakkimizda where hakkimizda_id=:id");
$hakkimizdasor->execute(array(
    'id'=>0//ayar_id deki veri 0 ise çekme işlemi olur
  ));
$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);

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
          <h2>Hakkımızda Ayarlar <small>
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Başlık<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="hakkimizda_baslik" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $hakkimizdacek['hakkimizda_baslik'] ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İçerik<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea class="ckeditor" id="editor1" name="hakkimizda_icerik"><?php echo $hakkimizdacek['hakkimizda_icerik'] ?></textarea>               
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Video<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="hakkimizda_video" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $hakkimizdacek['hakkimizda_video'] ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vizyon<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="hakkimizda_vizyon" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $hakkimizdacek['hakkimizda_vizyon'] ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Misyon<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="hakkimizda_misyon" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $hakkimizdacek['hakkimizda_misyon'] ?>">
              </div>
            </div>


            
            <div class="ln_solid"></div>
            <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                <button type="submit" name="hakkimizdakaydet" class="btn btn-success">Güncelle</button>
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
