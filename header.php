<?php 
include 'nedmin/netting/baglan.php';
include 'nedmin/production/fonksiyon.php';//seo fonksiyonu için
  //header da yazmamızın sebebi headeri include ettiğimiz tüm yerlerde kullanmak için
$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
    'id'=>0//ayar_id deki veri 0 ise çekme işlemi olur
));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

if (isset($_SESSION['userkullanici_mail'])) {
	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail");
	$kullanicisor->execute(array(
    'mail'=>$_SESSION['userkullanici_mail']//ayar_id deki veri 0 ise çekme işlemi olur
));
	$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $ayarcek['ayar_title'] ?></title>
	<meta charset="utf-8">
	<meta name="description" content="<?php echo $ayarcek['ayar_description'] ?>">
	<meta name="keywords" content="<?php echo $ayarcek['ayar_keywords'] ?>">
	<meta name="author" content="<?php echo $ayarcek['ayar_author'] ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link href='font-awesome\css\font-awesome.css' rel="stylesheet" type="text/css">
	<!-- Bootstrap -->
	<link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
	
	<!-- Main Style -->
	<link rel="stylesheet" href="style.css">
	<!-- Benim Style -->
	<link rel="stylesheet" href="css\style.css">
	<!-- owl Style -->
	<link rel="stylesheet" href="css\owl.carousel.css">
	<link rel="stylesheet" href="css\owl.transitions.css">
	<link rel="stylesheet" type="text/css" href="js\product\jquery.fancybox.css?v=2.1.5" media="screen">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

	<script>
		$(function(){
			$("#sonuc").hide();
			$("input[name=ara]").keyup(function(){
				var value=$(this).val();
				var konu="value="+value;
				$.ajax({
					type: "POST",
					url: "nedmin/netting/ajax.php",
					data: konu,
					success:function (sonuc){

						$("#sonuc").show().html(sonuc);
					}
				});

			});
		});
	</script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
	<div id="wrapper">
		<div class="header"><!--Header -->
			<div class="container">
				<div class="row">
					<div class="col-xs-6 col-md-4 main-logo">
						<a href="index.php"><img width="100" src="<?php echo $ayarcek['ayar_logo'] ?>"  alt="logo" class="logo img-responsive"></a>
					</div>
					<div class="col-md-8">
						<div class="pushright">
							<div class="top">
								<?php 
								if (isset($_SESSION['userkullanici_mail'])) { ?>

									<a href="" class="btn btn-default btn-dark">Hoşgeldin, <?php echo $kullanicicek['kullanici_adsoyad']; ?></a>
								<?php }else{ ?>
									<a href="#" id="reg" class="btn btn-default btn-dark">Giriş Yap<span>-- yada --</span>Kayıt Ol</a>

									<div class="regwrap">
										<div class="row">
											<div class="col-md-6 regform">
												<div class="title-widget-bg">
													<div class="title-widget">Kullanıcı Girişi</div>
												</div>
												<form role="form" method="POST" action="nedmin/netting/islem.php">
													<div class="form-group">
														<input type="mail" name="kullanici_mail" class="form-control" placeholder="Kullanıcı Maili">
													</div>
													<div class="form-group">
														<input type="password" name="kullanici_password" class="form-control" placeholder="Şifre">
													</div>
													<div class="form-group">
														<button type="submit" name="kullanicigiris" class="btn btn-default btn-red btn-sm">Giriş Yap</button>
													</div>
													<div class="form-group">
														<a class="btn btn-default btn-red btn-sm" href="hesapislemleri">Şifremi Unuttum</a>
													</div>
												</form>
											</div>
											<div class="col-md-6">
												<div class="title-widget-bg">
													<div class="title-widget">Kayıt Ol</div>

												</div>
												<p>
													Eğer buralar da yenisen hemen kayıt ol ve alışverişe başla!
												</p>
												<a href="register.php"><button class="btn btn-default btn-yellow">Kayıt Ol</button></a>
											</div>
										</div>
									</div>
								<?php } ?>
								<div class="srch-wrap">
									<a href="#" id="srch" class="btn btn-default btn-search"><i class="fa fa-search"></i></a>
								</div>
								<div class="srchwrap">
									<div class="row">
										<div class="col-md-12">
											<form class="form-horizontal" role="form">
												<div class="form-group">
													<label for="search" class="col-sm-2 control-label">Search</label>
													<div class="col-sm-10">
														<div class="dropdown">
															<div id="ara">
																<input type="text" list="aramaverileri" autocomplete="off" name="ara">
															</div>
															<div id="sonuc"></div>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			

			<div class="dashed"></div>


		</div><!--Header -->
		<div class="main-nav">
			<!--end main-nav -->
			<div class="navbar navbar-default navbar-static-top">
				<div class="container">

					<div class="row">
						<div class="col-md-10">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="navbar-collapse collapse">
								<ul class="nav navbar-nav">
									<li><a href="index" class="active">Anasayfa</a><div class="curve"></div></li>

									<?php 


									$menusor=$db->prepare("SELECT * FROM menu where menu_durum=:durum order by menu_sira ASC limit 5");//menu siraya göre listele ve limiti 5 yap
									$menusor->execute(array(
										'durum' => 1
									));
									while($menucek=$menusor->fetch(PDO::FETCH_ASSOC)){
										?>
										<li><a href=" <?php 
										if(!empty($menucek['menu_url'])){
											echo $menucek['menu_url'];

											}else{
												echo "sayfa-".seo($menucek['menu_ad']);
											}

											?>"><?php echo $menucek['menu_ad']; ?></a></li>
										<?php } ?>
									</ul>
								</div>
							</div>
							<?php if (isset($_SESSION['userkullanici_mail'])) { ?>
								<div class="col-md-2 machart">
									<?php 
									$sepetsor=$db->prepare("SELECT * FROM sepet where kullanici_id=:kullanici_id");
									$sepetsor->execute(array(
										'kullanici_id'=>$kullanicicek['kullanici_id']
									));


									?>

									<button id="popcart" class="btn btn-default btn-chart btn-sm "><span class="mychart">Sepetim</span><span class="allprice"></span></button>
									
									<div class="popcart">
										<?php										
										if (!$sepetsor->rowCount()) {?>
											<h4 class="h4 text-info">Sepetinizde ürün bulunmamaktadır.</h4>
										<?php }else{ ?>
											<table class="table table-condensed popcart-inner">
												<tbody>
													<?php 
													$toplam_fiyat=0;
													$kdv=0;
													while($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC)){ 
														$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:urun_id and urun_durum=:urun_durum");
														$urunsor->execute(array(
															'urun_id'=>$sepetcek['urun_id'],
															'urun_durum'=>1
														));
														$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
														$toplam_fiyat+=$uruncek['urun_fiyat']*$sepetcek['urun_adet'];
														?>
														<tr>
															<td>
																<a href="<?php echo $uruncek['urun_seourl'] ?>"><img src="images\dummy-1.png" alt="" class="img-responsive"></a>
															</td>
															<td><a href="<?php echo $uruncek['urun_seourl'] ?>"><?php echo $uruncek['urun_ad'] ?></a></td>
															<td>Adet: <?php echo $sepetcek['urun_adet'] ?></td>
															<td>Fiyat: <?php echo $uruncek['urun_fiyat']*$sepetcek['urun_adet'] ?> ₺</td>
														</tr>
													<?php } ?>

												</tbody>
											</table>
											<span class="sub-tot">Toplam Fiyat : <span><?php echo $toplam_fiyat ?> ₺</span> | <span>KDV (18%)</span> : <?php  $kdv=$toplam_fiyat*18/100; echo $kdv; ?> ₺</span>
											<br>
											<div class="btn-popcart">
												<a href="odeme" class="btn btn-default btn-red btn-sm">Ödeme Sayfası</a>
												<a href="sepet" class="btn btn-default btn-red btn-sm">Sepete Git</a>
											</div>
											<div class="popcart-tot">
												<p>
													Total<br>
													<span><?php echo $kdv+$toplam_fiyat; ?> ₺</span>
												</p>
											</div>
											<div class="clearfix"></div>
										<?php } ?>
									</div>

								</div>
							</div>
							
							<ul class="small-menu"> 
								<li><a href="hesapislemleri" class="myacc">Hesabım</a></li>
								<li><a href="siparislerim" class="myshop">Siparişlerim</a></li>
								<li><a href="logout" class="mycheck">Güvenli Çıkış</a></li>
							</ul>

						<?php }	?>
						<!--small-nav -->
					</div>
				</div>
			</div><!--end main-nav -->
			<?php 
			if (isset($_GET['durum'])) { ?>
				<div class="container">
					<?php
					if ($_GET['durum']=="girisbasarili") { ?>
						<div class="alert alert-success alert-dismissible">
							<strong>Hoşgeldin, <?php echo $_SESSION['userkullanici_mail'] ?></strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>		
					<?php }elseif ($_GET['durum']=="girisbasarisiz") { ?>
						<div class="alert alert-danger alert-dismissible">
							<strong>Giriş başarısız!</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>		
					<?php }elseif ($_GET['durum']=="exit") { ?>
						<div class="alert alert-success alert-dismissible">
							<strong>Başarılı bir şekilde çıkış yaptınız!</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>		
					<?php }elseif ($_GET['durum']=="farklisifre") { ?>
						<div class="alert alert-danger alert-dismissible">
							<strong>Girdiğiniz şifreler eşleşmiyor.</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="eksiksifre") { ?>
						<div class="alert alert-danger alert-dismissible">
							<strong>Şifreniz minumum 6 karakter olmak zorundadır.</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="mukerrerkayit") { ?>
						<div class="alert alert-danger alert-dismissible">
							<strong>Bu kullanıcı daha önce kayıt edilmiştir.</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="basarisiz") { ?>
						<div class="alert alert-danger alert-dismissible">
							<strong>Kayıt yapılamadı. Lüften tekrar deneyiniz.</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="kgok") { ?>
						<div class="alert alert-success alert-dismissible">
							<strong>Güncelleme işleminiz başarıyla gerçekleşti.</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="kgno") { ?>
						<div class="alert alert-danger alert-dismissible">
							<strong>Güncelleme işleminiz gerçekleştirelemedi.</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="kullaniciyok") { ?>
						<div class="alert alert-danger alert-dismissible">
							<strong>Böyle bir kullanıcı bulunmamaktadır.</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="ksuok") { ?>
						<div class="alert alert-success alert-dismissible">
							<strong>Şifreniz başarıyla güncellendi.</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="ksuno") { ?>
						<div class="alert alert-danger alert-dismissible">
							<strong>Girdiğiniz bilgileri kontrol ediniz!</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="ksgok") { ?>
						<div class="alert alert-success alert-dismissible">
							<strong>Şifreniz başarıyla güncellendi.</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="ksgno") { ?>
						<div class="alert alert-danger alert-dismissible">
							<strong>Girdiğiniz bilgileri kontrol ediniz!</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="ygok") { ?>
						<div class="alert alert-success alert-dismissible">
							<strong>Yorumunuz başarılıyla gönderildi.</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="ygno") { ?>
						<div class="alert alert-danger alert-dismissible">
							<strong>Yorumunuz gönderilemedi!</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="seok") { ?>
						<div class="alert alert-success alert-dismissible">
							<strong>Sepete ekleme başarılıyla gerçekleşti.</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="seno") { ?>
						<div class="alert alert-danger alert-dismissible">
							<strong>Sepete ekleme başarısız!</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="sgok") { ?>
						<div class="alert alert-success alert-dismissible">
							<strong>Sepet güncelleme işlemi başarılıyla gerçekleşti.</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="sgno") { ?>
						<div class="alert alert-danger alert-dismissible">
							<strong>Sepet güncelleme başarısız!</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="siok") { ?>
						<div class="alert alert-success alert-dismissible">
							<strong>Sepet silme işlemi başarılıyla gerçekleşti.</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="sino") { ?>
						<div class="alert alert-danger alert-dismissible">
							<strong>Sepet silme başarısız!</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="bseok") { ?>
						<div class="alert alert-success alert-dismissible">
							<strong>Banka işlemi başarılıyla gerçekleşti.</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="bseno") { ?>
						<div class="alert alert-danger alert-dismissible">
							<strong>Banka işlemi başarısız!</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="msgok") { ?>
						<div class="alert alert-success alert-dismissible">
							<strong>Mesajınız başarılıyla iletildi.</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }elseif ($_GET['durum']=="bseno") { ?>
						<div class="alert alert-danger alert-dismissible">
							<strong>Mesaj gönderim işlemi başarısız!</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }
					
					?> 
				</div>
			<?php } ?>


