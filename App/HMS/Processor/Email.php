<?php

namespace HMS\Processor;

/**
 * Am easy to use Html Email Class.
 *
 * @author Fehintoluwa Cyril <cyrilcril@gmail.com>
 * @copyright 2017 CodePlus
 */
Class Email
{

	public static function sendMail($to = NULL, $subject, $message, $from, $cc = NULL, $bcc = NULL)
	{
		//prepare headers
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-type: text/html; charset=iso-8859-1";
		// $headers[] = "Content-type: text/html; charset=UTF-8";
		$headers[] = "To: " . $to;
		$headers[] = "From: " . $from;
		$headers[] = "Cc: " . $cc;
		$headers[] = "Bcc: " . $bcc;
		return mail($to, $subject, $message, implode("\r\n", $headers));
	}

	public static function prepareHTMLMail(
		$emailHead,
		$emailBody,
		$emailFoot,
		$to,
		$subject,
		$from,
		$cc,
		$bcc
	)
	{
		$message = $emailHead . "\r\n" . $emailBody . "\r\n" . $emailFoot;
		return self::sendMail($to, $subject, $message, $from, $cc, $bcc);
	}

}