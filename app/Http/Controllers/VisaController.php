<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request as Psr7Request;

class VisaController extends Controller
{
    public function sendPayment(Request $request)
    {
        $username = 'V0Z5SAK67S1WO9KHR4VS21_VezHe-NV_JH9veHlRGrB5pAxUA';
        $password = 'HpQDhxtr9COs66XP63OBnCK39H';
        $url = 'https://sandbox.api.visa.com/visadirect/fundstransfer/v1/pullfundstransactions';

        $postData = array(
            "surcharge" => "11.99",
            "amount" => "124.02",
            "localTransactionDateTime" => "2023-04-17T00:00:00Z",
            "cpsAuthorizationCharacteristicsIndicator" => "Y",
            "riskAssessmentData" => array(
                "traExemptionIndicator" => true,
                "trustedMerchantExemptionIndicator" => true,
                "scpExemptionIndicator" => true,
                "delegatedAuthenticationIndicator" => true,
                "lowValueExemptionIndicator" => true
            ),
            "colombiaNationalServiceData" => array(
                "addValueTaxReturn" => "10.00",
                "taxAmountConsumption" => "10.00",
                "nationalNetReimbursementFeeBaseAmount" => "20.00",
                "addValueTaxAmount" => "10.00",
                "nationalNetMiscAmount" => "10.00",
                "countryCodeNationalService" => "170",
                "nationalChargebackReason" => "11",
                "emvTransactionIndicator" => "1",
                "nationalNetMiscAmountType" => "A",
                "costTransactionIndicator" => "0",
                "nationalReimbursementFee" => "20.00"
            ),
            "cardAcceptor" => array(
                "address" => array(
                    "country" => "USA",
                    "zipCode" => "94404",
                    "county" => "081",
                    "state" => "CA"
                ),
                "idCode" => "ABCD1234ABCD123",
                "name" => "Visa Inc. USA-Foster City",
                "terminalId" => "ABCD1234"
            ),
            "acquirerCountryCode" => "840",
            "acquiringBin" => "408999",
            "senderCurrencyCode" => "USD",
            "retrievalReferenceNumber" => "330000560021",
            "addressVerificationData" => array(
                "street" => "XYZ St",
                "postalCode" => "12345"
            ),
            "cavv" => "0700100038238906000013405823891061668252",
            "systemsTraceAuditNumber" => "452011",
            "businessApplicationId" => "AA",
            "senderPrimaryAccountNumber" => "4060320000000127",
            "settlementServiceIndicator" => "9",
            "visaMerchantIdentifier" => "73625198",
            "foreignExchangeFeeTransaction" => "11.99",
            "senderCardExpiryDate" => "2023-10",
            "nationalReimbursementFee" => "11.22"
        );

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic '.base64_encode($username.":".$password),
        ]);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSLCERT, getcwd().'/certs/cert.pem');
        curl_setopt($curl, CURLOPT_SSLKEY, getcwd().'/certs/key_b8df77c6-ea39-4217-8d1b-654c4a709ab1.pem');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_VERBOSE, 0);
        curl_setopt($curl, CURLOPT_HEADER, 1);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            echo "{$error_msg}";
        }

        curl_close($curl);

        return $response;
    }
}
