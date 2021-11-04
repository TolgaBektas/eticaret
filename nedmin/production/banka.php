<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$bankasor=$db->prepare("SELECT * FROM banka");
$bankasor->execute();
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Banka Listeleme<small> 
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
              <a href="banka-ekle.php"><button class="btn btn-success">Banka Ekle</button></a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Banka Ad</th>
                  <th>Banka IBAN</th>
                  <th>Banka Hesap Ad Soyad</th>

                  <th>Banka Durum</th>
                  <th>Düzenle</th>
                  <th>Sil</th>
                </tr>
              </thead>
              <tbody>
                <?php 

                while($bankacek=$bankasor->fetch(PDO::FETCH_ASSOC)) { ?>
                  <tr>
                   <td><?php echo $bankacek['banka_ad']; ?></td>
                   <td><?php echo $bankacek['banka_iban']; ?></td>
                   <td><?php echo $bankacek['banka_hesapadsoyad']; ?></td>
                   <td><?php
                   if ($bankacek['banka_durum']==1) { ?>
                    <div class="aktif">Aktif</div> 
                  <?php }else { ?>
                    <div class="pasif">Pasif</div>
                  <?php } ?>
                </td>
                <td><center><a href="banka-duzenle.php?banka_id=<?php echo $bankacek['banka_id']; ?>"><button class="btn btn-primary">Düzenle</button></a></center></td>
                <td><center><a href="../netting/islem.php?banka_id=<?php echo $bankacek['banka_id']; ?>&bankasil=ok"><button class="btn btn-danger">Sil</button></a></center></td>
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
