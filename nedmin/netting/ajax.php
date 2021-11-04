<?php 
include 'baglan.php';
$value=$_POST["value"];
if (isset($_POST['value'])) {
	if (!$value) {
		echo "Arama yapınız!";
	}else{

		$ara=$db->prepare("SELECT * FROM urun where urun_ad LIKE '%$value%' limit 20");
		$ara->execute();
		if ($ara->rowCount()) {
			while ($uruncek=$ara->fetch(PDO::FETCH_ASSOC)) {
				echo "<a class='textrengi' href=";
				echo "urun-";
				echo $uruncek['urun_seourl'].'-'.$uruncek['urun_id'];
				echo ">";
				echo $uruncek['urun_ad'];
				echo "</a>";
				echo "<br>";
			}
		}
	}
}
?>