<?php include 'header.php'; 
if (isset($_GET['sef'])) {
	$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:urun_id and urun_durum=:urun_durum");
	$urunsor->execute(array(
		'urun_id'=>$_GET['urun_id'],
		'urun_durum'=>1
	));
	$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
	if ($urunsor->rowCount()==0) {
		header("Location:index");		
	}
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title"><?php echo $uruncek['urun_ad']; ?></div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<?php 
					$urun_id=$uruncek['urun_id'];
					$urunfotosor=$db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id order by urunfoto_sira ASC limit 1");
					$urunfotosor->execute(array('urun_id'=>$urun_id));
					$urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC);
					?>

					<div class="dt-img">
						<div class="detpricetag"><div class="inner"><?php echo $uruncek['urun_fiyat'] ?> ₺</div></div><?php
						while($urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC)){
							if($urunfotosor->rowCount()){ ?>
								<a href="urun-<?php echo $uruncek['urun_seourl']."-".$uruncek['urun_id'] ?>"><img src="<?php echo $urunfotocek['urunfoto_resimyol']; ?>" alt="" class="img-responsive"></a>
							<?php }
						} ?>
						<?php if($urunfotosor->rowCount()==0){ ?>
							<a href="urun-<?php echo $uruncek['urun_seourl']."-".$uruncek['urun_id'] ?>"><img src="dimg/resim-yok.png" alt="" class="img-responsive"></a>

						<?php } ?>
					</div>
					<?php 
					$urun_id=$uruncek['urun_id'];
					$urunfotosor=$db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id order by urunfoto_sira ASC limit 1,3");
					$urunfotosor->execute(array('urun_id'=>$urun_id));
					while($urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC)){
						?>

						
						<div class="thumb-img">
							<a class="fancybox" href="<?php echo $urunfotocek['urunfoto_resimyol']; ?>" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="<?php echo $urunfotocek['urunfoto_resimyol']; ?>" alt="" class="img-responsive"></a>
						</div>
					<?php } ?>
				</div>
				<div class="col-md-6 det-desc">
					<div class="productdata">
						<div class="infospan">Ürün Kodu <span><?php echo $uruncek['urun_id'] ?></span></div>
						<div class="infospan">Ürün Fiyatı <span><?php echo $uruncek['urun_fiyat'] ?> ₺</span></div>
						

						<div class="clearfix"></div>


						<div class="dash"></div>
						<div class="spacer"></div>
						<form action="nedmin/netting/islem.php" method="POST">
							<div class="form-group">
								<label class="col-sm-2 control-label">Adet</label>
								<div class="col-sm-4">
									<input type="number" min="1" class="form-control" value="1" name="urun_adet">
								</div>

								<div class="col-sm-4">
									<?php 
									if (isset($_SESSION['userkullanici_mail'])) { ?>
										<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">
									<?php }
									?>
									
									<input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">	
									<?php 
									if(!$uruncek['urun_stok']>=1){ ?>
										<button class="btn btn-default btn-red btn-sm" disabled="" name="sepetekle"><span class="addchart">Ürün tükenmiştir.</span></button>

									<?php }
									elseif (isset($_SESSION['userkullanici_mail'])) { 

										?>

										<button class="btn btn-default btn-red btn-sm" name="sepetekle"><span class="addchart">Sepete Ekle</span></button>
									<?php }else{ ?>
										<button class="btn btn-default btn-red btn-sm" disabled="" name="sepetekle"><span class="addchart">Giriş Yap!</span></button>
									<?php }	?>
								</div>
							</form>

							<div class="clearfix"></div>
						</div>
						<div class="sharing">
							<div class="avatock">Ürün Stok Adeti:
								<?php 
								if (!$uruncek['urun_stok']>=1) {
									echo "Üründen stokta kalmamıştır.";
								}else{ 
									echo "<span>";

									echo $uruncek['urun_stok']." Adet";
								}

								?></span>
							</div>
							<br>
							<a class="addthis_counter addthis_pill_style"></a>
							<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f0d0827271d1c3b"></script>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			<?php 
			if (isset($_SESSION['userkullanici_mail'])) {
				$kullanici_id=$kullanicicek['kullanici_id'];
			}


			$urun_id=$uruncek['urun_id'];

			$yorum=$db->prepare("SELECT * FROM yorumlar where urun_id=:urun_id and yorum_onay=:yorum_onay");
			$yorum->execute(array(				
				'urun_id'=>$urun_id,
				'yorum_onay'=>1
			));

			?>

			<div class="tab-review">
				<ul id="myTab" class="nav nav-tabs shop-tab">
					<li class="
					<?php 
					if (!isset($_GET['durum'])) {?>
						active
						<?php } ?>"><a href="#desc" data-toggle="tab">Ürün Detayı</a></li>
						<li class="<?php 
						if (isset($_GET['durum'])) {?>
							active
							<?php } ?>"><a href="#rev" data-toggle="tab">Yorumlar (<?php echo $yorum->rowCount(); ?>)</a></li>
							<li class=""><a href="#video" data-toggle="tab">Video</a></li>
						</ul>
						<div id="myTabContent" class="tab-content shop-tab-ct">
							<div class="tab-pane fade <?php if(!isset($_GET['durum'])){ ?> active in <?php } ?>" id="desc">
								<?php echo $uruncek['urun_detay'] ?>
							</div>

							<div class="tab-pane fade <?php if(isset($_GET['durum'])){ ?> active in <?php } ?>" id="rev">
								<?php 


								while ($yorumcek=$yorum->fetch(PDO::FETCH_ASSOC)) {
									$kullanici_id2=$yorumcek['kullanici_id'];
									$kullanicisor2=$db->prepare("SELECT * FROM kullanici where kullanici_id=:kullanici_id");
									$kullanicisor2->execute(array(
										'kullanici_id'=>$kullanici_id2
									));
									$kullanicicek2=$kullanicisor2->fetch(PDO::FETCH_ASSOC);


									?>
									<p class="dash">
										<span><?php echo $kullanicicek2['kullanici_adsoyad'] ?></span> (<?php echo $yorumcek['yorum_zaman']; ?>)<br><br>
										<?php echo $yorumcek['yorum_detay']; ?>
									</p>
								<?php } ?>
								<h4>Yorum Yaz</h4>
								<form role="form" action="nedmin/netting/islem.php" method="POST">							
									<div class="form-group">
										<textarea class="form-control" id="text" name="yorum_detay"></textarea>
									</div>
									<?php 
									if (isset($_SESSION['userkullanici_mail'])) { ?>
										<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">
									<?php }
									?>

									<input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">
									<input type="hidden" name="url" value="<?php echo "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']."" ?>">

									<?php if (isset($_SESSION['userkullanici_mail'])){ ?>
										<button type="submit" class="btn btn-default btn-red btn-sm" name="yorumgonder">Gönder</button>
									<?php }else{ ?>
										<button type="submit" disabled="" class="btn btn-default btn-red btn-sm">Gönder</button> <a href="register">Üye</a> ol yada giriş yap!
									<?php } ?>
								</form>

							</div>
							<div class="tab-pane fade" id="video">
								<?php if(strlen($uruncek['urun_video'])>0){ ?>
									<iframe width="650" height="450" src="https://www.youtube.com/embed/<?php echo $uruncek['urun_video'] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								<?php }else{ ?>
									Ürüne ait video bulunmamaktır.
								<?php } ?>

							</div>
						</div>
					</div>

					<div id="title-bg">
						<div class="title">Benzer Ürünler</div>
					</div>
					<div class="row prdct"><!--Products-->

						<?php
						$kategori_id=$uruncek['kategori_id'];
						$urunaltsor=$db->prepare("SELECT * FROM urun where kategori_id=:kategori_id order by rand() limit 3");
						$urunaltsor->execute(array(
							'kategori_id'=>$kategori_id
						));
						while ($urunaltcek=$urunaltsor->fetch(PDO::FETCH_ASSOC)) {	?>
							<div class="col-md-4">
								<div class="productwrap">
									<div class="pr-img">
										<div class="hot"></div> <!-- BU HOT YAZISI İÇİN ÜRÜNE ESKİ YENİ DİYE ALAN AÇ -->
										<?php
										$urun_id=$urunaltcek['urun_id'];
										$urunfotosor=$db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id order by urunfoto_sira ASC limit 1");
										$urunfotosor->execute(array('urun_id'=>$urun_id));
										while($urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC)){
											if($urunfotosor->rowCount()){ ?>
												<a href="urun-<?php echo $uruncek['urun_seourl']."-".$uruncek['urun_id'] ?>"><img src="<?php echo $urunfotocek['urunfoto_resimyol']; ?>" alt="" class="img-responsive"></a>
											<?php }
										} ?>
										<?php if($urunfotosor->rowCount()==0){ ?>
											<a href="urun-<?php echo $uruncek['urun_seourl']."-".$uruncek['urun_id'] ?>"><img src="dimg/resim-yok.png" alt="" class="img-responsive"></a>

										<?php } ?>
										<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice"><?php echo $urunaltcek['urun_fiyat']*1.50; echo " ₺"; ?></span><?php echo $urunaltcek['urun_fiyat']; echo " ₺"; ?></span></div></div>
									</div>
									<span class="smalltitle"><a href="urun-<?php echo $urunaltcek['urun_seourl']."-".$urunaltcek['urun_id'] ?>"><?php echo $urunaltcek['urun_ad']; ?></a></span>
									<span class="smalldesc">Ürün Kodu: <?php echo $urunaltcek['urun_id']; ?></span>
								</div>
							</div>
						<?php } ?>
					</div><!--Products-->
					<div class="spacer"></div>
				</div><!--Main content-->
				<?php include 'sidebar.php'; ?>
			</div>
		</div>

		<?php include 'footer.php'; ?>