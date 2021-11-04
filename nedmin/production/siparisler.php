<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$siparissor=$db->prepare("SELECT * FROM siparis order by siparis_odeme ASC");
$siparissor->execute();
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Sipariş Listeleme<small> 
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
            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Sipariş id</th>
                  <th>Sipariş Zaman</th>
                  <th>Sipariş Toplam Fiyatı</th>
                  <th>Sipariş Ödeme</th>
                  <th>Düzenle</th>
                 
                </tr>
              </thead>
              <tbody>
                <?php 

                while($sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC)) { ?>
                  <tr>
                   <td><?php echo $sipariscek['siparis_id']; ?></td>
                   <td><?php echo $sipariscek['siparis_zaman']; ?></td>
                   <td><?php echo $sipariscek['siparis_toplam']; ?> TL</td>
                   <td><?php
                   if ($sipariscek['siparis_odeme']==0) { ?>
                    <div class="bekleme">Ödeme Alındı mı ? Onay Bekliyor...</div> 
                  <?php }elseif($sipariscek['siparis_odeme']==1) { ?>
                    <div class="aktif">Ödeme Alındı. Siparişiniz hazırlanıyor...</div>
                  <?php } ?>
                </td>
                <td><center><a href="siparisler-duzenle.php?siparis_id=<?php echo $sipariscek['siparis_id']; ?>"><button class="btn btn-primary">Düzenle</button></a></center></td>
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
