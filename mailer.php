<?php
add_action('wp_ajax_send_cv', 'send_cv');
add_action('wp_ajax_nopriv_send_cv', 'send_cv');
function send_cv()
{
	require_once get_template_directory() . '/phpmailer/Exception.php';
	require_once get_template_directory() . '/phpmailer/PHPMailer.php';
	require_once get_template_directory() . '/phpmailer/SMTP.php';

	$mail = new PHPMailer\PHPMailer\PHPMailer();
	$mail->CharSet = 'UTF-8';
	$mail->isSMTP();
	$mail->SMTPAuth = SMTP_AUTH;
	$mail->SMTPDebug = 0;
	$mail->Host = SMTP_HOST;
	$mail->Port = SMTP_PORT;
	$mail->Username = SMTP_USER;
	$mail->Password = SMTP_PASS;

	$name = $_POST['full_name'];
	$phone = $_POST['phone'];
	$vacancy = $_POST['vacancy'];
	$file = $_FILES['file_cv'];
	if ($file) {
		$mail->addAttachment($file['tmp_name'], $file['name']);
	}

	$mail->setFrom(SMTP_USER, $name);
	$mail->addAddress(SMTP_TO, 'Rusroza.ru');
	$mail->Subject = 'Заявка на вакансию ' . $vacancy;
	$body = '<p>Имя:' . $name . '<br>Телефон: ' . $phone . '</p>';
	$mail->msgHTML($body);
	if ($mail->send()) {
		$data['status'] = 200;
	} else {
		$data['status'] = 500;
		$data['info'] = "Сообщение не было отправлено. Ошибка при отправке письма";
		$data['desc'] = "Причина ошибки: {$mail->ErrorInfo}";
	}
	echo json_encode($data);
	wp_die();
}

add_action('wp_mail_failed', 'log_mailer_errors', 10, 1);
function log_mailer_errors($wp_error)
{
	$fn = get_template_directory() . '/mail.log'; // say you've got a mail.log file in your server root
	$fp = fopen($fn, 'a');
	fputs($fp, "Mailer Error: " . $wp_error->get_error_message() . "\n");
	fclose($fp);
}