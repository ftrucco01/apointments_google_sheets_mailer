<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once './EmailService.php';
require_once './GoogleSheetsService.php';

class AppointmentHandler {
    // Google Sheets range
    private const GOOGLE_SHEETS_RANGE = 'Turnos!A:F';

    // Email details
    private const EMAIL_SENDER = 'from@example.com';
    private const EMAIL_SENDER_NAME = 'Sender Name';
    private const COPY_EMAIL = 'copy@example.com';

    // Email template path
    private const EMAIL_TEMPLATE_PATH = './mail-template.html';

    private const MAIL_SUBJECT = 'Detalles del turno';

    public function processFormSubmission() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                // Retrieve form data                
                $name = $_POST['name'] ?? '';
                $origin = $_POST['origin'] ?? '';
                $registration = !empty($_POST['registration']) ? $_POST['registration'] : 'N/A';
                $email = $_POST['email'] ?? '';
                $checkup = $_POST['checkup'] ?? '';

                // Calculate appointment date and time
                $appointmentDate = $_POST['date'] ?? '';
                $appointmentTime = $_POST['appointmentTime'] ?? '';

                // Append data to Google Sheets
                $googleSheetsService = new GoogleSheetsService();
                $values = [[$name, $origin, $registration, $email, $checkup, $appointmentDate, $appointmentTime]];
                $googleSheetsService->appendData(self::GOOGLE_SHEETS_RANGE, $values);

                // Prepare and send email
                $emailService = new EmailService();
                $checkup = $this->getCheckoupDisplay($checkup);
                $body = file_get_contents(self::EMAIL_TEMPLATE_PATH);

                // Replace placeholders in the email body
                $body = str_replace('$nombre', $name, $body);
                $body = str_replace('$checkup', $checkup, $body);
                $body = str_replace('$fechaCita', $appointmentDate, $body);
                $body = str_replace('$horaCita', $appointmentTime, $body);
                
                $altBody = "Hello $name,\nYour appointment for $checkup is scheduled for $appointmentDate at $appointmentTime.";

                // Send email to the user
                $userEmailResult = $emailService->sendEmail($email, $name, self::MAIL_SUBJECT, $body, $altBody, self::EMAIL_SENDER, self::EMAIL_SENDER_NAME);

                // Send copy email
                $copyEmailResult = $emailService->sendEmail(self::COPY_EMAIL, 'Admin', self::MAIL_SUBJECT, $body, $altBody, self::EMAIL_SENDER, self::EMAIL_SENDER_NAME);

                echo 'Appointment scheduled and confirmation sent.';
            } catch (Exception $e) {
                // Handle exceptions and log them
                error_log($e->getMessage());
                echo 'An error occurred: ' . $e->getMessage();
            }
        }
    }

    private function getCheckoupDisplay(string $checkup)
    {
        $checkupDisplay = '';
        if ($checkup === 'campaigns') {
            $checkupDisplay = 'Campa&#xF1;as';
        } elseif ($checkup === 'work') {
            $checkupDisplay = 'Relaci&#xF3;n Laboral';
        }
        
        return $checkupDisplay;
    }

}

// Usage
$appointmentHandler = new AppointmentHandler();
$appointmentHandler->processFormSubmission();
?>
