# Appointment Scheduler with Google Sheets Integration

## Description
This project is a PHP-based web application for scheduling appointments. It features a form for users to schedule appointments, which are then recorded in a Google Sheets document. The application also sends a confirmation email to the user and a copy to a specified email address.

## Features
- HTML form for appointment scheduling.
- PHP backend for form processing.
- Integration with Google Sheets for storing appointment data.
- Email confirmation sent to the user and a specified admin email.

## Installation

### Prerequisites
- PHP
- Composer
- Access to Google Sheets API

### Steps
1. Clone the repository:
   ```sh
   git clone git@github.com:ftrucco01/appointments_google_sheets_mailer.git
   ```
2. Navigate to the project directory:
   ```sh
   cd appointments_google_sheets_mailer
   ```
3. Install dependencies using Composer:
   ```sh
   composer install
   ```

Sure, here's how you can add a section to your documentation explaining the configuration details for the mailer and Google Sheets API:

## Mailer Configuration

### Overview
The `EmailService` class in `src/EmailService.php` is configured to use PHPMailer for sending emails. This service can be used to send confirmation emails to users and admin upon scheduling an appointment.

### SMTP Settings
The service is set up with the following SMTP configuration constants:
- `SMTP_HOST`: The hostname of the mail server. Currently set to 'sandbox.smtp.mailtrap.io' for testing purposes.
- `SMTP_USER`: The SMTP username. Example: '1a6adcd5e50f93'.
- `SMTP_PASSWORD`: The SMTP password.
- `SMTP_PORT`: The port used for SMTP. Set to 2525 for Mailtrap.
- `SMTP_SECURE`: Encryption type. Using `PHPMailer::ENCRYPTION_STARTTLS` for secure connection.

### How to Configure
1. Replace the SMTP settings constants in `src/EmailService.php` with your own mail server details.
2. If you're using a service like Mailtrap for testing, you can use the provided settings. For production, you should use your actual mail server details.

## Google Sheets API Configuration

### Overview
The `GoogleSheetsService` class in `src/GoogleSheetsService.php` handles the integration with Google Sheets. It is used to append appointment data to a specified Google Sheet.

### API Credentials
You need to set up your Google Cloud project and enable the Google Sheets API. After that, create credentials (service account key) and download the JSON file.

### How to Configure
1. Place your `google-credentials.json` file in the project root. This file contains your Google service account key.
2. The `PREAD_SHEET_ID` constant in `src/GoogleSheetsService.php` should be set to your Google Sheets ID where you want to store the appointments data.

### Using the Service
- To use the service, instantiate `GoogleSheetsService` and call the `appendData` method with the range and values you want to append to your sheet.

This added section will help users understand how to configure both the mailer and the Google Sheets API integration for the appointment scheduler application.

## Usage
1. Open the project in a PHP-supported server environment.
2. Navigate to the form (e.g., `index.html`) and fill in the details.
3. Submit the form to schedule an appointment. The data will be sent to the specified Google Sheets document, and a confirmation email will be sent.

## Vedeo Demo
- video_demo.webm