<?php

namespace App\Services\Raben;

use DOMDocument;
use DOMXPath;
use SimpleXMLElement;

class Raben
{
    private string $url = 'https://test-osb.raben-group.com/CDM/tmsIntegrationService';
    private RabenXML $rabenXML;

    public function __construct()
    {
        $this->rabenXML = new RabenXML();
    }

    public function createTransportInstruction($dataArray)
    {
        $curl = curl_init();

        file_put_contents(storage_path('test2.xml'), $this->rabenXML->transportIntructionXML($dataArray));

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $this->rabenXML->transportIntructionXML($dataArray),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/xml'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public function getTransportDocuments($dataArray)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $this->rabenXML->getFilesXML($dataArray),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/xml'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        //Parse response and get pdf from base64
        $xmlElement = new SimpleXMLElement($response);
        $namespaces = $xmlElement->getNamespaces(true);
        $xmlElement->registerXPathNamespace('cdm', $namespaces['cdm']);
        $xmlElement->registerXPathNamespace('stan', $namespaces['stan']);

        $res = $xmlElement->xpath('//cdm:transportDocumentResponseMessage');
        $xmlArray = json_decode(json_encode($res), true);

        //filename from response
        $filename = $xmlArray[0]['transportDocumentResponse']['transportDocumentObjectName'];
        //path to save file
        $filepath = storage_path($filename);

        // Decode the base64 string into binary data
        $pdfData = base64_decode($xmlArray[0]['transportDocumentResponse']['transportDocumentObjectAttachment']);


        // Save the binary data into a file
        file_put_contents($filepath, $pdfData);

        // Set the appropriate headers for serving the PDF file
        header('Content-Type: application/pdf');
        header("Content-Disposition: inline; filename=\"$filename\"");
        header('Content-Length: ' . filesize($filepath));

    }

    public function getStatusCode($dataArray)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $this->rabenXML->getStatusCodeXML($dataArray),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/xml'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        //Parse response and get pdf from base64
        $xmlElement = new SimpleXMLElement($response);
        $namespaces = $xmlElement->getNamespaces(true);
        $xmlElement->registerXPathNamespace('tms', $namespaces['tms']);
        $xmlElement->registerXPathNamespace('stan', $namespaces['stan']);

        $res = $xmlElement->xpath('//tms:transportStatusNotificationMessage');
        $xmlArray = json_decode(json_encode($res), true);

        return $xmlArray[0]['transportStatusNotification']['transportStatusNotificationShipment']['transportStatus']['transportStatusConditionCode'];
    }
}
