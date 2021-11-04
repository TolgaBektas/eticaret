<?php  include 'header.php';


$sayfada = 9;
$kategorisor=$db->prepare("SELECT * FROM kategori where kategori_seourl=:kategori_seourl");
$kategorisor->execute(array(		
	'kategori_seourl'=>$_GET['sef']		
));					
$kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC);
$kategori_id=$kategoricek['kategori_id'];

$urunsor=$db->prepare("SELECT * FROM urun where kategori_id=:kategori_id");
$urunsor->execute(array(
	'kategori_id'=>$kategori_id
));
$toplam_icerik=$urunsor->rowCount();

$toplam_sayfa = ceil($toplam_icerik / $sayfada);
$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
if($sayfa < 1) $sayfa = 1; 
if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
$limit = ($sayfa - 1) * $sayfada;         



$urunsor=$db->prepare("SELECT * FROM urun where kategori_id=:kategori_id order by urun_id DESC limit $limit, $sayfada");
$urunsor->execute(array(
	'kategori_id'=>$kategori_id
));
?>

<div class="container">
	<div class="clearfix"></div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title">Ürünler - <?php echo $kategoricek['kategori_ad'] ?></div>
			</div>
			<div class="row prdct">
				<!--Products-->
				<?php 
				if ($toplam_icerik==0) {
					echo "Ürün Bulunamadı.";
				}
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
			</div>
			<ul class="pagination shop-pag">
				<?php
				$sayfaurl=$_GET['sef'];
				$s=0;
				while ($s < $toplam_sayfa) {
					$s++;
					if ($s==$sayfa) {?>
						<li class="active"><a href="kategori-<?php echo $sayfaurl; ?>?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>
					<?php } else {?>
						<li><a href="kategori-<?php echo $sayfaurl; ?>?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>
					<?php }
				} ?>


			</ul>
		</div>
		<?php include 'sidebar.php'; ?>
	</div>
	<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>
