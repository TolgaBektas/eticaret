<?php include 'header.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-12">							
							<div class="bigtitle">İletişime Geçmek İçin Formu Doldurunuz!</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<form action="" method="POST" class="form-horizontal checkout" role="form">
			<div class="col-md-6">
				<div class="title-bg">
					<div class="title">İletişim Bilgileri</div>
				</div>
				
				<div class="form-group dob">
					<div class="col-sm-6">
						<label>
							Adınız ve soyadınızı giriniz...
						</label>
						<input required="" type="text" name="iletisim_adsoyad" class="form-control">
					</div>
					<div class="col-sm-6">
						<label>
							Mail adresnizi giriniz...
						</label>
						<input required="" type="email" name="iletisim_mail" class="form-control">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-12">
						<label>
							Lütfen mesajınızı giriniz...
						</label>
						<textarea class="form-control" required="" name="iletisim_mesaj"></textarea>
						
					</div>
					
				</div>

				<button type="submit" name="iletisimgonder" class="btn btn-default btn-red">Mesaj Gönder!</button>
				<?php 

				if (isset($_POST['iletisimgonder'])) {

					$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
					$ayarsor->execute(array('id'=>0));
					$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

					$kimden=$_POST['iletisim_adsoyad'];
					$gonderenmail=$_POST['iletisim_mail'];
					$mesaj=$_POST['iletisim_mesaj'];


					$mail= new PHPMailer(true);
					try{
						$smtphost=$ayarcek['ayar_smtphost'];
						$smtpport=$ayarcek['ayar_smtpport'];
						$smtpuser=$ayarcek['ayar_smtpuser'];
						$smtppassword=$ayarcek['ayar_smtppassword'];


							$mail->isSMTP();
						$mail->Host="$smtphost";//smtp host gelecek
						$mail->Post=$smtpport;//smtp port gelecek
						$mail->SMTPSecure='tls';//boşta oto tls alır
						$mail->SMTPAuth=true;
						$mail->Username="$smtpuser";//mail adaresi
						$mail->Password="$smtppassword";//smtp şifre
						$mail->addAddress("$smtpuser");
						$mail->SetFrom("$gonderenmail");//gönderen kişi
						$mail->FromName="$gonderenmail";//mail başlığı
						$mail->CharSet="UTF-8";
						$mail->Subject="Bir mesajınız var!";//mail konu
						$mailicerik="$mesaj";
						$mail->MsgHTML($mailicerik);
						if ($mail->Send()) {
							header("Location:iletisim?durum=msgok");
						}else{
							header("Location:iletisim?durum=msgno");
						}
					}catch(Exception $e){
						echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					}
			}
			?>
		</div>
	</form>
	<div class="col-md-6">
		<div class="title-bg">
			<div class="title">Google Maps</div>
		</div>			





	</div>



</div>

<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>