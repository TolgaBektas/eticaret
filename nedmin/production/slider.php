<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$slidersor=$db->prepare("SELECT * FROM slider");
$slidersor->execute();

?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Slider Listeleme<small> 
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
            <div align="right">
              <a href="slider-ekle.php"><button class="btn btn-success">Slider Ekle</button></a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Slider Resim</th>
                  <th>Slider Ad</th>
                  <th>Slider Link</th>
                  <th>Slider Sıra</th>
                   <th>Slider Detay</th>
                  <th>Slider Durum</th>
                  <th>Düzenle</th>
                  <th>Sil</th>
                </tr>
              </thead>

              <tbody>
                <?php 
                while($slidercek=$slidersor->fetch(PDO::FETCH_ASSOC)) {?>
                  <tr>
                    <td><img width="200" src="../../<?php echo $slidercek['slider_resimyol'] ?>"></td>
                    <td><?php echo $slidercek['slider_ad'] ?></td>
                    <td><?php echo $slidercek['slider_link'] ?></td>
                    <td><?php echo $slidercek['slider_sira'] ?></td>
                    <td><?php echo $slidercek['slider_detay'] ?></td>
                    <td><center><?php
                    if ($slidercek['slider_durum']==1) { ?>
                     <div class="aktif">Aktif</div>
                       
                    <?php }else { ?>
                       <div class="pasif">Pasif</div>
                    <?php } ?>
                  </center></td>
                  <td><center><a href="slider-duzenle.php?slider_id=<?php echo $slidercek['slider_id']; ?>"><button class="btn btn-primary">Düzenle</button></a></center></td>
                  <td><center><a href="../netting/islem.php?slider_id=<?php echo $slidercek['slider_id']; ?>&eski_yol=<?php echo $slidercek['slider_resimyol']; ?>&slidersil=ok"><button class="btn btn-danger">Sil</button></a></center></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <!-- Div İçerik Bitişi -->
        </div>
      </div>
    </div>
  </div>




</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
