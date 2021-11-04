<?php include 'header.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


?>

<div class="container">
	<div class="row">
		<?php if (isset($_SESSION['userkullanici_mail'])) { ?>
			<form action="nedmin/netting/islem.php" method="POST" class="form-horizontal checkout" role="form">
				<div class="col-md-12">
					<div class="title-bg">
						<div class="title">Kayıt Bilgileri</div>
					</div>
					
					<div class="form-group dob">
						<div class="col-sm-12">
							<label>
								Adınızı ve soyadınızı giriniz...
							</label>
							<input type="text"  class="form-control" name="kullanici_adsoyad"  value="<?php echo $kullanicicek['kullanici_adsoyad']; ?>">
						</div>						
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<label>
								Kullanıcı adınızı değiştiremezsiniz...
							</label>
							<input type="email" disabled="" class="form-control" value="<?php echo $kullanicicek['kullanici_mail']; ?>">
						</div>
					</div>
					<div class="form-group dob">
						<div class="col-sm-6">
							<label>
								T.C. kimlik numaranızı giriniz...
							</label>
							<input type="text"  name="kullanici_tc" maxlength="11" minlength="11" class="form-control" value="<?php echo $kullanicicek['kullanici_tc']; ?>">
						</div>
						<div class="col-sm-6">
							<label>
								Telefon numaranızı giriniz...
							</label>
							<input type="tel" class="form-control" name="kullanici_gsm" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Örnek: 123-456-7890" value="<?php echo $kullanicicek['kullanici_gsm']; ?>">

						</div>
					</div>

					<div class="form-group dob">
						<div class="col-sm-6">
							<label>
								Yaşadığınız ili giriniz...
							</label>
							<input type="text" name="kullanici_il" class="form-control" value="<?php echo $kullanicicek['kullanici_il']; ?>">
						</div>
						<div class="col-sm-6">
							<label>
								Yaşadığınız ilçeyi giriniz...
							</label>
							<input type="text" name="kullanici_ilce" class="form-control" value="<?php echo $kullanicicek['kullanici_ilce']; ?>">
						</div>
					</div>
					<div class="form-group dob">
						<div class="col-sm-12">
							<label>
								Adresinizi giriniz...
							</label>
							<textarea class="form-control" name="kullanici_adres"><?php echo $kullanicicek['kullanici_adres']; ?></textarea>

						</div>
					</div>
					<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']; ?>">
					<button type="submit" name="kullanicibilgiguncelle" class="btn btn-default btn-red">Bilgilerimi Güncelle!</button>
				</div>
				<div class="col-md-12">					
					<div class="title-bg">
						<div class="title">Şifre Güncelleme</div>
						
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<label>
								Eski şifrenizi giriniz...
							</label>
							<input type="password" class="form-control" name="eski_sifre">
						</div>
					</div>
					<div class="form-group dob">
						<div class="col-sm-6">
							<label>
								Yeni şifrenizi giriniz...
							</label>
							<input type="password" name="yeni_sifre1" minlength="6" class="form-control">
						</div>
						<div class="col-sm-6">
							<label>
								Yeni şifrenizi tekrar giriniz...
							</label>
							<input type="password" name="yeni_sifre2" minlength="6" class="form-control">

						</div>
					</div>
					<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']; ?>">
					<button type="submit" name="kullanicisifreguncelle" class="btn btn-default btn-red">Şifremi Güncelle!</button>
				</div>
			</form>

		<?php } else { 
			if (!isset($_GET['kod'])) {	?>

				<form action="" method="POST" class="form-horizontal checkout" role="form">
					<div class="col-md-12">

						<div class="form-group">
							<div class="col-sm-12">
								<label>
									Lütfen mail adresinizi giriniz...
								</label>
								<input type="email" required="" class="form-control" name="kullanici_mail">
							</div>
						</div>
						<button type="submit" name="kodgonder" class="btn btn-default btn-red">Kod Gönder!</button>
						<?php
						if (isset($_POST['kodgonder'])) {
							session_destroy();
							session_start();
							$_SESSION['kkodmaili']=$_POST['kullanici_mail'];
						}
						?>
					</div>
				</form>
				<?php 
				if (isset($_POST['kodgonder'])) {


					$varmi=$db->prepare("SELECT * from kullanici where kullanici_mail=:kullanici_mail and kullanici_durum=:durum");						
					$varmi->execute(array('kullanici_mail'=>$_POST['kullanici_mail'],'durum'=>1));
					$kullanicicek=$varmi->fetch(PDO::FETCH_ASSOC);
					if (isset($_POST['kodgonder'])) {
						if ($varmi->rowCount()) {
							$sifirlamakodu=uniqid();
							$sifirlamalinki="http://localhost/hesapislemleri.php?kod=".$sifirlamakodu;
							$sifirlamakodunuekle=$db->prepare("UPDATE kullanici SET kullanici_sifirlamakodu=:kullanici_sifirlamakodu where kullanici_mail=:kullanici_mail");
							$sifirlamakodunuekle->execute(array('kullanici_sifirlamakodu'=>$sifirlamakodu,'kullanici_mail'=>$_POST['kullanici_mail']));

							$mail= new PHPMailer(true);
							try{

								$alici=$_POST['kullanici_mail'];
								$mail->IsSMTP();
							$mail->Host="localhost";//smtp host gelecek
							$mail->Post=587;//smtp port gelecek
							$mail->SMTPSecure='tls';//boşta oto tls alır
							$mail->SMTPAuth=true;
							$mail->Username="ghosteros31@gmil.com";//mail adaresi
							$mail->Password="65206007512Tt";//smtp şifre
							$mail->addAddress("$alici");
							$mail->From="ghosteros31@mail.com";//gönderen kişi
							$mail->FromName="Şifremi Unuttum!";//mail başlığı
							$mail->CharSet="UTF-8";
							$mail->Subject="Şifremi Sıfırla";//mail konu
							$mailicerik="Merhaba ".$kullanicicek['kullanici_adsoyad'].". Şifreni sıfırlamak istediğine dair bilgi aldık. Senin için bir sıfırlama linki oluşturduk. İşte sıfırlama linkin: ".$sifirlamalinki." Eğer böyle birşey için başvuru yapmadıysan bu maili yoksayabilirsin...";
							$mail->MsgHTML($mailicerik);
							if ($mail->Send()) {
								echo "Şifre sıfırlama linkiniz gönderildi.";
							}else{
								echo "HATA";
							}
						}catch(Exception $e){
							echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
						}
					}
				}
			}
		}elseif(isset($_GET['kod'])){

			$varmi=$db->prepare("SELECT * from kullanici where kullanici_mail=:kullanici_mail and kullanici_durum=:durum");						
			$varmi->execute(array('kullanici_mail'=>$_SESSION['kkodmaili'],'durum'=>1));
			$kullanicicek=$varmi->fetch(PDO::FETCH_ASSOC);

			$kod=$kullanicicek['kullanici_sifirlamakodu'];
			if ($_GET['kod']=="$kod") { ?>
				
				<form action="nedmin/netting/islem.php" method="POST" class="form-horizontal checkout" role="form">
					<div class="col-md-12">
						<div class="title-bg">
							<div class="title">Şifremi Unuttum</div>				
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<label>
									Lütfen mail adresinizi giriniz...
								</label>
								<input type="email" required="" class="form-control" name="kullanici_mail">
							</div>
						</div>
						<div class="form-group dob">
							<div class="col-sm-6">
								<label>
									Yeni şifrenizi giriniz...
								</label>
								<input type="password" required="" name="kullanici_yeni_sifre1" minlength="6" class="form-control">
							</div>
							<div class="col-sm-6">
								<label>
									Yeni şifrenizi tekrar giriniz...
								</label>
								<input type="password" required="" name="kullanici_yeni_sifre2" minlength="6" class="form-control">

							</div>
						</div>
						<input type="hidden" name="kod" value="<?php echo $kullanicicek['kullanici_sifirlamakodu'] ?>">

						<button type="submit" name="kullanicisifreunuttum" class="btn btn-default btn-red">Şifremi Güncelle!</button>
					</div>
				</form>

			<?php }else{ ?>
				<div class="alert alert-danger">
					<label>
						Yanlış kod!
					</label>
				</div>
			<?php }
		}

	} ?>


</div>
<div class="spacer"></div>
</div>


<?php include 'footer.php'; ?>