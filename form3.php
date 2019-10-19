<?php
session_start();

if (isset($_POST['token'], $_SESSION['token']) && ($_POST['token'] === $_SESSION['token'])) {

	unset($_SESSION['token']);

	$name = $_SESSION['name'];
	$email = $_SESSION['email'];
	$subject = $_SESSION['subject'];
	$body = $_SESSION['body'];

	$dsn = 'mysql:dbname=contact_form;host=localhost;charset=utf8';
	$user = 'root';
	$password = '';

	$dbh = new PDO($dsn, $user, $password);
	$dbh->query('SET NAMES utf8');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$sql = 'INSERT INTO inquiries (name, email, subject, body) VALUES (?, ?, ?, ?)';
	$stmt = $dbh->prepare($sql);

	$stmt->bindValue(1, $name, PDO::PARAM_STR);
	$stmt->bindValue(2, $email, PDO::PARAM_STR);
	$stmt->bindValue(3, $subject, PDO::PARAM_STR);
	$stmt->bindValue(4, $body, PDO::PARAM_STR);
	$stmt->execute();

	$dbh = null;
	
	echo "きちんとしたアクセスです";
} else {
	header('Location: http://localhost/php_form/form1.php');
	exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>完了画面 - お問い合わせ</title>
</head>
<body>
<p>お問い合わせありがとうございます。</p>
</body>
</html>
