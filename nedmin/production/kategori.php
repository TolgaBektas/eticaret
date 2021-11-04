<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$kategorisor=$db->prepare("SELECT * FROM kategori order by kategori_sira");
$kategorisor->execute();
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kategori Listeleme<small> 
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
            <div align="right">
              <a href="kategori-ekle.php"><button class="btn btn-success">Kategori Ekle</button></a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Kategori Sıra</th>
                  <th>Kategori id</th>
                  <th>Kategori Ad</th>
                  <th>Kategori Üst</th>

                  <th>Kategori Durum</th>
                  <th>Düzenle</th>
                  <th>Sil</th>
                </tr>
              </thead>
              <tbody>
                <?php 

                while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>
                  <tr>

                   <td><?php echo $kategoricek['kategori_sira'];//BU LANET ŞET EN TEPEDE OLMAZ İSE SIRALMIYOR SEEBEBİ NEDİR BİLİNMİYOR ?></td>
                   <td><?php echo $kategoricek['kategori_id'];//BU LANET ŞET EN TEPEDE OLMAZ İSE SIRALMIYOR SEEBEBİ NEDİR BİLİNMİYOR ?></td>

                   <td><?php echo $kategoricek['kategori_ad']; ?></td>
                   <td><?php echo $kategoricek['kategori_ust']; ?></td>


                   <td><?php
                   if ($kategoricek['kategori_durum']==1) { ?>
                    <div class="aktif">Aktif</div> 
                  <?php }else { ?>
                    <div class="pasif">Pasif</div>
                  <?php } ?>
                </td>
                <td><center><a href="kategori-duzenle.php?kategori_id=<?php echo $kategoricek['kategori_id']; ?>"><button class="btn btn-primary">Düzenle</button></a></center></td>
                <td><center><a href="../netting/islem.php?kategori_id=<?php echo $kategoricek['kategori_id']; ?>&kategorisil=ok"><button class="btn btn-danger">Sil</button></a></center></td>
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
