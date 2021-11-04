<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$menusor=$db->prepare("SELECT * FROM menu order by menu_sira ASC");
$menusor->execute();

?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Menü Listeleme<small>
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
              <a href="menu-ekle.php"><button class="btn btn-success">Menü Ekle</button></a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Menü Sıra</th>
                  <th>Menü Ad</th>
                  <th>Menü Url</th>                  
                  <th>Menü Durum</th>
                  <th>Düzenle</th>
                  <th>Sil</th>
                </tr>
              </thead>

              <tbody>
                <?php 
                while($menucek=$menusor->fetch(PDO::FETCH_ASSOC)) {?>
                  <tr>

                    <td><?php echo $menucek['menu_sira'] ?></td>
                    <td><?php echo $menucek['menu_ad'] ?></td>
                    <td><?php echo $menucek['menu_url'] ?></td>
                    
                    <td><?php
                    if ($menucek['menu_durum']==1) { ?>
                     <div class="aktif">Aktif</div>

                   <?php }else { ?>
                    <div class="pasif">Pasif</div>
                  <?php } ?>
                </td>
                <td><center><a href="menu-duzenle.php?menu_id=<?php echo $menucek['menu_id']; ?>"><button class="btn btn-primary">Düzenle</button></a></center></td>
                <td><center><a href="../netting/islem.php?menu_id=<?php echo $menucek['menu_id']; ?>&menusil=ok"><button class="btn btn-danger">Sil</button></a></center></td>
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
