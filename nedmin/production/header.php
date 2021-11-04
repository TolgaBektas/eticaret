<?php 
ob_start();
session_start();
include '../netting/baglan.php';
  //header da yazmamızın sebebi headeri include ettiğimiz tüm yerlerde kullanmak için
$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
    'id'=>0//ayar_id deki veri 0 ise çekme işlemi olur
  ));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail");
$kullanicisor->execute(array(
  'mail'=>$_SESSION['kullanici_mail']
));
$say=$kullanicisor->rowCount();//burdakı sorgu her türlü çalışacak ve çalıştığında sorgu sağlanmaz ise sıfır değer dönecek
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
if ($say==0) {
  header("Location:login.php?durum=izinsiz");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Admin Paneli</title>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="css/mystil.css">
  <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>

  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>


  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>Admin Paneli</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Hoşgeldin, </span>
              <h2><?php echo $kullanicicek['kullanici_adsoyad']; ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>

              <ul class="nav side-menu">
               <li><a href="index.php"><i class="fa fa-home"></i>Anasayfa</a></li>
               <li><a><i class="fa fa-cogs"></i>Site Ayarları<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="genel-ayar.php">Genel Ayarlar</a></li>
                  <li><a href="iletisim-ayarlar.php">İletişim Ayarları</a></li>
                  <li><a href="api-ayarlar.php">Api Ayarları</a></li>
                  <li><a href="sosyal-ayarlar.php">Sosyal Ayarlar</a></li>
                  <li><a href="mail-ayarlar.php">Mail Ayarları</a></li>
                </ul>

                <li><a href="hakkimizda.php"><i class="fa fa-info"></i>Hakkımızda</a></li>
                <li><a href="kullanici.php"><i class="fa fa-user"></i>Kullanıcılar</a></li>
                <li><a href="urun.php"><i class="fa fa-shopping-bag"></i>Ürünler</a></li>
                <li><a href="menu.php"><i class="fa fa-bars"></i>Menüler</a></li>
                <li><a href="kategori.php"><i class="fa fa-bars"></i>Kategoriler</a></li>
                <li><a href="yorum.php"><i class="fa fa-comments"></i>Yorumlar</a></li>
                <li><a href="slider.php"><i class="fa fa-image"></i>Slider</a></li>
                <li><a href="banka.php"><i class="fa fa-money"></i>Banka</a></li>
                <li><a href="siparisler.php"><i class="fa fa-shopping-basket"></i>Siparişler</a></li>



              </li>
            </ul>
          </div>
          
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
          <a data-toggle="tooltip" data-placement="top" title="Settings">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
          </a>
          <a data-toggle="tooltip" data-placement="top" title="FullScreen">
            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
          </a>
          <a data-toggle="tooltip" data-placement="top" title="Lock">
            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
          </a>
          <a data-toggle="tooltip" data-placement="top" title="Logout">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
          </a>
        </div>
        <!-- /menu footer buttons -->
      </div>
    </div>

    <!-- top navigation -->
    <div class="top_nav">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>

          <ul class="nav navbar-nav navbar-right">
            <li class="">
              <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="images/img.jpg" alt=""><?php echo $kullanicicek['kullanici_adsoyad']; ?>
                <span class=" fa fa-angle-down"></span>
              </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="javascript:;"> Profil Bilgilerim</a></li>

                <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i>Güvenli Çıkış</a></li>
              </ul>
            </li>

            <?php   

            $yorumsor=$db->prepare("SELECT * FROM yorumlar where yorum_onay=:onay");
            $yorumsor->execute(array('onay'=>0));
            $yorumsay=0;
            while ($yorumcek=$yorumsor->fetch(PDO::FETCH_ASSOC)) {
              $yorumsay+=1;
            }
            ?>
            <?php 
            $siparisodemesay=0;
            $siparisdetaysor=$db->prepare("SELECT * FROM siparis where siparis_odeme=:siparis_odeme");
            $siparisdetaysor->execute(array('siparis_odeme'=>0));
            while($sipariscek=$siparisdetaysor->fetch(PDO::FETCH_ASSOC)){
              $siparisodemesay+=1;
            }
            $bildirim=0;
            ?>
            <?php if($siparisdetaysor->rowCount()){
              $bildirim+=1;
            }
             if($yorumsor->rowCount()){
              $bildirim+=1;
            }
            ?>
            <li role="presentation" class="dropdown">
              <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-envelope-o"></i>
                <span class="badge bg-green"><?php echo $bildirim; ?></span>
              </a>
              <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                <li>
                  <a>                    
                    <span>
                      <span>Onay bekleyen yorum!</span>                      
                    </span>
                    <span class="message">
                      Onay bekleyen yorum sayısı: <?php echo $yorumsay; ?>
                    </span>
                  </a>
                </li>
                
                
                <li>
                  <a href="">                    
                    <span>
                      <span>Onay bekleyen sipariş!</span>                      
                    </span>
                    <span class="message">
                      Onay bekleyen sipariş sayısı: <?php echo $siparisodemesay; ?>
                    </span>
                  </a>
                </li>             

                <li>
                  <div class="text-center">
                    <a href="yorum" class="btn btn-primary">
                      Yorumlara Git!
                    </a>
                    <a href="siparisler" class="btn btn-primary">
                      Siparişlere Git!
                    </a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>
        <!-- /top navigation -->