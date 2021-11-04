<?php 
ob_start();
session_start();
include 'baglan.php';
include '../production/fonksiyon.php';
###################################################################################################
//login sayfası admin girişi BAŞLANGIÇ
if (isset($_POST['admingiris'])) {
	$kullanici_mail= htmlspecialchars($_POST['kullanici_mail']);
	$kullanici_password=md5(htmlspecialchars($_POST['kullanici_password']));

	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail and kullanici_password=:password and kullanici_yetki=:yetki");
	$kullanicisor->execute(array(
		'mail'=>$kullanici_mail,
		'password'=>$kullanici_password,
		'yetki'=>5
	));
	$say=$kullanicisor->rowCount();
	if ($say==1) {
		$_SESSION['kullanici_mail']=$kullanici_mail;
		header("Location:../production/index.php");
		exit;

	}else{
		header("Location:../production/login.php?durum=no");
		exit;
	}
}
//login sayfası admin girişi BİTİŞ
###################################################################################################
//login sayfası kullanıcı girişi BAŞLANGIÇ
if (isset($_POST['kullanicigiris'])) {
	$kullanici_mail= htmlspecialchars($_POST['kullanici_mail']);
	$kullanici_password=md5(htmlspecialchars($_POST['kullanici_password']));
	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail and kullanici_password=:password and kullanici_yetki=:yetki and kullanici_durum=:durum");
	$kullanicisor->execute(array(
		'mail'=>$kullanici_mail,
		'password'=>$kullanici_password,
		'durum'=>1,
		'yetki'=>1
	));
	$say=$kullanicisor->rowCount();
	if ($say==1) {
		$_SESSION['userkullanici_mail']=$kullanici_mail;
		header("Location:../../index?durum=girisbasarili");
		exit;
	}else{
		header("Location:../../index?durum=girisbasarisiz");
		exit;
	}
}

