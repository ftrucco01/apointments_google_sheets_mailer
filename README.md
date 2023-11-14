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

## Configuration
1. Set up your Google Sheets API credentials (see [Google Sheets API Documentation](https://developers.google.com/sheets/api/guides/authorizing)).
2. Place your `google-credentials.json` in the project root.
3. Configure the `EmailService` in `src/EmailService.php` with your SMTP settings.

## Usage
1. Open the project in a PHP-supported server environment.
2. Navigate to the form (e.g., `index.html`) and fill in the details.
3. Submit the form to schedule an appointment. The data will be sent to the specified Google Sheets document, and a confirmation email will be sent.