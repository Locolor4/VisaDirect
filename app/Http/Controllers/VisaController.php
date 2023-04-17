<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisaController extends Controller
{
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->username = env('VISA_DIRECT_USER_ID');
        $this->password = env('VISA_DIRECT_PASSWORD');
    }

    public function createPullFunds(Request $request)
    {
        $url = 'https://sandbox.api.visa.com/visadirect/fundstransfer/v1/pullfundstransactions';

        $postData = array(
            "surcharge" => "11.99",
            "amount" => "124.02",
            "localTransactionDateTime" => "2023-04-17T00:00:00Z",
            "cpsAuthorizationCharacteristicsIndicator" => "Y",
            "cardAcceptor" => array(
                "address" => array(
                    "country" => "PER",
                    "zipCode" => "21001",
                    "state" => "Puno"
                ),
                "idCode" => "ABCD1234ABCD123",
                "name" => "Visa Inc. USA-Foster City",
                "terminalId" => "ABCD1234"
            ),
            "acquirerCountryCode" => "604",
            "acquiringBin" => "408999",
            "senderCurrencyCode" => "PEN",
            "retrievalReferenceNumber" => "330000560021",
            "systemsTraceAuditNumber" => "452011",
            "businessApplicationId" => "AA",
            "senderPrimaryAccountNumber" => "4060320000000127",
            "senderCardExpiryDate" => "2023-10",
        );

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic '.base64_encode($this->username.":".$this->password),
        ]);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSLCERT, getcwd().'/certs/cert.pem');
        curl_setopt($curl, CURLOPT_SSLKEY, getcwd().'/certs/key_b8df77c6-ea39-4217-8d1b-654c4a709ab1.pem');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_VERBOSE, 0);
        curl_setopt($curl, CURLOPT_HEADER, 0);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            echo "{$error_msg}";
        }

        curl_close($curl);

        return $response;
    }
}
