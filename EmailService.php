<?php
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    // SMTP configuration constants
    private const SMTP_HOST = 'sandbox.smtp.mailtrap.io';
    private const SMTP_USER = '1a6adcd5e50f93';
    private const SMTP_PASSWORD = 'c4f9efdd3a4a6c';
    private const SMTP_PORT = 2525;
    private const SMTP_SECURE = PHPMailer::ENCRYPTION_STARTTLS;

    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        $this->mail->isSMTP();
        $this->mail->Host = self::SMTP_HOST;
        $this->mail->SMTPAuth = true;
        $this->mail->Username = self::SMTP_USER;
        $this->mail->Password = self::SMTP_PASSWORD;
        $this->mail->SMTPSecure = self::SMTP_SECURE;
        $this->mail->Port = self::SMTP_PORT;
    }

    /**
     * Sends an email to a specified recipient.
     *
     * This function uses PHPMailer to send an email. It sets up the recipients, configures the email content,
     * and attempts to send the email. If the email sending fails, it catches the exception and returns an error message.
     *
     * @param string $to Email address of the recipient.
     * @param string $toName Name of the recipient.
     * @param string $subject Subject of the email.
     * @param string $body HTML body content of the email.
     * @param string $altBody Alternative plain text content of the email for non-HTML email clients.
     * @param string $from (optional) Email address of the sender. Default is 'from@example.com'.
     * @param string $fromName (optional) Name of the sender. Default is 'Sender Name'.
     * @return string Returns 'Message sent' on success, or an error message on failure.
     * @throws Exception if the email cannot be sent.
     */
    public function sendEmail($to, $toName, $subject, $body, $altBody, $from = 'from@example.com', $fromName = 'Sender Name')
    {
        try {
            // Setting up the recipients
            $this->mail->setFrom($from, $fromName);
            $this->mail->addAddress($to, $toName);

            // Email content
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->AltBody = $altBody;

            $this->mail->send();
            return 'Mail sent';
        } catch (Exception $e) {
            return "PHPMailer Error: {$this->mail->ErrorInfo}";
        }
    }
}

?>
