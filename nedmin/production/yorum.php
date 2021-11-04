<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$yorumsor=$db->prepare("SELECT * FROM yorumlar ORDER BY yorum_zaman DESC");
$yorumsor->execute();

?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Yorum Listeleme<small>
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
                  <th>Yorum Zaman</th>  
                  <th>Yorum İçerik</th>
                  
                  <th>Onay Durumu</th>  
                  <th>Yorum Detayı İçin Tıkla</th>                 

                  <th>Sil</th>
                </tr>
              </thead>

              <tbody>
                <?php 
                while($yorumcek=$yorumsor->fetch(PDO::FETCH_ASSOC)) { ?>

                  <tr>
                    <td><?php echo $yorumcek['yorum_zaman'] ?></td>
                    <td><?php echo substr($yorumcek['yorum_detay'],0,100) ?>...</td>
                    
                    <?php if($yorumcek['yorum_onay']==1){ ?>
                      <td><div class="aktif">Onaylandı</div></td>
                    <?php }else{ ?>
                      <td><div class="pasif">Onaylanmadı</div></td>
                    <?php } ?>
                    <td><center><a href="yorum-duzenle.php?yorum_id=<?php echo $yorumcek['yorum_id']; ?>"><button class="btn btn-success">Detay İçin Tıkla</button></a></center></td>

                    
                    <td><center><a href="../netting/islem.php?yorum_id=<?php echo $yorumcek['yorum_id']; ?>&yorumsil=ok"><button class="btn btn-danger">Sil</button></a></center></td>
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
