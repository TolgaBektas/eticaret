<?php include 'header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-12">							
							<div class="bigtitle">Kayıt Olmak İçin Formu Doldurunuz!</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<form action="nedmin/netting/islem.php" method="POST" class="form-horizontal checkout" role="form">
			<div class="col-md-12">
				<div class="title-bg">
					<div class="title">Kayıt Bilgileri</div>
				</div>
				<?php 
				if (isset($_GET['durum'])) {
					if ($_GET['durum']=="farklisifre") { ?>
						<div class="alert alert-danger">
							<strong>Girdiğiniz şifreler eşleşmiyor.</strong>
						</div>
					<?php }elseif ($_GET['durum']=="eksiksifre") { ?>
						<div class="alert alert-danger">
							<strong>Şifreniz minumum 6 karakter olmak zorundadır.</strong>
						</div>
					<?php }elseif ($_GET['durum']=="mukerrerkayit") { ?>
						<div class="alert alert-danger">
							<strong>Bu kullanıcı daha önce kayıt edilmiştir.</strong>
						</div>
					<?php }elseif ($_GET['durum']=="basarisiz") { ?>
						<div class="alert alert-danger">
							<strong>Kayıt yapılamadı. Lüften tekrar deneyiniz.</strong>
						</div>
					<?php }elseif ($_GET['durum']=="eksikveyafazlatc") { ?>
						<div class="alert alert-danger">
							<strong>Eksik veya fazla tc girildi. Lüften tekrar deneyiniz.</strong>
						</div>
					<?php }
				} ?>
				<div class="form-group">
					<div class="col-sm-12">
						<label>
							Adınızı ve soyadınızı giriniz.
						</label>
						<input required="" type="text" class="form-control" name="kullanici_adsoyad" placeholder="Ad ve Soyadını Giriniz...">
					</div>						
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<label>
							Mail adresinizi giriniz...(Mailiniz kullanıcı adınız olarak kullanılacaktır.)
						</label>
						<input required="" type="email" class="form-control" name="kullanici_mail">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-6">
						<label>
							Şifrenizi giriniz...
						</label>
						<input required="" type="password" name="kullanici_passwordone" class="form-control">
					</div>
					<label>
						Şifrenizi tekrar giriniz...
					</label>
					<div class="col-sm-6">
						<input required="" type="password" name="kullanici_passwordtwo" class="form-control">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-6">
						<label>
							T.C. kimlik numaranızı giriniz...
						</label>
						<input type="text" required="" maxlength="11" minlength="11" name="kullanici_tc" class="form-control">
					</div>
					<div class="col-sm-6">
						<label>
							Telefon numaranızı giriniz...
						</label>
						<input type="tel" required="" class="form-control" name="kullanici_gsm" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required="" placeholder="Örnek: 123-456-7890">
						
					</div>
				</div>
				
				<div class="form-group dob">
					<div class="col-sm-6">
						<label>
							Yaşadığınız ili giriniz...
						</label>
						<input required="" type="text" name="kullanici_il" class="form-control">
					</div>
					<div class="col-sm-6">
						<label>
							Yaşadığınız ilçeyi giriniz...
						</label>
						<input required="" type="text" name="kullanici_ilce" class="form-control">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-12">
						<label>
							Adresinizi giriniz...
						</label>
						<textarea class="form-control" required="" name="kullanici_adres" placeholder="Siparişinizi en hızlı şekilde size ulaştırabilmemiz için adresinizi doğru ve tam yazınız."></textarea>
						
					</div>
					
				</div>

				<button type="submit" name="kullanicikaydet" class="btn btn-default btn-red">Kayıt Ol!</button>
			</div>
		</form>



		
	</div>

	<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>