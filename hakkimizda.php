<?php 
include 'header.php';
$hakkimizdasor=$db->prepare("SELECT * FROM hakkimizda where hakkimizda_id=:id");
$hakkimizdasor->execute(array(
    'id'=>0//ayar_id deki veri 0 ise çekme işlemi olur
));
$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);

?>


<div class="container">

	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title">Tanıtım Videosu</div>
			</div>
			<iframe width="700" height="450" src="https://www.youtube.com/embed/<?php echo $hakkimizdacek['hakkimizda_video'] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

			<div class="title-bg">
				<div class="title"><?php echo $hakkimizdacek['hakkimizda_baslik']; ?></div>
			</div>
			<div class="page-content">
				<p>
					<?php echo $hakkimizdacek['hakkimizda_icerik']; ?>
				</p>					
			</div>
			<div class="title-bg">
				<div class="title">Misyon</div>
			</div>
			<blockquote><?php echo $hakkimizdacek['hakkimizda_misyon']; ?></blockquote>

			<div class="title-bg">
				<div class="title">Vizyon</div>
			</div>
			<blockquote><?php echo $hakkimizdacek['hakkimizda_vizyon']; ?></blockquote>


		</div>

		<!-- sidebar -->
		<?php include 'sidebar.php'; ?>
		<!-- sidebar -->

	</div>
	<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>