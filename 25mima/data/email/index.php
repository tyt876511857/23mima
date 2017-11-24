<?php
header("Content-type: text/html; charset=utf-8");
require("class.phpmailer.php"); //下载的文件必须放在该文件所在目录
$mail = new phpmailer(); //建立邮件发送类
$_POST['address'] = empty($_POST['address'])?'734303275@qq.com':$_POST['address'];
$_POST['title'] = empty($_POST['title'])?'这是标题':$_POST['title'];
$_POST['body'] = empty($_POST['body'])?'这是内容':$_POST['body'];
$_POST['FromName'] = empty($_POST['FromName'])?'这是发件人':$_POST['FromName'];
$address =$_POST['address'];//收件人
$mail->IsSMTP(); // 使用SMTP方式发送
$mail->Host = "smtp.aliyun.com"; // 您的企业邮局域名
$mail->SMTPAuth = true;
$mail->Username = "alumduan@aliyun.com";
$mail->Password = "ald88730000"; // 邮局密码
$mail->From = "alumduan@aliyun.com"; //邮件发送者email地址
$mail->Port=25;
$mail->FromName = $_POST['FromName'];
$mail->AddAddress("$address", "$address");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
//$mail->AddReplyTo("", "");
//$mail->AddAttachment("baidu.html"); // 添加附件
$mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
$mail->Subject = $_POST['title']; //邮件标题
$mail->Body = $_POST['body']; //邮件内容
//$mail->AltBody = "This is the body in plain text for non-HTML mail clients"; //附加信息，可以省略
if(!$mail->Send()){
echo "邮件发送失败. <p>";
echo "错误原因: ".$mail->ErrorInfo;
}else{
echo "邮件发送成功";
}
?>
