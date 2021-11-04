<?php 
include 'header.php';
$hakkimizdasor=$db->prepare("SELECT * FROM hakkimizda where hakkimizda_id=:id");
$hakkimizdasor->execute(array(
    'id'=>0//ayar_id deki veri 0 ise çekme işlemi olur
));
$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);

?>

<div class="container">
	
	

	<div class="clearfix"></div>
	<div class="lines"></div>
	<?php include 'slider.php'; ?>
</div>
<div class="f-widget featpro">
	<div class="container">
		<div class="title-widget-bg">
			<div class="title-widget">Öne Çıkanlar</div>
			<div class="carousel-nav">
				<a class="prev"></a>
				<a class="next"></a>
			</div>
		</div>
		<div id="product-carousel" class="owl-carousel owl-theme">	
			<?php 
			$urunsor=$db->prepare("SELECT * FROM urun where urun_onecikar=:urun_onecikar and urun_durum=:urun_durum");
			$urunsor->execute(array(
				'urun_onecikar'=>1,
				'urun_durum'=>1
			));
			while ($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {

				$urun_id=$uruncek['urun_id'];
				$urunfotosor=$db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id order by urunfoto_sira ASC limit 1");
				$urunfotosor->execute(array('urun_id'=>$urun_id));
				
				?>		
				<div class="item">
					<div class="productwrap">
						<div class="pr-img"><?php
						while($urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC)){
							if($urunfotosor->rowCount()){ ?>
								<a href="urun-<?php echo $uruncek['urun_seourl']."-".$uruncek['urun_id'] ?>"><img src="<?php echo $urunfotocek['urunfoto_resimyol']; ?>" alt="" class="img-responsive"></a>
							<?php }
						} ?>
						<?php if($urunfotosor->rowCount()==0){ ?>
							<a href="urun-<?php echo $uruncek['urun_seourl']."-".$uruncek['urun_id'] ?>"><img src="dimg/resim-yok.png" alt="" class="img-responsive"></a>

						<?php } ?>
						<div class="pricetag blue"><div class="inner"><span><?php echo $uruncek['urun_fiyat'] ?> ₺</span></div></div>
					</div>
					<span class="smalltitle"><a href="urun-<?php echo $uruncek['urun_seourl']."-".$uruncek['urun_id'] ?>"><?php echo $uruncek['urun_ad'] ?></a></span>
					<span class="smalldesc"><?php echo $uruncek['urun_id'] ?></span>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
</div>



<div class="container">
	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title">Hakkımızda</div>
			</div>			
			<p class="ct">
				<?php echo substr($hakkimizdacek['hakkimizda_icerik'],0,750); ?>...		
			</p>
			<a href="hakkimizda" class="btn btn-default btn-red btn-sm">Devamını Oku</a>
			
			<div class="title-bg">
				<div class="title">En Son Eklenen Ürünler</div>
			</div>
			<div class="row prdct">
				<?php 
				$urunsor=$db->prepare("SELECT * FROM urun where urun_durum=:urun_durum order by urun_id desc limit 6");
				$urunsor->execute(array('urun_durum'=>1));
				while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)){
					?>



					<div class="col-md-4">
						<div class="productwrap">
							<div class="pr-img">
								<div class="hot"></div> <!-- BU HOT YAZISI İÇİN ÜRÜNE ESKİ YENİ DİYE ALAN AÇ -->
								<?php 
								$urun_id=$uruncek['urun_id'];
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
								<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice"><?php echo $uruncek['urun_fiyat']*1.50; echo " ₺"; ?></span><?php echo $uruncek['urun_fiyat']; echo " ₺"; ?></span></div></div>
							</div>
							<span class="smalltitle"><a href="urun-<?php echo $uruncek['urun_seourl']."-".$uruncek['urun_id'] ?>"><?php echo $uruncek['urun_ad']; ?></a></span>
							<span class="smalldesc">Ürün Kodu: <?php echo $uruncek['urun_id']; ?></span>
						</div>
					</div>
				<?php } ?>



			</div><!--Products-->
			<div class="spacer"></div>
		</div><!--Main content-->
		<?php include 'sidebar.php'; ?>
	</div>
</div>
<?php 
include 'footer.php';
?>