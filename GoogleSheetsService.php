<?php

require_once __DIR__ . '/vendor/autoload.php';

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class GoogleSheetsService
{
    private $client;
    private $service;

    // Configuration constants
    const PREAD_SHEET_ID = '181RP5UjF5rJrn5ZUhrf9zAsdI6hh2Ylm0VylPCdr1gU';
    private const APPLICATION_NAME = 'Google Sheets and PHP';
    private const SCOPES = [Sheets::SPREADSHEETS];
    private const AUTH_CONFIG_PATH = __DIR__ . '/google-credentials.json';

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setApplicationName(self::APPLICATION_NAME);
        $this->client->setScopes(self::SCOPES);
        $this->client->setAuthConfig(self::AUTH_CONFIG_PATH);

        $this->service = new Sheets($this->client);
    }

    /**
     * Appends data to a specified range in a Google Sheets spreadsheet.
     *
     * @param string $range The A1 notation of the range to which the values should be appended.
     * @param array $values The array of values to append. This should be a two-dimensional array where each sub-array is 
     *                      a row of data, and each element within the sub-array is a cell.
     * @return int Returns the number of cells updated.
     * @throws Exception if there is an error in the Google Sheets API request.
     */
    public function appendData($range, $values)
    {
        $body = new ValueRange(['values' => $values]);
        $params = ['valueInputOption' => 'RAW'];
        $result = $this->service->spreadsheets_values->append(self::PREAD_SHEET_ID, $range, $body, $params);
        return $result->getUpdates()->getUpdatedCells();
    }
}