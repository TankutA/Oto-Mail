<?php
error_reporting(0); //Hataları Gizle
//Form'dan Bütün Değerler Post Methodu ile Çekiliyor
$gonderenismi = trim(strip_tags($_POST['gonderenismi']));
$gonderenemail = trim(strip_tags($_POST['gonderenemail']));
$gonderensifre = trim(strip_tags($_POST['gonderensifre']));
$aliciemail = trim(strip_tags($_POST['aliciemail']));
$aliciismi = trim(strip_tags($_POST['aliciismi']));
$konu = trim(strip_tags($_POST['konu']));
$mesaj = trim(strip_tags($_POST['mesaj']));
//Form'dan Bütün Değerler Post Methodu ile Çekiliyor Tamamlandı


if($gonderenismi and $gonderenemail and $gonderensifre and $aliciismi and $aliciemail and $konu and $mesaj){ //Form'dan bütün değerler geliyorsa mail gönderme işlemini başlatıyoruz.

    $Mesaj = "$mesaj";

    //Php Smtp Mailler Sınıfını Sayfaya Dahil Ediyoruz
    include ('phpmail/class.phpmailer.php');
    include ('phpmail/class.smtp.php');
    //Php Smtp Mailler Sınıfını Sayfaya Dahil Ediyoruz Tamamlandı

    //Mail Bağlantı Ayarları 
    //Mail Hangi Hesaptan Gönderilecek ise onun bilgilerini yazın.
    $MailSmtpHost = "smtp.yandex.com.tr";
    $MailUserName = $gonderenemail; //Yandex Mail Adresinizi Yazın. "x@x.com"
    $MailPassword = $gonderensifre; //Yandex Mail Şifrenizi Yazın. "sifre"
    //Mail Bağlantı Ayarları Tamamlandı

    //Doldurulan Form Mail Olarak Kime Gidecek?
    $MailKimeGidecek = $_POST['aliciemail'];
    //Doldurulan Form Mail Olarak Kime Gidecek Tamamlandı
    
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = $MailSmtpHost; //Smtp Host
    $mail->SMTPSecure = 'ssl';  //yada tls
    $mail->Port = 465;  //SSL kullanacaksanız portu 465 olarak değiştiriniz - TLS Portu 587
    $mail->Username = $MailUserName; //Smtp Kullanıcı Adı
    $mail->Password = $MailPassword; //Smtp Parola
    $mail->SetFrom($mail->Username, $gonderenismi);
    $mail->AddAddress("$MailKimeGidecek", $aliciismi); //Mailin Gideceği Adres ve Alıcı Adı
    $mail->CharSet = 'UTF-8'; //Mail Karakter Seti
    $mail->Subject = $konu; //Mail Konu Başlığı
    $mail->MsgHTML("$mesaj"); //Mail Mesaj İçeriği
    if($mail->Send()) {
        echo '<script>alert("Mail gönderildi!");</script>';
        echo '<script>document.location="index.php"</script>';
    } else {
        echo 'Mail gönderilirken bir hata oluştu: ' . $mail->ErrorInfo;
    }


} //Mail gönderme işlemi tamamlandı end.if

?>

<!DOCTYPE html>
<html>
<head>
	<title>Email | Oto Mail</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width,inital-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
    .tnkt{
    background:#0095f6;
	outline:none;
	border:none;
	width:250px;
	max-width:86%;
	color:white;
	text-align:center;
	height:29px;
	border-radius:4px;
	font-weight:600;
        }

    h1{
    text-align: center;
    color: #666;
    }
        </style>
</head>

<body style="background:#fafafa;">
	

	<center><br><br><br><br>

		<div style="width:300px;max-width:95%;background:white;border:1px solid #cecece;padding:10px;box-sizing:border-box;"><br>
			<form action="index.php" method="Post" >
                <h1>Oto Mail</h1>
            <input type="text" name="gonderenismi" placeholder="Gönderen İsmi" style="width:200px;height:23px;padding-left:6px;padding-top:2px;padding-bottom:2px;outline:none;background:#fafafa;border:none;border:1px solid #dedede;border-radius:21px"><br><br>
            <input type="text" name="gonderenemail" placeholder="Gönderen Email" style="width:200px;height:23px;padding-left:6px;padding-top:2px;padding-bottom:2px;outline:none;background:#fafafa;border:none;border:1px solid #dedede;border-radius:21px"><br><br>
            <input type="text" name="gonderensifre" placeholder="Gönderen Email Şifresi" style="width:200px;height:23px;padding-left:6px;padding-top:2px;padding-bottom:2px;outline:none;background:#fafafa;border:none;border:1px solid #dedede;border-radius:21px"><br><br>
            <input type="text" name="aliciismi" placeholder="Alıcı İsmi" style="width:200px;height:23px;padding-left:6px;padding-top:2px;padding-bottom:2px;outline:none;background:#fafafa;border:none;border:1px solid #dedede;border-radius:21px"><br><br>
            <input type="text" name="aliciemail" placeholder="Alıcı Email" style="width:200px;height:23px;padding-left:6px;padding-top:2px;padding-bottom:2px;outline:none;background:#fafafa;border:none;border:1px solid #dedede;border-radius:21px"><br><br>
            <input type="text" name="konu" placeholder="Mailin Konusu" style="width:200px;height:23px;padding-left:6px;padding-top:2px;padding-bottom:2px;outline:none;background:#fafafa;border:none;border:1px solid #dedede;border-radius:21px"><br><br>
            <input type="text" name="mesaj" placeholder="Mesaj" style="width:200px;height:23px;padding-left:6px;padding-top:2px;padding-bottom:2px;outline:none;background:#fafafa;border:none;border:1px solid #dedede;border-radius:21px"><br><br><br>
				<button type="submit" class="tnkt" style="width:240px;height:25px">Maili Gönder</button>
		</form>
			</div>
			
	</center>
</body>
</html>
