<?php

// Class
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// Validate
if ( isset( $_POST[ 'email' ] ) || array_key_exists( 'email', $_POST ) ) :

	// Setting Email Penerima
	$settings = array(
		"name"          => "Admin Sapa Creative",
		"email"         => "apasajasayang18@gmail.com",
	);

	// Setting Pesan
	$message = array(
		'name'			=> $_POST[ 'name' ],
		'email'			=> $_POST[ 'email' ],
		'subject'		=> $_POST[ 'subject' ],
		'message'		=> $_POST[ 'message' ],
		'body'			=> '',
		"alerts"		=> array(
			"error"			=> 'Message could not be sent.',
			"success"		=> 'Thank you. Your message has been sent.',
		),
	);
	
	$message[ 'body' ] .= '<b>Name:</b> ' . $message[ 'name' ];
	$message[ 'body' ] .= '<br><b>Email:</b> ' . $message[ 'email' ];
	$message[ 'body' ] .= '<br><br><b>Message:</b><br>' . $message[ 'message' ];

	//Include
	require 'phpmailer/Exception.php';
	require 'phpmailer/PHPMailer.php';
	require 'phpmailer/SMTP.php';

		// Email Client
		$email = $_POST['email'];

		$mail = new PHPMailer(true);
		
		// Setting Server
		$mail->Host = 'smtp.gmail.com';
		$mail->Username = 'yaudahiya010@gmail.com';
		$mail->Password = 'uyxrjfhbrcytwvyk';
		$mail->Port = 587;
		$mail->SMTPAuth = true;
		// $mail->SMTPDebug = 2;
		$mail->SMTPSecure = 'tls';
		$mail-> isSMTP();

	try {
		// Recipients
		$mail->AddReplyTo( $message[ 'email' ], $message[ 'name' ] ); //CLIENTS
		$mail->setFrom( $message['email'], $message[ 'name' ] );  //CLIENTS
		$mail->addAddress( $settings[ 'email' ], $settings[ 'name' ] );  //PENERIMA
		
		// Content
		$mail->isHTML( true );
		$mail->Subject = $message[ 'subject' ];
		$mail->Body    = $message[ 'body' ];

		// Send
		$mail->send();

		echo '["success", "'. $message[ 'alerts' ][ 'success' ] .'"]';
	} catch ( Exception $e ) {
		// Error
		echo '["error", "'. $message[ 'alerts' ][ 'error' ] .'"]';
	}
		
	endif;
	
?>