//login sayfası kullanıcı girişi BİTİŞ
###################################################################################################
//kullanici düzenleme - güncelle BAŞLANGIÇ
if (isset($_POST['kullanicibilgiguncelle'])) {
	$kullanici_id=htmlspecialchars($_POST['kullanici_id']);
	$kullanicikaydet=$db->prepare("UPDATE kullanici SET 		
		kullanici_adsoyad=:kullanici_adsoyad,
		kullanici_tc=:kullanici_tc,
		kullanici_gsm=:kullanici_gsm,
		kullanici_il=:kullanici_il,
		kullanici_ilce=:kullanici_ilce,
		kullanici_adres=:kullanici_adres
		WHERE kullanici_id=$kullanici_id");
	$update=$kullanicikaydet->execute(array(		
		'kullanici_adsoyad'=>htmlspecialchars($_POST['kullanici_adsoyad']),
		'kullanici_tc'=>htmlspecialchars($_POST['kullanici_tc']),
		'kullanici_gsm'=>htmlspecialchars($_POST['kullanici_gsm']),
		'kullanici_il'=>htmlspecialchars($_POST['kullanici_il']),
		'kullanici_ilce'=>htmlspecialchars($_POST['kullanici_ilce']),
		'kullanici_adres'=>htmlspecialchars($_POST['kullanici_adres'])
	));
	if ($update) {
		header("Location:../../hesapislemleri?durum=kgok");
		exit;
	}else{
		header("Location:../../hesapislemleri?durum=kgno");//kg kullanicigüncelle
		exit;
	}
}
//kullanici düzenleme - güncelle BİTİŞ
###################################################################################################
//register sayfası kullanıcı kayıt BAŞLANGIÇ
if (isset($_POST['kullanicikaydet'])) {
	$kullanici_adsoyad=htmlspecialchars($_POST['kullanici_adsoyad']);//güvenlik amacı için
	$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']);
	$kullanici_passwordone=htmlspecialchars($_POST['kullanici_passwordone']);
	$kullanici_passwordtwo=htmlspecialchars($_POST['kullanici_passwordtwo']);

	$kullanici_tc=htmlspecialchars($_POST['kullanici_tc']);//11 karakter olmalı
	$kullanici_gsm=htmlspecialchars($_POST['kullanici_gsm']);
	$kullanici_il=htmlspecialchars($_POST['kullanici_il']);
	$kullanici_ilce=htmlspecialchars($_POST['kullanici_ilce']);
	$kullanici_adres=htmlspecialchars($_POST['kullanici_adres']);

	if ($kullanici_passwordone==$kullanici_passwordtwo) {
		if (strlen($kullanici_tc)==11) {
			

			if (strlen($kullanici_passwordone)>=6) {
				$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail");
				$kullanicisor->execute(array(
					'mail'=>$kullanici_mail
				));
				$say=$kullanicisor->rowCount();
				if ($say==0) {
					$password=md5($kullanici_passwordone);
					$kullanici_yetki=1;
					$kullanici_durum=1;

					$kullanicikaydet=$db->prepare("INSERT INTO kullanici SET
						kullanici_adsoyad=:kullanici_adsoyad,
						kullanici_mail=:kullanici_mail,
						kullanici_password=:kullanici_password,
						kullanici_yetki=:kullanici_yetki,
						kullanici_durum=:kullanici_durum
						");
					$insert=$kullanicikaydet->execute(array(
						'kullanici_adsoyad'=>$kullanici_adsoyad,
						'kullanici_mail'=>$kullanici_mail,
						'kullanici_password'=>$password,
						'kullanici_yetki'=>$kullanici_yetki,
						'kullanici_durum'=>$kullanici_durum
					));
					if ($insert){
						header("Location:../../index?durum=loginbasarili");
						exit;
					}else{
						header("Location:../../register?durum=basarisiz");
						exit;
					}
				}else{
					header("Location:../../register?durum=mukerrerkayit");
					exit;
				}
			}else{
				header("Location:../../register?durum=eksiksifre");
				exit;
			}
		}else{
			header("Location:../../register?durum=eksikveyafazlatc");
			exit;
		}
	}else{
		header("Location:../../register?durum=farklisifre");
		exit;
	}

}
//register sayfası kullanıcı kayıt BİTİŞ
###################################################################################################

//kullanıcı şifre unuttum BAŞLANGIÇ
if (isset($_POST['kullanicisifreunuttum'])) {
	$kod=htmlspecialchars($_POST['kod']);
	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail and kullanici_durum=:durum");
	$kullanicisor->execute(array(
		'mail'=>htmlspecialchars($_POST['kullanici_mail']),
		'durum'=>1
	));
	$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
	if ($kullanicisor->rowCount()) {		
		$kullanici_sifre1=htmlspecialchars(md5($_POST['kullanici_yeni_sifre1']));
		$kullanici_sifre2=htmlspecialchars(md5($_POST['kullanici_yeni_sifre2']));

		if ($kullanici_sifre1==$kullanici_sifre2){
			$kullanici_id=$kullanicicek['kullanici_id'];
			
			$bankaguncelle=$db->prepare("UPDATE kullanici SET kullanici_password=:kullanici_password, kullanici_sifirlamakodu=:kullanici_sifirlamakodu where kullanici_id=:kullanici_id and kullanici_sifirlamakodu=:kod");
			$kaydet=$bankaguncelle->execute(array('kullanici_password'=>$kullanici_sifre1,'kullanici_sifirlamakodu'=>'','kullanici_id'=>$kullanici_id,'kod'=>$kod));
			if ($kaydet) {
				header("Location:../../hesapislemleri.php?durum=ksuok");//ksu kullanici sifre unuttum
				exit;
			}else{
				header("Location:../../hesapislemleri?kod=$kod&durum=ksuno");
				exit;
			}
		}else{			
			header("Location:../../hesapislemleri?kod=$kod&durum=farklisifre");
			exit;
		}
	}else{		
		header("Location:../../hesapislemleri?kod=$kod&durum=kullaniciyok");
		exit;
	}
}
//kullanıcı şifre unuttum BİTİŞ
###################################################################################################
//kullanıcı şifre güncelle BAŞLANGIÇ
if (isset($_POST['kullanicisifreguncelle'])) {
	$sifre1=htmlspecialchars(md5($_POST['yeni_sifre1']));
	$sifre2=htmlspecialchars(md5($_POST['yeni_sifre2']));
	$eski_sifre=htmlspecialchars(md5($_POST['eski_sifre']));
	$kullanici_id=htmlspecialchars($_POST['kullanici_id']);
	if ($sifre1==$sifre2){

		$bankaguncelle=$db->prepare("UPDATE kullanici SET kullanici_password=:kullanici_password where kullanici_id=:kullanici_id and kullanici_password=:password");
		$kaydet=$bankaguncelle->execute(array('kullanici_password'=>$sifre1,'kullanici_id'=>$kullanici_id,'password'=>$eski_sifre));
		if ($kaydet) {
			header("Location:../../hesapislemleri?durum=ksgok");//ksg kullanici sifre guncelle
			exit;
		}else{
			header("Location:../../hesapislemleri?durum=ksgno");
			exit;
		}
	}else{			
		header("Location:../../hesapislemleri?durum=farklisifre");
		exit;
	}
}
//kullanıcı şifre güncelle BİTİŞ
###################################################################################################
//genel ayarlar güncelleme BAŞLANGIÇ
if (isset($_POST['genelayarkaydet'])) {
	$ayarkaydet=$db->prepare("UPDATE ayar SET 
		ayar_title=:ayar_title,
		ayar_description=:ayar_description,
		ayar_keywords=:ayar_keywords,
		ayar_author=:ayar_author
		where ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'ayar_title'=>htmlspecialchars($_POST['ayar_title']),
		'ayar_description'=>htmlspecialchars($_POST['ayar_description']),
		'ayar_keywords'=>htmlspecialchars($_POST['ayar_keywords']),
		'ayar_author'=>htmlspecialchars($_POST['ayar_author'])
	));
	if ($update) {
		header("Location:../production/genel-ayar.php?durum=ok");
		exit;
	}else{
		header("Location:../production/genel-ayar.php?durum=no");
		exit;
	}
}
//genel ayarlar güncelleme BİTİŞ
###################################################################################################
//iletisim ayarlar güncelleme BAŞLANGIÇ
if (isset($_POST['iletisimayarkaydet'])) {
	$ayarkaydet=$db->prepare("UPDATE ayar SET 
		ayar_tel=:ayar_tel,
		ayar_gsm=:ayar_gsm,
		ayar_faks=:ayar_faks,
		ayar_mail=:ayar_mail,
		ayar_ilce=:ayar_ilce,
		ayar_il=:ayar_il,
		ayar_adres=:ayar_adres,
		ayar_mesai=:ayar_mesai
		where ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'ayar_tel'=>htmlspecialchars($_POST['ayar_tel']),
		'ayar_gsm'=>htmlspecialchars($_POST['ayar_gsm']),
		'ayar_faks'=>htmlspecialchars($_POST['ayar_faks']),
		'ayar_mail'=>htmlspecialchars($_POST['ayar_mail']),
		'ayar_ilce'=>htmlspecialchars($_POST['ayar_ilce']),
		'ayar_il'=>htmlspecialchars($_POST['ayar_il']),
		'ayar_adres'=>htmlspecialchars($_POST['ayar_adres']),
		'ayar_mesai'=>htmlspecialchars($_POST['ayar_mesai'])
	));
	if ($update) {
		header("Location:../production/iletisim-ayarlar.php?durum=ok");
		exit;
	}else{
		header("Location:../production/iletisim-ayarlar.php?durum=no");
		exit;
	}
}
//iletisim ayarlar güncelleme BİTİŞ
###################################################################################################
//api ayarlar güncelleme BAŞLANGIÇ
if (isset($_POST['apiayarkaydet'])) {
	$ayarkaydet=$db->prepare("UPDATE ayar SET 
		ayar_analystic=:ayar_analystic,
		ayar_maps=:ayar_maps,
		ayar_zopim=:ayar_zopim		
		where ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'ayar_analystic'=>$_POST['ayar_analystic'],
		'ayar_maps'=>$_POST['ayar_maps'],
		'ayar_zopim'=>$_POST['ayar_zopim']
		
	));
	if ($update) {
		header("Location:../production/api-ayarlar.php?durum=ok");
		exit;
	}else{
		header("Location:../production/api-ayarlar.php?durum=no");
		exit;
	}
}
//api ayarlar güncelleme BİTİŞ
###################################################################################################
//sosyal ayarlar güncelleme BAŞLANGIÇ
if (isset($_POST['sosyalayarkaydet'])) {
	$ayarkaydet=$db->prepare("UPDATE ayar SET 
		ayar_facebook=:ayar_facebook,
		ayar_twitter=:ayar_twitter,
		ayar_youtube=:ayar_youtube,	
		ayar_google=:ayar_google	
		where ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'ayar_facebook'=>htmlspecialchars($_POST['ayar_facebook']),
		'ayar_twitter'=>htmlspecialchars($_POST['ayar_twitter']),
		'ayar_youtube'=>htmlspecialchars($_POST['ayar_youtube']),
		'ayar_google'=>htmlspecialchars($_POST['ayar_google'])
		
	));
	if ($update) {
		header("Location:../production/sosyal-ayarlar.php?durum=ok");
		exit;
	}else{
		header("Location:../production/sosyal-ayarlar.php?durum=no");
		exit;
	}
}
//sosyal ayarlar güncelleme BİTİŞ
###################################################################################################
//mail ayarlar güncelleme BAŞLANGIÇ
if (isset($_POST['mailayarkaydet'])) {
	$ayarkaydet=$db->prepare("UPDATE ayar SET 
		ayar_smtphost=:ayar_smtphost,
		ayar_smtpuser=:ayar_smtpuser,
		ayar_smtppassword=:ayar_smtppassword,	
		ayar_smtpport=:ayar_smtpport	
		where ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'ayar_smtphost'=>htmlspecialchars($_POST['ayar_smtphost']),
		'ayar_smtpuser'=>htmlspecialchars($_POST['ayar_smtpuser']),
		'ayar_smtppassword'=>htmlspecialchars($_POST['ayar_smtppassword']),
		'ayar_smtpport'=>htmlspecialchars($_POST['ayar_smtpport'])
		
	));
	if ($update) {
		header("Location:../production/mail-ayarlar.php?durum=ok");
		exit;
	}else{
		header("Location:../production/mail-ayarlar.php?durum=no");
		exit;
	}
}
//mail ayarlar güncelleme BİTİŞ
###################################################################################################
//hakkimizda güncelleme BAŞLANGIÇ
if (isset($_POST['hakkimizdakaydet'])) {
	$ayarkaydet=$db->prepare("UPDATE hakkimizda SET 
		hakkimizda_baslik=:hakkimizda_baslik,
		hakkimizda_icerik=:hakkimizda_icerik,
		hakkimizda_video=:hakkimizda_video,	
		hakkimizda_vizyon=:hakkimizda_vizyon,
		hakkimizda_misyon=:hakkimizda_misyon	
		where hakkimizda_id=0");
	$update=$ayarkaydet->execute(array(
		'hakkimizda_baslik'=>htmlspecialchars($_POST['hakkimizda_baslik']),
		'hakkimizda_icerik'=>$_POST['hakkimizda_icerik'],
		'hakkimizda_video'=>htmlspecialchars($_POST['hakkimizda_video']),
		'hakkimizda_vizyon'=>htmlspecialchars($_POST['hakkimizda_vizyon']),
		'hakkimizda_misyon'=>htmlspecialchars($_POST['hakkimizda_misyon'])
		
	));
	if ($update) {
		header("Location:../production/hakkimizda.php?durum=ok");
		exit;
	}else{
		header("Location:../production/hakkimizda.php?durum=no");
		exit;
	}
}
//hakkimizda ayarlar güncelleme BİTİŞ
###################################################################################################
//kullanici düzenleme - güncelle BAŞLANGIÇ
if (isset($_POST['kullaniciduzenle'])) {
	$kullanici_id=htmlspecialchars($_POST['kullanici_id']);
	$ayarkaydet=$db->prepare("UPDATE kullanici SET 
		kullanici_tc=:kullanici_tc,
		kullanici_adsoyad=:kullanici_adsoyad,
		kullanici_gsm=:kullanici_gsm,
		kullanici_durum=:kullanici_durum	
		where kullanici_id={$_POST['kullanici_id']}");
	$update=$ayarkaydet->execute(array(
		'kullanici_tc'=>htmlspecialchars($_POST['kullanici_tc']),
		'kullanici_adsoyad'=>htmlspecialchars($_POST['kullanici_adsoyad']),
		'kullanici_gsm'=>htmlspecialchars($_POST['kullanici_gsm']),
		'kullanici_durum'=>htmlspecialchars($_POST['kullanici_durum'])
		
	));
	if ($update) {
		header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=ok");
		exit;
	}else{
		header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=no");
		exit;
	}
}
//kullanici düzenleme - güncelle BİTİŞ
###################################################################################################
//kullanici düzenleme - silme BAŞLANGIÇ
if (isset($_GET['kullanicisil'])) {
	if ($_GET['kullanicisil']=="ok") {
		$sil=$db->prepare("DELETE from kullanici where kullanici_id=:id");
		$kontrol=$sil->execute(array('id'=>htmlspecialchars($_GET['kullanici_id'])));
		if ($kontrol) {
			header("location:../production/kullanici.php?durum=ok");
			exit;
		}else{
			header("location:../production/kullanici.php?durum=no");
			exit;
		}
	}
}
//kullanici düzenleme - silme BİTİŞ
###################################################################################################
//menü düzenleme - güncelle BAŞLANGIÇ
if (isset($_POST['menuduzenle'])) {

	$menu_seourl=seo(htmlspecialchars($_POST['menu_ad']));
	$menu_id=$_POST['menu_id'];
	$ayarkaydet=$db->prepare("UPDATE menu SET 
		menu_ad=:menu_ad,
		menu_detay=:menu_detay,
		menu_url=:menu_url,
		menu_sira=:menu_sira,
		menu_seourl=:menu_seourl,
		menu_durum=:menu_durum
		where menu_id=$menu_id");
	$update=$ayarkaydet->execute(array(
		'menu_ad'=>htmlspecialchars($_POST['menu_ad']),
		'menu_detay'=>$_POST['menu_detay'],
		'menu_url'=>htmlspecialchars($_POST['menu_url']),
		'menu_sira'=>htmlspecialchars($_POST['menu_sira']),
		'menu_seourl'=>htmlspecialchars($menu_seourl),
		'menu_durum'=>htmlspecialchars($_POST['menu_durum'])
	));
	if ($update) {
		header("Location:../production/menu-duzenle.php?menu_id=$menu_id&durum=ok");
		exit;
	}else{
		header("Location:../production/menu-duzenle.php?menu_id=menu_id&durum=no");
		exit;
	}
}
//menü düzenleme - güncelle BİTİŞ
###################################################################################################
//menu düzenleme - silme BAŞLANGIÇ
if (isset($_GET['menusil'])) {
	if ($_GET['menusil']=="ok") {
		$sil=$db->prepare("DELETE from menu where menu_id=:id");
		$kontrol=$sil->execute(array('id'=>htmlspecialchars($_GET['menu_id'])));
		if ($kontrol) {
			header("location:../production/menu.php?durum=ok");
			exit;
		}else{
			header("location:../production/menu.php?durum=no");
			exit;
		}
	}
}
//menü düzenleme - silme BİTİŞ
###################################################################################################
//menü ekleme BAŞLANGIÇ
if (isset($_POST['menukaydet'])) {
	$menu_seourl=seo(htmlspecialchars($_POST['menu_ad']));
	$ayarkaydet=$db->prepare("INSERT INTO menu SET 
		menu_ad=:menu_ad,
		menu_detay=:menu_detay,
		menu_url=:menu_url,	
		menu_sira=:menu_sira,
		menu_seourl=:menu_seourl,
		menu_durum=:menu_durum
		");
	$update=$ayarkaydet->execute(array(
		'menu_ad'=>htmlspecialchars($_POST['menu_ad']),
		'menu_detay'=>$_POST['menu_detay'],		
		'menu_url'=>htmlspecialchars($_POST['menu_url']),
		'menu_sira'=>htmlspecialchars($_POST['menu_sira']),
		'menu_seourl'=>$menu_seourl,
		'menu_durum'=>htmlspecialchars($_POST['menu_durum'])

	));
	if ($update) {
		header("Location:../production/menu.php?durum=ok");
		exit;
	}else{
		header("Location:../production/menu.php?durum=no");
		exit;
	}
}
//menü ekleme BİTİŞ
###################################################################################################
//genel ayarlar logo düzenle BAŞLANGIÇ
if (isset($_POST['logoduzenle'])) {
	if ($_FILES['ayar_logo']['size']>1048576) {
		header("Location:../production/genel-ayar.php?durum=dosyabuyuk");
		exit;
	}
	$izinli_uzantilar=array('jpg','png','gif');
	$ext=strtolower(substr($_FILES['ayar_logo']["name"],strpos($_FILES['ayar_logo']["name"],'.')+1));	
	if(in_array($ext,$izinli_uzantilar)===false) {		
		header("Location:../production/genel-ayar.php?durum=izinsizuzanti");
		exit;
	}


	$uploads_dir="../../dimg";//kökten resim dosyasına geçiş
	@$tmp_name=$_FILES['ayar_logo']["tmp_name"];//önbellek ismi 
	@$name=$_FILES['ayar_logo']["name"];
	$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir,6)."/".$benzersizsayi4.$name;
	@move_uploaded_file($tmp_name,"$uploads_dir/$benzersizsayi4$name");
	$duzenle=$db->prepare("UPDATE ayar SET
		ayar_logo=:logo
		WHERE ayar_id=0");
	$update=$duzenle->execute(array(
		'logo'=>$refimgyol
	));
	if ($update) {
		$resimsilunlink=htmlspecialchars($_POST['eski_yol']);//eski kalan dosyanın yolunu alıyor
		unlink("../../$resimsilunlink");//dosya fazlalığı olmaması için eski dosyayı siliyor
		header("Location:../production/genel-ayar.php?durum=ok");
		exit;
	}else{
		header("Location:../production/genel-ayar.php?durum=no");
		exit;
	}
}

//genel ayarlar logo düzenle BİTİŞ
###################################################################################################
//slider ekle BAŞLANGIÇ
if (isset($_POST['sliderkaydet'])) {
	if ($_FILES['slider_resimyol']['size']>1048576) {
		header("Location:../production/slider.php?durum=dosyabuyuk");
		exit;
	}
	$izinli_uzantilar=array('jpg','png','gif');
	$ext=strtolower(substr($_FILES['slider_resimyol']["name"],strpos($_FILES['slider_resimyol']["name"],'.')+1));	
	if(in_array($ext,$izinli_uzantilar)===false) {		
		header("Location:../production/slider.php?durum=izinsizuzanti");
		exit;
	}



	$uploads_dir="../../dimg/slider";//kökten resim dosyasına geçiş
	@$tmp_name=$_FILES['slider_resimyol']["tmp_name"];//önbellek ismi 
	@$name=$_FILES['slider_resimyol']["name"];
	$benzersizsayi1=rand(20000,32000);
	$benzersizsayi2=rand(20000,32000);
	$benzersizsayi3=rand(20000,32000);
	$benzersizsayi4=rand(20000,32000);
	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;

	$refimgyol=substr($uploads_dir,6)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name,"$uploads_dir/$benzersizad$name");
	$kaydet=$db->prepare("INSERT INTO slider SET
		slider_ad=:slider_ad,
		slider_sira=:slider_sira,
		slider_link=:slider_link,
		slider_detay=:slider_detay,
		slider_resimyol=:slider_resimyol
		");
	$insert=$kaydet->execute(array(
		'slider_ad'=>htmlspecialchars($_POST['slider_ad']),
		'slider_sira'=>htmlspecialchars($_POST['slider_sira']),
		'slider_link'=>htmlspecialchars($_POST['slider_link']),
		'slider_detay'=>htmlspecialchars($_POST['slider_detay']),
		'slider_resimyol'=>$refimgyol
	));
	if ($insert) {		
		header("Location:../production/slider.php?durum=ok");
		exit;
	}else{
		header("Location:../production/slider.php?durum=no");
		exit;
	}
}
//slider ekle BİTİŞ
###################################################################################################
//slider düzenleme - silme BAŞLANGIÇ
if (isset($_GET['slidersil'])) {

	if ($_GET['slidersil']=="ok") {
		$resimsilunlink=htmlspecialchars($_GET['eski_yol']);
	//eski kalan dosyanın yolunu alıyor
		unlink("../../$resimsilunlink");
	//dosya fazlalığı olmaması için eski dosyayı siliyor
		$sil=$db->prepare("DELETE from slider where slider_id=:id");
		$kontrol=$sil->execute(array('id'=>htmlspecialchars($_GET['slider_id'])));
		if ($kontrol) {
			header("location:../production/slider.php?durum=ok");
			exit;
		}else{
			header("location:../production/slider.php?durum=no");
			exit;
		}
	}
}
//slider düzenleme - silme BİTİŞ
###################################################################################################
//slider düzenle BAŞLANGIÇ
if (isset($_POST['sliderduzenle'])) {
	$slider_id=htmlspecialchars($_POST['slider_id']);
	$duzenle=$db->prepare("UPDATE slider SET
		slider_ad=:slider_ad,
		slider_link=:slider_link,		
		slider_sira=:slider_sira,
		slider_detay=:slider_detay,
		slider_durum=:slider_durum
		WHERE slider_id=$slider_id");
	$update=$duzenle->execute(array(
		'slider_ad'=>htmlspecialchars($_POST['slider_ad']),
		'slider_link'=>htmlspecialchars($_POST['slider_link']),
		'slider_sira'=>htmlspecialchars($_POST['slider_sira']),
		'slider_detay'=>htmlspecialchars($_POST['slider_detay']),
		'slider_durum'=>htmlspecialchars($_POST['slider_durum'])
	));
	if ($update) {
		
		header("Location:../production/slider.php?durum=ok");
		exit;
	}else{
		header("Location:../production/slider.php?durum=no");
		exit;
	}
}
//logo düzenle BİTİŞ
###################################################################################################
//slider resim düzenle BAŞLANGIÇ
if (isset($_POST['sliderresimduzenle'])) {	
	if ($_FILES['slider_resimyol']['size']>1048576) {
		header("Location:../production/slider.php?durum=dosyabuyuk");
		exit;
	}
	$izinli_uzantilar=array('jpg','png','gif');
	$ext=strtolower(substr($_FILES['slider_resimyol']["name"],strpos($_FILES['slider_resimyol']["name"],'.')+1));	
	if(in_array($ext,$izinli_uzantilar)===false) {		
		header("Location:../production/slider.php?durum=izinsizuzanti");
		exit;
	}


	$uploads_dir="../../dimg/slider";//kökten resim dosyasına geçiş
	@$tmp_name=$_FILES['slider_resimyol']["tmp_name"];//önbellek ismi 
	@$name=$_FILES['slider_resimyol']["name"];
	$benzersizsayi1=rand(20000,32000);
	$benzersizsayi2=rand(20000,32000);
	$benzersizsayi3=rand(20000,32000);
	$benzersizsayi4=rand(20000,32000);
	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;

	$refimgyol=substr($uploads_dir,6)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name,"$uploads_dir/$benzersizad$name");

	$slider_id=htmlspecialchars($_POST['slider_id']);
	$duzenle=$db->prepare("UPDATE slider SET
		slider_resimyol=:resimyol
		WHERE slider_id=$slider_id");
	$update=$duzenle->execute(array(
		'resimyol'=>$refimgyol
	));
	if ($update) {
		$resimsilunlink=htmlspecialchars($_POST['eski_yol']);//eski kalan dosyanın yolunu alıyor
		unlink("../../$resimsilunlink");//dosya fazlalığı olmaması için eski dosyayı siliyor
		header("Location:../production/slider.php?durum=ok");
		exit;
	}else{
		header("Location:../production/slider.php?durum=no");
		exit;
	}
}
//logo resim düzenle BİTİŞ
###################################################################################################
//kategori düzenleme - güncelle BAŞLANGIÇ
if (isset($_POST['kategoriduzenle'])) {
	$kategori_id=htmlspecialchars($_POST['kategori_id']);
	$kategori_seourl=seo(htmlspecialchars($_POST['kategori_ad']));


	$menu_id=htmlspecialchars($_POST['kategori_id']);
	$ayarkaydet=$db->prepare("UPDATE kategori SET 

		kategori_ad=:kategori_ad,		
		kategori_durum=:kategori_durum,
		kategori_sira=:kategori_sira,
		kategori_seourl=:kategori_seourl
		where kategori_id=$kategori_id");
	$update=$ayarkaydet->execute(array(
		'kategori_ad'=>htmlspecialchars($_POST['kategori_ad']),
		'kategori_durum'=>htmlspecialchars($_POST['kategori_durum']),
		'kategori_sira'=>htmlspecialchars($_POST['kategori_sira']),
		'kategori_seourl'=>$kategori_seourl	
	));
	if ($update) {
		header("Location:../production/kategori-duzenle.php?kategori_id=$kategori_id&durum=ok");
		exit;
	}else{
		header("Location:../production/kategori-duzenle.php?kategori_id=kategori_id&durum=no");
		exit;
	}
}
//kategori düzenleme - güncelle BİTİŞ
###################################################################################################
//kategori düzenleme - silme BAŞLANGIÇ
if (isset($_GET['kategorisil'])) {
	if ($_GET['kategorisil']=="ok") {
		$sil=$db->prepare("DELETE from kategori where kategori_id=:id");
		$kontrol=$sil->execute(array('id'=>htmlspecialchars($_GET['kategori_id'])));
		if ($kontrol) {
			header("location:../production/kategori.php?durum=ok");
			exit;
		}else{
			header("location:../production/kategori.php?durum=no");
			exit;
		}
	}
}
//kategori düzenleme - silme BİTİŞ
###################################################################################################
//kategori ekleme BAŞLANGIÇ
if (isset($_POST['kategorikaydet'])) {
	$kategori_seourl=seo(htmlspecialchars($_POST['kategori_ad']));
	$ayarkaydet=$db->prepare("INSERT INTO kategori SET 
		kategori_ad=:kategori_ad,
		kategori_sira=:kategori_sira,
		kategori_seourl=:kategori_seourl,
		kategori_durum=:kategori_durum
		");
	$update=$ayarkaydet->execute(array(
		'kategori_ad'=>htmlspecialchars($_POST['kategori_ad']),
		'kategori_sira'=>htmlspecialchars($_POST['kategori_sira']),		
		'kategori_seourl'=>$kategori_seourl,
		'kategori_durum'=>htmlspecialchars($_POST['kategori_durum'])
		
	));
	if ($update) {
		header("Location:../production/kategori.php?durum=ok");
		exit;
	}else{
		header("Location:../production/kategori.php?durum=no");
		exit;
	}
}
//kategori ekleme BİTİŞ
###################################################################################################
//ürün düzenleme - silme BAŞLANGIÇ
if (isset($_GET['urunsil'])) {
	if ($_GET['urunsil']=="ok") {
		$sil=$db->prepare("DELETE from urun where urun_id=:id");
		$kontrol=$sil->execute(array('id'=>htmlspecialchars($_GET['urun_id'])));
		if ($kontrol) {
			header("location:../production/urun.php?durum=ok");
			exit;
		}else{
			header("location:../production/urun.php?durum=no");
			exit;
		}
	}
}
//ürün düzenleme - silme BİTİŞ
###################################################################################################
//ürün ekleme BAŞLANGIÇ
if (isset($_POST['urunekle'])) {
	$urun_seourl=seo(htmlspecialchars($_POST['urun_ad']));

	$ayarkaydet=$db->prepare("INSERT INTO urun SET 
		kategori_id=:kategori_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_fiyat=:urun_fiyat,
		urun_video=:urun_video,
		urun_keyword=:urun_keyword,
		urun_durum=:urun_durum,
		urun_stok=:urun_stok,
		urun_onecikar=:urun_onecikar,
		urun_seourl=:urun_seourl		
		");
	$update=$ayarkaydet->execute(array(
		'kategori_id'=>htmlspecialchars($_POST['kategori_id']),
		'urun_ad'=>htmlspecialchars($_POST['urun_ad']),
		'urun_detay'=>$_POST['urun_detay'],	
		'urun_fiyat'=>htmlspecialchars($_POST['urun_fiyat']),	
		'urun_video'=>htmlspecialchars($_POST['urun_video']),	
		'urun_keyword'=>htmlspecialchars($_POST['urun_keyword']),
		'urun_durum'=>htmlspecialchars($_POST['urun_durum']),	
		'urun_stok'=>htmlspecialchars($_POST['urun_stok']),
		'urun_onecikar'=>htmlspecialchars($_POST['urun_onecikar']),
		'urun_seourl'=>$urun_seourl		
	));
	if ($update) {
		header("Location:../production/urun.php?durum=ok");
		exit;
	}else{
		header("Location:../production/urun.php?durum=no");
		exit;
	}
}
//ürün ekleme BİTİŞ
###################################################################################################
//ürün düzenle BAŞLANGIÇ
if (isset($_POST['urunduzenle'])) {
	$urun_seourl=seo(htmlspecialchars($_POST['urun_ad']));
	$urun_id=htmlspecialchars($_POST['urun_id']);
	$ayarkaydet=$db->prepare("UPDATE urun SET 
		kategori_id=:kategori_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_fiyat=:urun_fiyat,
		urun_video=:urun_video,
		urun_keyword=:urun_keyword,
		urun_durum=:urun_durum,
		urun_stok=:urun_stok,
		urun_seourl=:urun_seourl,
		urun_onecikar=:urun_onecikar
		
		where urun_id=$urun_id
		");
	$update=$ayarkaydet->execute(array(
		'kategori_id'=>htmlspecialchars($_POST['kategori_id']),
		'urun_ad'=>htmlspecialchars($_POST['urun_ad']),
		'urun_detay'=>$_POST['urun_detay'],	
		'urun_fiyat'=>htmlspecialchars($_POST['urun_fiyat']),	
		'urun_video'=>htmlspecialchars($_POST['urun_video']),	
		'urun_keyword'=>htmlspecialchars($_POST['urun_keyword']),
		'urun_durum'=>htmlspecialchars($_POST['urun_durum']),	
		'urun_stok'=>htmlspecialchars($_POST['urun_stok']),
		'urun_onecikar'=>htmlspecialchars($_POST['urun_onecikar']),	
		'urun_seourl'=>$urun_seourl
		

		
	));
	if ($update) {
		header("Location:../production/urun-duzenle.php?urun_id=$urun_id&durum=ok");
		exit;
	}else{
		header("Location:../production/urun-duzenle.php?urun_id=$urun_id&durum=no");
		exit;
	}
}
//ürün düzenle BİTİŞ
###################################################################################################
//öne çıkar kaldır BAŞLANGIÇ
if (isset($_GET['urunonecikar'])) {	
	if ($_GET['urunonecikar']=="cikarma") {
		$urun_id=htmlspecialchars($_GET['urun_id']);
		$guncelle=$db->prepare("UPDATE urun SET
			urun_onecikar=:urun_onecikar
			where urun_id=$urun_id");
		$guncellekaydet=$guncelle->execute(array(
			'urun_onecikar'=>0));
		if ($guncellekaydet) {
			header("location:../production/urun.php?durum=ok");
			exit;
		}else{
			header("location:../production/urun.php?durum=no");
			exit;
		}
	}
}
//öne çıkarma kaldır BİTİŞ
###################################################################################################
//öne çıkar  BAŞLANGIÇ
if (isset($_GET['urunonecikar'])) {	
	if ($_GET['urunonecikar']=="cikar") {
		$urun_id=htmlspecialchars($_GET['urun_id']);
		$guncelle=$db->prepare("UPDATE urun SET urun_onecikar=:urun_onecikar where urun_id=$urun_id");
		$guncellekaydet=$guncelle->execute(array(
			'urun_onecikar'=>1));

		if ($guncellekaydet) {
			header("location:../production/urun.php?durum=ok");
			exit;
		}else{
			header("location:../production/urun.php?durum=no");
			exit;
		}
	}
}
//öne çıkar BİTİŞ
###################################################################################################
//yorum gönderme BAŞLANGIÇ
if (isset($_POST['yorumgonder'])) {
	$url=htmlspecialchars($_POST['url']);

	$ayarkaydet=$db->prepare("INSERT INTO yorumlar SET 
		kullanici_id=:kullanici_id,
		urun_id=:urun_id,
		yorum_detay=:yorum_detay		
		");
	$update=$ayarkaydet->execute(array(
		'kullanici_id'=>htmlspecialchars($_POST['kullanici_id']),
		'urun_id'=>htmlspecialchars($_POST['urun_id']),
		'yorum_detay'=>htmlspecialchars($_POST['yorum_detay'])		
	));
	if ($update) {
		header("Location:$url?durum=ygok");//yg yorum gönder
		exit;
	}else{
		header("Location:$url&durum=ygno");
		exit;
	}
}
//yorum gönderme BİTİŞ
###################################################################################################
//yorum onaylama BAŞLANGIÇ
if (isset($_POST['yorumonayla'])) {	
	$yorum_id=htmlspecialchars($_POST['yorum_id']);
	$yorumkaydet=$db->prepare("UPDATE yorumlar SET yorum_onay=:yorum_onay where yorum_id=$yorum_id");
	$kaydet=$yorumkaydet->execute(array('yorum_onay'=>htmlspecialchars($_POST['yorum_onay'])));
	if ($kaydet) {
		header("Location:../production/yorum-duzenle.php?yorum_id=$yorum_id&durum=ok");
		exit;
	}else{
		header("Location:../production/yorum-duzenle.php?yorum_id=$yorum_id&durum=no");
		exit;
	}
}
//yorum onaylama BİTİŞ
###################################################################################################
//yorum silme BAŞLANGIÇ
if (isset($_GET['yorumsil'])) {	
	if ($_GET['yorumsil']=="ok") {
		$sil=$db->prepare("DELETE from yorumlar where yorum_id=:yorum_id");
		$kontrol=$sil->execute(array('yorum_id'=>htmlspecialchars($_GET['yorum_id'])));
		if ($kontrol) {
			header("location:../production/yorum.php?durum=ok");
			exit;
		}else{
			header("location:../production/yorum.php?durum=no");
			exit;
		}
	}
}
//yorum silme silme BİTİŞ
###################################################################################################
//sepete ekleme BAŞLANGIÇ
if (isset($_POST['sepetekle'])) {
	$ayarkaydet=$db->prepare("INSERT INTO sepet SET 
		kullanici_id=:kullanici_id,
		urun_id=:urun_id,
		urun_adet=:urun_adet		
		");
	$update=$ayarkaydet->execute(array(
		'kullanici_id'=>htmlspecialchars($_POST['kullanici_id']),
		'urun_id'=>htmlspecialchars($_POST['urun_id']),
		'urun_adet'=>htmlspecialchars($_POST['urun_adet'])		
	));
	if ($update) {
		header("Location:../../sepet?durum=seok");//se sepet ekle
		exit;
	}else{
		header("Location:../../sepet?durum=seno");
		exit;
	}
}
//sepete ekleme BİTİŞ
###################################################################################################
//sepet Güncelleme BAŞLANGIÇ
if (isset($_POST['sepetguncelle'])) {
	$sepet_id=htmlspecialchars($_POST['sepet_id']);
	$sepetguncelle=$db->prepare("UPDATE sepet SET 
		urun_adet=:urun_adet
		where sepet_id=$sepet_id
		");
	$kaydet=$sepetguncelle->execute(array(
		'urun_adet'=>htmlspecialchars($_POST['urun_adet'])
	));
	if (isset($_POST['sepet_sil'])) {
		$sil=$db->prepare("DELETE from sepet where sepet_id=:sepet_id");
		$kontrol=$sil->execute(array('sepet_id'=>htmlspecialchars($_POST['sepet_id'])));
		if ($kontrol) {
			header("location:../../sepet?durum=siok");//si sepet sil
			exit;
		}else{
			header("location:../../sepet?durum=sino");
			exit;
		}		
	}
	if ($kaydet) {
		header("Location:../../sepet?durum=sgok");//sg sepet güncelle
		exit;
	}else{
		header("Location:../../sepet?durum=sgno");
		exit;
	}
}
//sepet Güncelleme BİTİŞ
###################################################################################################
//kategori ekleme BAŞLANGIÇ
if (isset($_POST['bankakaydet'])) {
	$ayarkaydet=$db->prepare("INSERT INTO banka SET 
		banka_ad=:banka_ad,
		banka_iban=:banka_iban,
		banka_hesapadsoyad=:banka_hesapadsoyad,
		banka_durum=:banka_durum
		");
	$update=$ayarkaydet->execute(array(
		'banka_ad'=>htmlspecialchars($_POST['banka_ad']),
		'banka_iban'=>htmlspecialchars($_POST['banka_iban']),		
		'banka_hesapadsoyad'=>htmlspecialchars($_POST['banka_hesapadsoyad']),
		'banka_durum'=>htmlspecialchars($_POST['banka_durum'])		
	));
	if ($update) {
		header("Location:../production/banka.php?durum=ok");
		exit;
	}else{
		header("Location:../production/banka.php?durum=no");
		exit;
	}
}
//kategori ekleme BİTİŞ
###################################################################################################
//sepet Güncelleme BAŞLANGIÇ
if (isset($_POST['bankaguncelle'])) {	
	$banka_id=htmlspecialchars($_POST['banka_id']);
	$bankaguncelle=$db->prepare("UPDATE banka SET 
		banka_ad=:banka_ad,
		banka_iban=:banka_iban,
		banka_hesapadsoyad=:banka_hesapadsoyad,
		banka_durum=:banka_durum
		where banka_id=$banka_id
		");
	$kaydet=$bankaguncelle->execute(array(
		'banka_ad'=>htmlspecialchars($_POST['banka_ad']),
		'banka_iban'=>htmlspecialchars($_POST['banka_iban']),
		'banka_hesapadsoyad'=>htmlspecialchars($_POST['banka_hesapadsoyad']),
		'banka_durum'=>htmlspecialchars($_POST['banka_durum'])
	));
	if ($kaydet) {
		header("Location:../production/banka.php?durum=ok");
		exit;
	}else{
		header("Location:../production/banka.php?durum=no");
		exit;
	}	
}
//sepet Güncelleme BİTİŞ
###################################################################################################
//yorum silme BAŞLANGIÇ
if (isset($_GET['bankasil'])) {
	if ($_GET['bankasil']=="ok") {
		$sil=$db->prepare("DELETE from banka where banka_id=:banka_id");
		$kontrol=$sil->execute(array('banka_id'=>htmlspecialchars($_GET['banka_id'])));
		if ($kontrol) {
			header("location:../production/banka.php?durum=ok");
			exit;
		}else{
			header("location:../production/banka.php?durum=no");
			exit;
		}
	}
}
//yorum silme silme BİTİŞ
###################################################################################################
//siparis ekleme BAŞLANGIÇ
if (isset($_POST['bankasiparisekle'])) {	
	$ekle=$db->prepare("INSERT INTO siparis SET 
		kullanici_id=:kullanici_id,
		siparis_tip=:siparis_tip,
		banka_id=:banka_id,
		siparis_toplam=:siparis_toplam
		");
	$kontrol=$ekle->execute(array(
		'kullanici_id'=>htmlspecialchars($_POST['kullanici_id']),
		'siparis_tip'=>'Banka Havalesi',
		'banka_id'=>htmlspecialchars($_POST['banka_id']),
		'siparis_toplam'=>htmlspecialchars($_POST['siparis_toplam'])
	));
	if ($kontrol) {
		$son_id=$db->lastInsertId();
		$kullanici_id=htmlspecialchars($_POST['kullanici_id']);
		$sepetsor=$db->prepare("SELECT * FROM sepet where kullanici_id=:kullanici_id");
		$sepetsor->execute(array(
			'kullanici_id'=>$kullanici_id
		));
		while ($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC)) {
			$urun_id=$sepetcek['urun_id'];
			$urun_adet=$sepetcek['urun_adet'];
			$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:id");
			$urunsor->execute(array(
				'id'=>$urun_id));
			$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
			$urun_fiyat=$uruncek['urun_fiyat'];

			$ekle=$db->prepare("INSERT INTO siparisdetay SET 
				siparis_id=:siparis_id,
				urun_id=:urun_id,
				urun_fiyat=:urun_fiyat,
				urun_adet=:urun_adet				
				");
			$kontrol2=$ekle->execute(array(
				'siparis_id'=>$son_id,
				'urun_id'=>$urun_id,
				'urun_fiyat'=>$urun_fiyat,
				'urun_adet'=>$urun_adet				
			));
		}
		if ($kontrol2) {
			# sipriş kayıt başarılı ise sepet silinecek
			$sil=$db->prepare("DELETE from sepet where kullanici_id=:kullanici_id");
			$kontrol=$sil->execute(array('kullanici_id'=>$kullanici_id));
			if ($kontrol) {
				header("location:../../siparislerim?durum=bseok");
				exit;
			}else{
				header("location:../../siparislerim?durum=bseno");
				exit;
			}			
		}		
	}else{
		header("location:../../siparislerim?durum=bseno");
		exit;
	}
}
//siparis ekleme BİTİŞ
###################################################################################################
//ürün foto sil BAŞLANGIÇ
if (isset($_POST['urunfotosil'])) {
	$urun_id=htmlspecialchars($_POST['urun_id']);
	$checklist=htmlspecialchars($_POST['urunfotosec']);
	foreach ($checklist as $list) {
		$sil=$db->prepare("DELETE from urunfoto where urunfoto_id=:urunfoto_id");
		$kontrol=$sil->execute(array(
			'urunfoto_id'=>$list
		));
	}
	if ($kontrol) {
		Header("Location:../production/urun-galeri.php?urun_id=$urun_id&durum=ok");
		exit;
	}else{
		Header("Location:../production/urun-galeri.php?urun_id=$urun_id&durum=no");
		exit;
	}	
}
//ürün foto sil BAŞLANGIÇ
###################################################################################################
//sipariş düzenleme BAŞLANGIÇ
if (isset($_POST['siparisduzenle'])) {	
	$siparis_id=htmlspecialchars($_POST['siparis_id']);
	$bankaguncelle=$db->prepare("UPDATE siparis SET		
		siparis_odeme=:siparis_odeme
		where siparis_id=$siparis_id
		");
	$kaydet=$bankaguncelle->execute(array(
		'siparis_odeme'=>htmlspecialchars($_POST['siparis_odeme'])
	));
	if ($kaydet) {
		header("Location:../production/siparisler-duzenle.php?siparis_id=$siparis_id&durum=ok");
		exit;
	}else{
		header("Location:../production/siparisler-duzenle.php?siparis_id=$siparis_id&durum=no");
		exit;
	}	
}
//sipariş düzenleme BİTİŞ
###################################################################################################

?>