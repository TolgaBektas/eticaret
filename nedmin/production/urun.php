<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$urunsor=$db->prepare("SELECT * FROM urun order by urun_id desc");
$urunsor->execute();

?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ürün Listeleme<small>



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
            <div align="right">
              <a href="urun-ekle.php"><button class="btn btn-success">Ürün Ekle</button></a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Ürün Ad</th>
                  <th>Ürün Fiyat</th>
                  <th>Ürün Stok</th>
                  <th>Ürün Durum</th>
                  <th>Ürün Resim İşlemleri</th>
                  <th>Ürün Öne Çıkar</th>
                  <th>Düzenle</th>
                  <th>Sil</th>
                </tr>
              </thead>

              <tbody>
                <?php 
                while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {?>
                  <tr>
                    <td><?php echo $uruncek['urun_ad'] ?></td>
                    <td><?php echo $uruncek['urun_fiyat'] ?></td>
                    <td><?php echo $uruncek['urun_stok'] ?></td>
                    <td><?php
                    if ($uruncek['urun_durum']==1) { ?>
                     <div class="aktif">Aktif</div>
                       
                    <?php }else { ?>
                      <div class="pasif">Pasif</div>
                    <?php } ?>
                  </td>
                  <td><center><a href="urun-galeri.php?urun_id=<?php echo $uruncek['urun_id']; ?>"><button class="btn btn-success">Resim İşlemleri</button></a></center></td>
                  <td><?php
                  if ($uruncek['urun_onecikar']==1) { ?>
                    <center><a href="../netting/islem.php?urun_id=<?php echo $uruncek['urun_id']; ?>&urunonecikar=cikarma"><button class="btn btn-warning">Öne Çıkardan Kaldır</button></a></center>
                  <?php }else { ?>
                    <center><a href="../netting/islem.php?urun_id=<?php echo $uruncek['urun_id']; ?>&urunonecikar=cikar"><button class="btn btn-success">Öne Çıkar</button></a></center>

                  <?php } ?>
                </td>
                <td><center><a href="urun-duzenle.php?urun_id=<?php echo $uruncek['urun_id']; ?>"><button class="btn btn-primary">Düzenle</button></a></center></td>
                <td><center><a href="../netting/islem.php?urun_id=<?php echo $uruncek['urun_id']; ?>&urunsil=ok"><button class="btn btn-danger">Sil</button></a></center></td>
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
