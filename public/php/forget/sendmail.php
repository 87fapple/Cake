<?php
// require ('../../../phpmailer/phpmailer/src/PHPMailer.php');
// require ('../../../phpmailer/phpmailer/src/Exception.php');
// require ('../../../phpmailer/phpmailer/src/SMTP.php');
require('../../../vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
mb_internal_encoding('UTF-8');

$usermail=strval($_REQUEST['email']);


$mail = new PHPMailer(true);
try{
    $mail->SMTPDebug  = 0;
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;     
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure=PHPMailer::ENCRYPTION_SMTPS;
$mail->Host = "smtp.gmail.com";
$mail->Port = '465';
$mail->CharSet = 'utf8';

$mail->Username = 'phpd05cake@gmail.com';
$mail->Password = 'grzezdmezkwfiyky';

// $mail->setfrom('cakeprojectphpd05@gmail.com','浣熊蛋糕DIY');
$mail->FromName = '浣熊蛋糕DIY';

$mail->AddAddress($usermail,'庫拉皮卡');

$mail->IsHTML(true);
$mail->Subject='重設密碼';
$mail->Body = '請點擊下方按鈕 <br/>
<a href="http://localhost/Cake/public/forgetPassword.html">
<input type="button" src="" value="點擊重設密碼">
</a>';

$mail->send();
    echo "
    <dialog open  style='width:300px;height:100px; border: none; box-shadow: 0 2px 6px #ccc; border-radius: 10px; margin-top:-10%'>
    <p>已寄送信件,請至信箱查看</p>
    <a href='http://localhost/Cake/public/login.html'>
    <input type='button'  value='關閉'>
    </a>
  </dialog>";
} catch (Exception $e) {
    echo "信箱錯誤: {$mail->ErrorInfo}";
}