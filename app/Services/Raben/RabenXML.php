<?php

namespace App\Services\Raben;

use DOMDocument;

class RabenXML
{
    private $login = 'rlp_tms';
    private $password = 'kD3GTk4VfPKdL2tH9RT5b6oAkKaCqF';

    public function transportIntructionXML($dataArray)
    {

        // Create a new DOMDocument
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;

        $envelope = $dom->createElement('soapenv:Envelope');
        $envelope->setAttribute('xmlns:soapenv', 'http://schemas.xmlsoap.org/soap/envelope/');
        $envelope->setAttribute('xmlns:tms', 'urn:CDM/tmsIntegrationService/');
        $envelope->setAttribute('xmlns:stan', 'http://www.unece.org/cefact/namespaces/StandardBusinessDocumentHeader');

        $dom->appendChild($envelope);

        // Create Header element
        $header = $dom->createElement('soapenv:Header');

        // Create Security element
        $security = $dom->createElement('wsse:Security');
        $security->setAttribute('xmlns:wsse', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd');
        $security->setAttribute('xmlns:wsu', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd');

        // Create UsernameToken element
        $usernameToken = $dom->createElement('wsse:UsernameToken');
        $usernameToken->setAttribute('wsu:Id', 'UsernameToken-E3FC06748A2AA26ADC14643444835251');

        // Create Username element and set its value
        $username = $dom->createElement('wsse:Username', $this->login);

        // Create Password element and set its value and type
        $password = $dom->createElement('wsse:Password', $this->password);
        $password->setAttribute('Type', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText');

        // Append Username and Password elements to UsernameToken
        $usernameToken->appendChild($username);
        $usernameToken->appendChild($password);

        // Append UsernameToken to Security
        $security->appendChild($usernameToken);

        // Append Security to Header
        $header->appendChild($security);

        // Append Header to Envelope
        $envelope->appendChild($header);

        // Create Body element
        $body = $dom->createElement('soapenv:Body');
        $envelope->appendChild($body);

        // Create transportInstructionMessage element
        $root = $dom->createElement('ns13:transportInstructionMessage');
        $root->setAttribute('xmlns:ns13', 'urn:CDM/tmsIntegrationService/');

        $body->appendChild($root);

        // Create the root element <StandardBusinessDocumentHeader>
        $standartBussinessDocument = $dom->createElementNS('http://www.unece.org/cefact/namespaces/StandardBusinessDocumentHeader', 'StandardBusinessDocumentHeader');
        $root->appendChild($standartBussinessDocument);

        // Create <HeaderVersion> element and append it to <StandardBusinessDocumentHeader>
        $headerVersion = $dom->createElement('HeaderVersion', '1');
        $standartBussinessDocument->appendChild($headerVersion);

        // Create <Sender> element and append it to <StandardBusinessDocumentHeader>
        $sender = $dom->createElement('Sender');
        $standartBussinessDocument->appendChild($sender);

        // Create <Identifier> element for <Sender> and append it to <Sender>
        $senderIdentifier = $dom->createElement('Identifier', $dataArray['EDI_SENDER']);
        $sender->appendChild($senderIdentifier);

        // Create <Receiver> element and append it to <StandardBusinessDocumentHeader>
        $receiver = $dom->createElement('Receiver');
        $standartBussinessDocument->appendChild($receiver);

        // Create <Identifier> element for <Receiver> and append it to <Receiver>
        $receiverIdentifier = $dom->createElement('Identifier', $dataArray['EDI_RECEIVER']);
        $receiver->appendChild($receiverIdentifier);

        // Create <DocumentIdentification> element and append it to <StandardBusinessDocumentHeader>
        $documentIdentification = $dom->createElement('DocumentIdentification');
        $standartBussinessDocument->appendChild($documentIdentification);

        // Create <Standard> element for <DocumentIdentification> and append it to <DocumentIdentification>
        $standard = $dom->createElement('Standard', 'GS1');
        $documentIdentification->appendChild($standard);

        // Create <TypeVersion> element for <DocumentIdentification> and append it to <DocumentIdentification>
        $typeVersion = $dom->createElement('TypeVersion', '3.2');
        $documentIdentification->appendChild($typeVersion);

        // Create <InstanceIdentifier> element for <DocumentIdentification> and append it to <DocumentIdentification>
        $instanceIdentifier = $dom->createElement('InstanceIdentifier', '100002');
        $documentIdentification->appendChild($instanceIdentifier);

        // Create <Type> element for <DocumentIdentification> and append it to <DocumentIdentification>
        $type = $dom->createElement('Type', 'Transport Instruction');
        $documentIdentification->appendChild($type);

        // Create <CreationDateAndTime> element for <DocumentIdentification> and append it to <DocumentIdentification>
        $creationDateAndTime = $dom->createElement('CreationDateAndTime', $dataArray['EDI_FILE_CREATION_TIMESTAMP']);
        $documentIdentification->appendChild($creationDateAndTime);

        // Create <BusinessScope> element and append it to <StandardBusinessDocumentHeader>
        $businessScope = $dom->createElement('BusinessScope');
        $standartBussinessDocument->appendChild($businessScope);

        // Create individual <Scope> elements and append them to <BusinessScope>
        $scopes = [
            ['Type' => 'EDIcustomerNumber', 'InstanceIdentifier' => '90000050'],
            ['Type' => 'fileType', 'InstanceIdentifier' => $dataArray['FILE_TYPE']],
            ['Type' => 'department', 'InstanceIdentifier' => $dataArray['RABEN_DEPARTMENT']],
            ['Type' => 'application', 'InstanceIdentifier' => 'INT'],
        ];

        foreach ($scopes as $scopeData) {
            $scope = $dom->createElement('Scope');
            $businessScope->appendChild($scope);

            $type = $dom->createElement('Type', $scopeData['Type']);
            $scope->appendChild($type);

            $instanceIdentifier = $dom->createElement('InstanceIdentifier', $scopeData['InstanceIdentifier']);
            $scope->appendChild($instanceIdentifier);
        }

        // transportInstruction
        // Create the root element <transportInstruction>
        $transportInstruction = $dom->createElement('transportInstruction');
        $transportInstruction->setAttribute('xmlns:ns4', 'urn:gs1:ecom:transport_instruction:xsd:3');
        $transportInstruction->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $transportInstruction->setAttribute('xsi:type', 'ns4:TransportInstructionType');

        $root->appendChild($transportInstruction);

        // Create child elements of <transportInstruction> and append them
        $creationDateTime = $dom->createElement('creationDateTime', $dataArray['EDI_FILE_CREATION_TIMESTAMP']);
        $transportInstruction->appendChild($creationDateTime);

        $documentStatusCode = $dom->createElement('documentStatusCode', 'ORIGINAL');
        $transportInstruction->appendChild($documentStatusCode);

        $documentActionCode = $dom->createElement('documentActionCode', $dataArray['ORDER_CREATION_TYPE']);
        $transportInstruction->appendChild($documentActionCode);

        $transportInstructionIdentification = $dom->createElement('transportInstructionIdentification');
        $transportInstruction->appendChild($transportInstructionIdentification);
        $entityIdentification = $dom->createElement('entityIdentification', $dataArray['EDI_REFERENCE_NUMBER']);
        $transportInstructionIdentification->appendChild($entityIdentification);

        // Create the contentOwner element
        $contentOwner = $dom->createElement('contentOwner');
        $transportInstructionIdentification->appendChild($contentOwner);

        // Create the gln element
        $gln = $dom->createElement('gln', $dataArray['GLN']);
        $contentOwner->appendChild($gln);

        // Create the additionalPartyIdentification element
        $additionalPartyIdentification = $dom->createElement('additionalPartyIdentification');
        $additionalPartyIdentification->setAttribute('additionalPartyIdentificationTypeCode', 'searchname');
        $additionalPartyIdentification->setAttribute('xmlns:ns2', 'urn:gs1:shared:shared_common:xsd:3');
        $additionalPartyIdentification->setAttribute('xsi:type', 'ns2:AdditionalPartyIdentificationType');
        $additionalPartyIdentification->nodeValue = 'YARYCKATL1';
        $contentOwner->appendChild($additionalPartyIdentification);

        $transportInstructionFunction = $dom->createElement('transportInstructionFunction', 'SHIPMENT');
        $transportInstruction->appendChild($transportInstructionFunction);

        $logisticServicesBuyer = $dom->createElement('logisticServicesBuyer');
        $additionalPartyIdentification2 = $dom->createElement('additionalPartyIdentification', $dataArray['PAYER_IDENTIFIER']);
        $additionalPartyIdentification2->setAttribute('additionalPartyIdentificationTypeCode', 'searchname');
        $additionalPartyIdentification2->setAttribute('xmlns:ns2', 'urn:gs1:shared:shared_common:xsd:3');
        $additionalPartyIdentification2->setAttribute('xsi:type', 'ns2:AdditionalPartyIdentificationType');
        $logisticServicesBuyer->appendChild($additionalPartyIdentification2);
        $transportInstruction->appendChild($logisticServicesBuyer);

        // Create the root element <transportInstructionShipment>
        $transportInstructionShipment = $dom->createElement('transportInstructionShipment');
        $transportInstruction->appendChild($transportInstructionShipment);

        // Create child elements of <transportInstructionShipment> and append them
        $additionalShipmentIdentification = $dom->createElement('additionalShipmentIdentification', $dataArray['SHIPMENT_REFERENCE_NUMBER']);
        $additionalShipmentIdentification->setAttribute('additionalShipmentIdentificationTypeCode', 'refopd');
        $additionalShipmentIdentification->setAttribute('xmlns:ns2', 'urn:gs1:shared:shared_common:xsd:3');
        $additionalShipmentIdentification->setAttribute('xsi:type', 'ns2:AdditionalShipmentIdentificationType');
        $transportInstructionShipment->appendChild($additionalShipmentIdentification);
        $transportInstructionShipment->setAttribute('xmlns:ns5', 'urn:gs1:ecom:transport_instruction_common:xsd:3');
        $transportInstructionShipment->setAttribute('xsi:type', 'ns5:TransportInstructionShipmentType');

        $receiver = $dom->createElement('receiver');
        $transportInstructionShipment->appendChild($receiver);

        $additionalPartyIdentification1 = $dom->createElement('additionalPartyIdentification', $dataArray['RECEIVER_ADDRESS_IDENTIFIER']);
        $additionalPartyIdentification1->setAttribute('additionalPartyIdentificationTypeCode', 'searchname');
        $additionalPartyIdentification1->setAttribute('xmlns:ns2', 'urn:gs1:shared:shared_common:xsd:3');
        $additionalPartyIdentification1->setAttribute('xsi:type', 'ns2:AdditionalPartyIdentificationType');
        $receiver->appendChild($additionalPartyIdentification1);

        $address1 = $dom->createElement('address');
        $receiver->appendChild($address1);

        $city1 = $dom->createElement('city', $dataArray['RECEIVER_CITY']);
        $address1->appendChild($city1);

        $countryCode1 = $dom->createElement('countryCode', $dataArray['RECEIVER_COUNTRY_CODE']);
        $countryCode1->setAttribute('xmlns:ns2', 'urn:gs1:shared:shared_common:xsd:3');
        $countryCode1->setAttribute('xsi:type', 'ns2:CountryCodeType');

        $address1->appendChild($countryCode1);

        $name1 = $dom->createElement('name', $dataArray['RECEIVER_NAME']);
        $address1->appendChild($name1);

        $postalCode1 = $dom->createElement('postalCode', $dataArray['RECEIVER_POSTAL_CODE']);
        $address1->appendChild($postalCode1);

        $streetAddressOne1 = $dom->createElement('streetAddressOne', $dataArray['RECEIVER_STREET_ADDRESS']);
        $address1->appendChild($streetAddressOne1);

        $shipper = $dom->createElement('shipper');
        $transportInstructionShipment->appendChild($shipper);

        $additionalPartyIdentification2 = $dom->createElement('additionalPartyIdentification', $dataArray['SHIPPER_ADDRESS_IDENTIFIER']);
        $additionalPartyIdentification2->setAttribute('additionalPartyIdentificationTypeCode', 'searchname');
        $additionalPartyIdentification2->setAttribute('additionalPartyIdentificationTypeCode', 'searchname');
        $additionalPartyIdentification2->setAttribute('xmlns:ns2', 'urn:gs1:shared:shared_common:xsd:3');
        $additionalPartyIdentification2->setAttribute('xsi:type', 'ns2:AdditionalPartyIdentificationType');
        $shipper->appendChild($additionalPartyIdentification2);

        $address2 = $dom->createElement('address');
        $shipper->appendChild($address2);

        $city2 = $dom->createElement('city', $dataArray['SHIPPER_CITY']);
        $address2->appendChild($city2);

        $countryCode2 = $dom->createElement('countryCode', $dataArray['SHIPPER_COUNTRY_CODE']);
        $countryCode2->setAttribute('xmlns:ns2', 'urn:gs1:shared:shared_common:xsd:3');
        $countryCode2->setAttribute('xsi:type', 'ns2:CountryCodeType');
        $address2->appendChild($countryCode2);

        $name2 = $dom->createElement('name', $dataArray['SHIPPER_NAME']);
        $address2->appendChild($name2);

        $postalCode2 = $dom->createElement('postalCode', $dataArray['SHIPPER_POSTAL_CODE']);
        $address2->appendChild($postalCode2);

        $streetAddressOne2 = $dom->createElement('streetAddressOne', $dataArray['SHIPPER_STREET_ADDRESS']);
        $address2->appendChild($streetAddressOne2);

        $shipTo = $dom->createElement('shipTo');
        $transportInstructionShipment->appendChild($shipTo);

        $additionalPartyIdentification3 = $dom->createElement('additionalPartyIdentification', $dataArray['UNLOADING_ADDRESS_IDENTIFIER']);
        $additionalPartyIdentification3->setAttribute('additionalPartyIdentificationTypeCode', 'searchname');
        $additionalPartyIdentification3->setAttribute('xmlns:ns2', 'urn:gs1:shared:shared_common:xsd:3');
        $additionalPartyIdentification3->setAttribute('xsi:type', 'ns2:AdditionalPartyIdentificationType');
        $shipTo->appendChild($additionalPartyIdentification3);

        $address3 = $dom->createElement('address');
        $shipTo->appendChild($address3);

        $city3 = $dom->createElement('city', $dataArray['UNLOADING_ADDRESS_CITY']);
        $address3->appendChild($city3);

        $countryCode3 = $dom->createElement('countryCode', $dataArray['UNLOADING_ADDRESS_COUNTRY_CODE']);
        $countryCode3->setAttribute('xmlns:ns2', 'urn:gs1:shared:shared_common:xsd:3');
        $countryCode3->setAttribute('xsi:type', 'ns2:CountryCodeType');

        $address3->appendChild($countryCode3);

        $name3 = $dom->createElement('name', $dataArray['UNLOADING_ADDRESS_NAME']);
        $address3->appendChild($name3);

        $postalCode3 = $dom->createElement('postalCode', $dataArray['UNLOADING_ADDRESS_POSTAL_CODE']);
        $address3->appendChild($postalCode3);

        $streetAddressOne3 = $dom->createElement('streetAddressOne', $dataArray['UNLOADING_ADDRESS_STREET_ADDRESS']);
        $address3->appendChild($streetAddressOne3);

        $contact = $dom->createElement('contact');
        $shipTo->appendChild($contact);

        $contactTypeCode = $dom->createElement('contactTypeCode', 'BJ');
        $contact->appendChild($contactTypeCode);

        $personName = $dom->createElement('personName', $dataArray['UNLOADING_ADDRESS_CONTACT_PERSON']);
        $contact->appendChild($personName);

        $communicationChannel1 = $dom->createElement('communicationChannel');
        $contact->appendChild($communicationChannel1);

        $communicationChannelCode1 = $dom->createElement('communicationChannelCode', 'EMAIL');
        $communicationChannel1->appendChild($communicationChannelCode1);

        $communicationValue1 = $dom->createElement('communicationValue', $dataArray['UNLOADING_ADDRESS_CONTACT_EMAIL']);
        $communicationChannel1->appendChild($communicationValue1);

        $communicationChannel2 = $dom->createElement('communicationChannel');
        $contact->appendChild($communicationChannel2);

        $communicationChannelCode2 = $dom->createElement('communicationChannelCode', 'TELEPHONE');
        $communicationChannel2->appendChild($communicationChannelCode2);

        $communicationValue2 = $dom->createElement('communicationValue', $dataArray['UNLOADING_ADDRESS_CONTACT_PHONE']);
        $communicationChannel2->appendChild($communicationValue2);

        $shipFrom = $dom->createElement('shipFrom');
        $transportInstructionShipment->appendChild($shipFrom);

        $additionalPartyIdentification4 = $dom->createElement('additionalPartyIdentification', $dataArray['LOADING_ADDRESS_IDENTIFIER']);
        $additionalPartyIdentification4->setAttribute('additionalPartyIdentificationTypeCode', 'searchname');
        $additionalPartyIdentification4->setAttribute('xmlns:ns2', 'urn:gs1:shared:shared_common:xsd:3');
        $additionalPartyIdentification4->setAttribute('xsi:type', 'ns2:AdditionalPartyIdentificationType');
        $shipFrom->appendChild($additionalPartyIdentification4);

        $address4 = $dom->createElement('address');
        $shipFrom->appendChild($address4);

        $city4 = $dom->createElement('city', $dataArray['LOADING_ADDRESS_CITY']);
        $address4->appendChild($city4);

        $countryCode4 = $dom->createElement('countryCode', $dataArray['LOADING_ADDRESS_COUNTRY_CODE']);
        $countryCode4->setAttribute('xmlns:ns2', 'urn:gs1:shared:shared_common:xsd:3');
        $countryCode4->setAttribute('xsi:type', 'ns2:CountryCodeType');

        $address4->appendChild($countryCode4);

        $name4 = $dom->createElement('name', $dataArray['LOADING_ADDRESS_NAME']);
        $address4->appendChild($name4);

        $postalCode4 = $dom->createElement('postalCode', $dataArray['LOADING_ADDRESS_POSTAL_CODE']);
        $address4->appendChild($postalCode4);

        $streetAddressOne4 = $dom->createElement('streetAddressOne', $dataArray['LOADING_ADDRESS_STREET_ADDRESS']);
        $address4->appendChild($streetAddressOne4);

        $contact = $dom->createElement('contact');
        $shipFrom->appendChild($contact);

        $contactTypeCode = $dom->createElement('contactTypeCode', 'BJ');
        $contact->appendChild($contactTypeCode);

        $personName = $dom->createElement('personName', $dataArray['LOADING_ADDRESS_CONTACT_PERSON']);
        $contact->appendChild($personName);

        $communicationChannel1 = $dom->createElement('communicationChannel');
        $contact->appendChild($communicationChannel1);

        $communicationChannelCode1 = $dom->createElement('communicationChannelCode', 'EMAIL');
        $communicationChannel1->appendChild($communicationChannelCode1);

        $communicationValue1 = $dom->createElement('communicationValue', $dataArray['LOADING_ADDRESS_CONTACT_EMAIL']);
        $communicationChannel1->appendChild($communicationValue1);

        $communicationChannel2 = $dom->createElement('communicationChannel');
        $contact->appendChild($communicationChannel2);

        $communicationChannelCode2 = $dom->createElement('communicationChannelCode', 'TELEPHONE');
        $communicationChannel2->appendChild($communicationChannelCode2);

        $communicationValue2 = $dom->createElement('communicationValue', $dataArray['LOADING_ADDRESS_CONTACT_PHONE']);
        $communicationChannel2->appendChild($communicationValue2);

        $transportInstructionTerms = $dom->createElement('transportInstructionTerms');
        $transportInstructionShipment->appendChild($transportInstructionTerms);

        $transportServiceCategoryType = $dom->createElement('transportServiceCategoryType', '30');
        $transportServiceCategoryType->setAttribute('xmlns:ns3', 'urn:gs1:ecom:ecom_common:xsd:3');
        $transportServiceCategoryType->setAttribute('xsi:type', 'ns3:TransportServiceCategoryCodeType');


        $transportInstructionTerms->appendChild($transportServiceCategoryType);

        $logisticService1 = $dom->createElement('logisticService');
        $logisticService1->setAttribute('xsi:type', "ns5:logisticService_type0");
        $transportInstructionTerms->appendChild($logisticService1);

        $logisticServiceRequirementCode1 = $dom->createElement('logisticServiceRequirementCode', 'ForPlanning');
        $logisticServiceRequirementCode1->setAttribute('logisticServiceTypeCode', 'parameters');
        $logisticServiceRequirementCode1->setAttribute('xmlns:ns3', 'urn:gs1:ecom:ecom_common:xsd:3');
        $logisticServiceRequirementCode1->setAttribute('xsi:type', 'ns3:LogisticServiceRequirementCodeType');

        $logisticService1->appendChild($logisticServiceRequirementCode1);

        $logisticService2 = $dom->createElement('logisticService');
        $logisticService2->setAttribute('xsi:type', "ns5:logisticService_type0");
        $transportInstructionTerms->appendChild($logisticService2);
        $logisticServiceRequirementCode2 = $dom->createElement('logisticServiceRequirementCode', $dataArray['PRODUCT_TYPE']);
        $logisticServiceRequirementCode2->setAttribute('logisticServiceTypeCode', 'productType');
        $logisticServiceRequirementCode2->setAttribute('xmlns:ns3', 'urn:gs1:ecom:ecom_common:xsd:3');
        $logisticServiceRequirementCode2->setAttribute('xsi:type', 'ns3:LogisticServiceRequirementCodeType');
        $logisticService2->appendChild($logisticServiceRequirementCode2);

        if ($dataArray['RETURN_DOCUMENTS']) {
        $logisticServiceR = $dom->createElement('logisticService');
        $logisticServiceR->setAttribute('xsi:type', "ns5:logisticService_type0");
        $transportInstructionTerms->appendChild($logisticServiceR);
        $logisticServiceRequirementCodeR = $dom->createElement('logisticServiceRequirementCode', 'ROD');
        $logisticServiceRequirementCodeR->setAttribute('logisticServiceTypeCode', 'parameters');
        $logisticServiceRequirementCodeR->setAttribute('xmlns:ns3', 'urn:gs1:ecom:ecom_common:xsd:3');
        $logisticServiceRequirementCodeR->setAttribute('xsi:type', 'ns3:LogisticServiceRequirementCodeType');

        $logisticServiceR->appendChild($logisticServiceRequirementCodeR);
        }

        if ($dataArray['RETURN_PALLETS']) {
        $logisticServiceR2 = $dom->createElement('logisticService');
        $logisticServiceR2->setAttribute('xsi:type', "ns5:logisticService_type0");
        $transportInstructionTerms->appendChild($logisticServiceR2);
        $logisticServiceRequirementCodeR2 = $dom->createElement('logisticServiceRequirementCode', 'ROP');
        $logisticServiceRequirementCodeR2->setAttribute('logisticServiceTypeCode', 'parameters');
        $logisticServiceRequirementCodeR2->setAttribute('xmlns:ns3', 'urn:gs1:ecom:ecom_common:xsd:3');
        $logisticServiceRequirementCodeR2->setAttribute('xsi:type', 'ns3:LogisticServiceRequirementCodeType');

        $logisticServiceR2->appendChild($logisticServiceRequirementCodeR2);
        }

        $plannedDelivery = $dom->createElement('plannedDelivery');
        $transportInstructionShipment->appendChild($plannedDelivery);

        $logisticEventPeriod1 = $dom->createElement('logisticEventPeriod');
        $plannedDelivery->appendChild($logisticEventPeriod1);

        $beginDate1 = $dom->createElement('beginDate', $dataArray['PLANNED_DELIVERY_START_DATE']);
        $logisticEventPeriod1->appendChild($beginDate1);

        $beginTime1 = $dom->createElement('beginTime', $dataArray['PLANNED_DELIVERY_START_TIME']);
        $logisticEventPeriod1->appendChild($beginTime1);

        $endDate1 = $dom->createElement('endDate', $dataArray['PLANNED_DELIVERY_END_DATE']);
        $logisticEventPeriod1->appendChild($endDate1);

        $endTime1 = $dom->createElement('endTime', $dataArray['PLANNED_DELIVERY_END_TIME']);
        $logisticEventPeriod1->appendChild($endTime1);

        $plannedDespatch = $dom->createElement('plannedDespatch');
        $transportInstructionShipment->appendChild($plannedDespatch);

        $logisticEventPeriod2 = $dom->createElement('logisticEventPeriod');
        $plannedDespatch->appendChild($logisticEventPeriod2);

        $beginDate2 = $dom->createElement('beginDate', $dataArray['PLANNED_DESPATCH_START_DATE']);
        $logisticEventPeriod2->appendChild($beginDate2);

        $beginTime2 = $dom->createElement('beginTime', $dataArray['PLANNED_DESPATCH_START_TIME']);
        $logisticEventPeriod2->appendChild($beginTime2);

        $endDate2 = $dom->createElement('endDate', $dataArray['PLANNED_DESPATCH_END_DATE']);
        $logisticEventPeriod2->appendChild($endDate2);

        $endTime2 = $dom->createElement('endTime', $dataArray['PLANNED_DESPATCH_END_TIME']);
        $logisticEventPeriod2->appendChild($endTime2);

        $deliveryTerms = $dom->createElement('deliveryTerms');
        $transportInstructionShipment->appendChild($deliveryTerms);

        $incotermsCode = $dom->createElement('incotermsCode', $dataArray['INCOTERMS_CODE']);
        $deliveryTerms->appendChild($incotermsCode);

        $packageTotal = $dom->createElement('packageTotal');
        $transportInstructionShipment->appendChild($packageTotal);

        $packageTypeCode = $dom->createElement('packageTypeCode', $dataArray['PACKAGE_CODE']);
        $packageTypeCode->setAttribute('logisticServiceTypeCode', 'additionalUnits');
        $packageTotal->appendChild($packageTypeCode);

        $totalPackageQuantity = $dom->createElement('totalPackageQuantity', $dataArray['PACKAGE_QUANTITY']);
        $packageTotal->appendChild($totalPackageQuantity);

        $transportInstruction->appendChild($transportInstructionShipment);


        // GOODS LINE INFORMATION
        $shipmentItemElement = $dom->createElement('transportInstructionShipmentItem');
        $transportInstructionShipment->appendChild($shipmentItemElement);

        // Create the <lineItemNumber> element and set its value. lineItemNumber equals goods iteration, but start from 1
        $lineItemNumberElement = $dom->createElement('lineItemNumber', 1);
        $shipmentItemElement->appendChild($lineItemNumberElement);

        // Create the <parentLineItemNumber> element and set its value
        $parentLineItemNumberElement = $dom->createElement('parentLineItemNumber', '1');
        $shipmentItemElement->appendChild($parentLineItemNumberElement);

        // Create the <logisticUnit> element
        $logisticUnitElement = $dom->createElement('logisticUnit');
        $shipmentItemElement->appendChild($logisticUnitElement);

        // Create the <additionalLogisticUnitIdentification> element and set its value and attribute
        $additionalLogisticUnitIdentificationElement = $dom->createElement('additionalLogisticUnitIdentification', $dataArray['TRANSPORT_UNIT_BARCODE']);
        $additionalLogisticUnitIdentificationElement->setAttribute('additionalLogisticUnitIdentificationTypeCode', 'externalUnit');
        $logisticUnitElement->appendChild($additionalLogisticUnitIdentificationElement);

        // Create the <grossWeight> element and set its value and attribute
        $grossWeightElement = $dom->createElement('grossWeight', $dataArray['TRANSPORT_UNIT_GROSS_WEIGHT']);
        $grossWeightElement->setAttribute('measurementUnitCode', 'KGM');
        $logisticUnitElement->appendChild($grossWeightElement);

         //Create the <dimension> element
        $dimensionElement = $dom->createElement('dimension');
        $logisticUnitElement->appendChild($dimensionElement);

        // Create the <depth> element and set its value and attribute
        $depthElement = $dom->createElement('depth', $dataArray['TRANSPORT_UNIT_DEPTH']);
        $depthElement->setAttribute('measurementUnitCode', 'MTR');
        $dimensionElement->appendChild($depthElement);

         //Create the <height> element and set its value and attribute
        $heightElement = $dom->createElement('height', $dataArray['TRANSPORT_UNIT_HEIGHT']);
        $heightElement->setAttribute('measurementUnitCode', 'MTR');
        $dimensionElement->appendChild($heightElement);

        // Create the <width> element and set its value and attribute
        $widthElement = $dom->createElement('width', $dataArray['TRANSPORT_UNIT_WIDTH']);
        $widthElement->setAttribute('measurementUnitCode', 'MTR');
        $dimensionElement->appendChild($widthElement);

        // Create the <transportCargoCharacteristics> element
        $cargoCharacteristicsElement = $dom->createElement('transportCargoCharacteristics');
        $shipmentItemElement->appendChild($cargoCharacteristicsElement);

        // Create the <cargoTypeCode> element and set its value
        $cargoTypeCodeElement = $dom->createElement('cargoTypeCode', $dataArray['CARGO_TYPE_CODE']);
        $cargoTypeCodeElement->setAttribute('xmlns:ns3', 'urn:gs1:ecom:ecom_common:xsd:3');
        $cargoTypeCodeElement->setAttribute('xsi:type', 'ns3:CargoTypeCodeType');

        $cargoCharacteristicsElement->appendChild($cargoTypeCodeElement);

        // Create the <cargoTypeDescription> element and set its value and attribute
        $cargoTypeDescriptionElement = $dom->createElement('cargoTypeDescription', $dataArray['CARGO_DESCRIPTION']);
        $cargoTypeDescriptionElement->setAttribute('languageCode', 'PL');
        $cargoTypeDescriptionElement->setAttribute('xmlns:ns2', 'urn:gs1:shared:shared_common:xsd:3');
        $cargoTypeDescriptionElement->setAttribute('xsi:type', 'ns2:Description200Type');

        $cargoCharacteristicsElement->appendChild($cargoTypeDescriptionElement);

        // Create the <totalGrossVolume> element and set its value and attribute
        $totalGrossVolumeElement = $dom->createElement('totalGrossVolume', $dataArray['TOTAL_GOODSLINE_CARGO_VOLUME']);
        $totalGrossVolumeElement->setAttribute('measurementUnitCode', 'MTQ');
        $cargoCharacteristicsElement->appendChild($totalGrossVolumeElement);

        // Create the <totalGrossWeight> element and set its value and attribute
        $totalGrossWeightElement = $dom->createElement('totalGrossWeight', $dataArray['TOTAL_GOODSLINE_CARGO_GROSS_WEIGHT']);
        $totalGrossWeightElement->setAttribute('measurementUnitCode', 'KGM');
        $cargoCharacteristicsElement->appendChild($totalGrossWeightElement);

        // Create the <totalLoadingLength> element and set its value and attribute
        $totalLoadingLengthElement = $dom->createElement('totalLoadingLength', $dataArray['TOTAL_GOODSLINE_PALLET_PLACES']);
        $totalLoadingLengthElement->setAttribute('measurementUnitCode', 'PP');
        $cargoCharacteristicsElement->appendChild($totalLoadingLengthElement);

        // Create the <totalLoadingLength> element and set its value and attribute
        $totalLoadingLengthElement2 = $dom->createElement('totalLoadingLength', $dataArray['TOTAL_GOODSLINE_LOADING_LENGTH']);
        $totalLoadingLengthElement2->setAttribute('measurementUnitCode', 'MTR');
        $cargoCharacteristicsElement->appendChild($totalLoadingLengthElement2);

        // Create the <totalPackageQuantity> element and set its value and attribute
        $totalPackageQuantityElement = $dom->createElement('totalPackageQuantity', $dataArray['GOODSLINE_PACKAGE_QUANTITY']);
        $totalPackageQuantityElement->setAttribute('measurementUnitCode', $dataArray['GOODSLINE_PACKAGE_TYPE']);
        $cargoCharacteristicsElement->appendChild($totalPackageQuantityElement);

        // Create the <totalItemQuantity> element and set its value and attribute
        $totalItemQuantityElement = $dom->createElement('totalItemQuantity', $dataArray['GOODSLINE_TRANSPORT_UNIT_QUANTITY']);
        $totalItemQuantityElement->setAttribute('measurementUnitCode', $dataArray['GOODSLINE_TRANSPORT_UNIT_TYPE']);
        $cargoCharacteristicsElement->appendChild($totalItemQuantityElement);

        // Create other elements (ADR) here...

        // Save XML as a string
        $root->appendChild($transportInstruction);

        return $dom->saveXML();
    }

    public function getFilesXML($dataArray)
    {
        $dom = new DOMDocument('1.0', 'UTF-8');

        // Create the root element (Envelope) with namespaces
        $envelope = $dom->createElementNS('http://schemas.xmlsoap.org/soap/envelope/', 'soapenv:Envelope');
        $envelope->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:tms', 'urn:CDM/tmsIntegrationService/');
        $envelope->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:stan', 'http://www.unece.org/cefact/namespaces/StandardBusinessDocumentHeader');

        // Create the Header element
        $header = $dom->createElement('soapenv:Header');

        // Create the Security element
        $security = $dom->createElementNS('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd', 'wsse:Security');
        $security->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:wsse', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd');
        $security->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:wsu', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd');

        // Create the UsernameToken element
        $usernameToken = $dom->createElement('wsse:UsernameToken');
        $usernameToken->setAttribute('wsu:Id', 'UsernameToken-E3FC06748A2AA26ADC14643444835251');

        // Create the Username element
        $username = $dom->createElement('wsse:Username', $this->login);
        $usernameToken->appendChild($username);

        // Create the Password element
        $password = $dom->createElement('wsse:Password', $this->password);
        $password->setAttribute('Type', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText');
        $usernameToken->appendChild($password);

        // Append the UsernameToken to the Security element
        $security->appendChild($usernameToken);

        // Append the Security element to the Header element
        $header->appendChild($security);

        // Append the Header element to the Envelope element
        $envelope->appendChild($header);

        // Create the Body element
        $body = $dom->createElement('soapenv:Body');

        // Create the transportDocumentRequestMessage element
        $transportDocumentRequestMessage = $dom->createElement('ns13:transportDocumentRequestMessage');
        $transportDocumentRequestMessage->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:ns13', 'urn:CDM/tmsIntegrationService/');

        // Create the StandardBusinessDocumentHeader element
        $standardBusinessDocumentHeader = $dom->createElement('StandardBusinessDocumentHeader');
        $standardBusinessDocumentHeader->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns', 'http://www.unece.org/cefact/namespaces/StandardBusinessDocumentHeader');

        // Create the HeaderVersion element
        $headerVersion = $dom->createElement('HeaderVersion', '1');
        $standardBusinessDocumentHeader->appendChild($headerVersion);

        // Create the Sender element
        $sender = $dom->createElement('Sender');
        $identifierSender = $dom->createElement('Identifier', $dataArray['EDI_SENDER']);
        $sender->appendChild($identifierSender);
        $standardBusinessDocumentHeader->appendChild($sender);

        // Create the Receiver element
        $receiver = $dom->createElement('Receiver');
        $identifierReceiver = $dom->createElement('Identifier', $dataArray['EDI_RECEIVER']);
        $receiver->appendChild($identifierReceiver);
        $standardBusinessDocumentHeader->appendChild($receiver);

        // Create the DocumentIdentification element
        $documentIdentification = $dom->createElement('DocumentIdentification');
        $standard = $dom->createElement('Standard', 'GS1');
        $typeVersion = $dom->createElement('TypeVersion', '3.2');
        $instanceIdentifier = $dom->createElement('InstanceIdentifier', '100002');
        $type = $dom->createElement('Type', 'Transport Instruction');

        // created_at from database
        $creationDateAndTime = $dom->createElement('CreationDateAndTime', $dataArray['EDI_FILE_CREATION_TIMESTAMP']);
        $documentIdentification->appendChild($standard);
        $documentIdentification->appendChild($typeVersion);
        $documentIdentification->appendChild($instanceIdentifier);
        $documentIdentification->appendChild($type);
        $documentIdentification->appendChild($creationDateAndTime);
        $standardBusinessDocumentHeader->appendChild($documentIdentification);

        // Create the BusinessScope element
        $businessScope = $dom->createElement('BusinessScope');

        // Create the Scope elements
        $scope1 = $dom->createElement('Scope');
        $scopeType1 = $dom->createElement('Type', 'EDIcustomerNumber');
        $scopeInstanceIdentifier1 = $dom->createElement('InstanceIdentifier', '90000050');
        $scope1->appendChild($scopeType1);
        $scope1->appendChild($scopeInstanceIdentifier1);
        $businessScope->appendChild($scope1);

        $scope2 = $dom->createElement('Scope');
        $scopeType2 = $dom->createElement('Type', 'fileType');
        $scopeInstanceIdentifier2 = $dom->createElement('InstanceIdentifier', 'NF');
        $scope2->appendChild($scopeType2);
        $scope2->appendChild($scopeInstanceIdentifier2);
        $businessScope->appendChild($scope2);

        $scope3 = $dom->createElement('Scope');
        $scopeType3 = $dom->createElement('Type', 'department');
        $scopeInstanceIdentifier3 = $dom->createElement('InstanceIdentifier', $dataArray['RABEN_DEPARTMENT']);
        $scope3->appendChild($scopeType3);
        $scope3->appendChild($scopeInstanceIdentifier3);
        $businessScope->appendChild($scope3);

        $scope4 = $dom->createElement('Scope');
        $scopeType4 = $dom->createElement('Type', 'application');
        $scopeInstanceIdentifier4 = $dom->createElement('InstanceIdentifier', 'INT');
        $scope4->appendChild($scopeType4);
        $scope4->appendChild($scopeInstanceIdentifier4);
        $businessScope->appendChild($scope4);

        $standardBusinessDocumentHeader->appendChild($businessScope);

        $transportDocumentRequestMessage->appendChild($standardBusinessDocumentHeader);

        // Create the transportDocumentRequest element
        $transportDocumentRequest = $dom->createElement('transportDocumentRequest');

        // Create the creationDateTime element
        $creationDateTime = $dom->createElement('creationDateTime', $dataArray['EDI_FILE_CREATION_TIMESTAMP']);
        $transportDocumentRequest->appendChild($creationDateTime);

        // Create the documentStatusCode element
        $documentStatusCode = $dom->createElement('documentStatusCode', 'ADDITIONAL_TRANSMISSION');
        $transportDocumentRequest->appendChild($documentStatusCode);

        // Create the documentActionCode element
        $documentActionCode = $dom->createElement('documentActionCode', 'GET_DOC_PDF');
        $transportDocumentRequest->appendChild($documentActionCode);

        // Create the transportDocumentRequestIdentification element
        $transportDocumentRequestIdentification = $dom->createElement('transportDocumentRequestIdentification');

        // Create the entityIdentification element
        $entityIdentification = $dom->createElement('entityIdentification', $dataArray['EDI_REFERENCE_NUMBER']);
        $transportDocumentRequestIdentification->appendChild($entityIdentification);

        // Create the contentOwner element
        $contentOwner = $dom->createElement('contentOwner');

        // Create the additionalPartyIdentification element
        $additionalPartyIdentification = $dom->createElement('additionalPartyIdentification');
        $additionalPartyIdentification->setAttribute('additionalPartyIdentificationTypeCode', 'searchname');
        $additionalPartyIdentification->nodeValue = $dataArray['EDI_SENDER'];
        $contentOwner->appendChild($additionalPartyIdentification);

        $transportDocumentRequestIdentification->appendChild($contentOwner);
        $transportDocumentRequest->appendChild($transportDocumentRequestIdentification);

        // Create the transportDocumentInformationCode element
        $transportDocumentInformationCode = $dom->createElement('transportDocumentInformationCode', 'LABELS');
        $transportDocumentRequest->appendChild($transportDocumentInformationCode);

        // Create the transportDocumentObjectCode element
        $transportDocumentObjectCode = $dom->createElement('transportDocumentObjectCode', 'INLINE');
        $transportDocumentRequest->appendChild($transportDocumentObjectCode);

        // Create the transportDocumentRequestShipment element
        $transportDocumentRequestShipment = $dom->createElement('transportDocumentRequestShipment');

        // Create the additionalShipmentIdentification element
        $additionalShipmentIdentification = $dom->createElement('additionalShipmentIdentification');
        $additionalShipmentIdentification->setAttribute('additionalShipmentIdentificationTypeCode', 'refopd');
        $additionalShipmentIdentification->nodeValue = $dataArray['SHIPMENT_REFERENCE_NUMBER'];
        $transportDocumentRequestShipment->appendChild($additionalShipmentIdentification);

        $transportDocumentRequest->appendChild($transportDocumentRequestShipment);
        $transportDocumentRequestMessage->appendChild($transportDocumentRequest);
        $body->appendChild($transportDocumentRequestMessage);
        $envelope->appendChild($body);
        $dom->appendChild($envelope);

        // Output the XML
        $dom->formatOutput = true;
        return $dom->saveXML();
    }

    public function getStatusCodeXML($dataArray)
    {
        $dom = new DOMDocument('1.0', 'UTF-8');

        // Create root element: soapenv:Envelope
        $envelope = $dom->createElementNS('http://schemas.xmlsoap.org/soap/envelope/', 'soapenv:Envelope');
        $envelope->setAttribute('xmlns:tms', 'urn:CDM/tmsIntegrationService/');
        $envelope->setAttribute('xmlns:stan', 'http://www.unece.org/cefact/namespaces/StandardBusinessDocumentHeader');
        $envelope->setAttribute('xmlns:wsse', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd');
        $dom->appendChild($envelope);

        // Add soapenv:Header element
        $header = $dom->createElement('soapenv:Header');
        $envelope->appendChild($header);

        // Add wsse:Security element
        $security = $dom->createElement('wsse:Security');
        $security->setAttribute('xmlns:wsu', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd');
        $header->appendChild($security);

        // Add wsse:UsernameToken element
        $usernameToken = $dom->createElement('wsse:UsernameToken');
        $usernameToken->setAttribute('wsu:Id', 'UsernameToken-E3FC06748A2AA26ADC14643444835251');
        $security->appendChild($usernameToken);

        // Add wsse:Username element
        $username = $dom->createElement('wsse:Username', $this->login);
        $usernameToken->appendChild($username);

        // Add wsse:Password element
        $password = $dom->createElement('wsse:Password', $this->password);
        $password->setAttribute('Type', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText');
        $usernameToken->appendChild($password);

        // Add soapenv:Body element
        $body = $dom->createElement('soapenv:Body');
        $envelope->appendChild($body);

        // Add ns13:transportStatusRequestMessage element
        $transportStatusRequestMessage = $dom->createElement('ns13:transportStatusRequestMessage');
        $transportStatusRequestMessage->setAttribute('xmlns:ns13', 'urn:CDM/tmsIntegrationService/');
        $body->appendChild($transportStatusRequestMessage);

        // Add StandardBusinessDocumentHeader element
        $standardBusinessDocumentHeader = $dom->createElement('StandardBusinessDocumentHeader');
        $standardBusinessDocumentHeader->setAttribute('xmlns', 'http://www.unece.org/cefact/namespaces/StandardBusinessDocumentHeader');
        $transportStatusRequestMessage->appendChild($standardBusinessDocumentHeader);

        // Add child elements to StandardBusinessDocumentHeader
        $standardBusinessDocumentHeader->appendChild($dom->createElement('HeaderVersion', '1'));

        $sender = $dom->createElement('Sender');
        $sender->appendChild($dom->createElement('Identifier', $dataArray['EDI_SENDER']));
        $standardBusinessDocumentHeader->appendChild($sender);

        $receiver = $dom->createElement('Receiver');
        $receiver->appendChild($dom->createElement('Identifier', $dataArray['EDI_RECEIVER']));
        $standardBusinessDocumentHeader->appendChild($receiver);

        $documentIdentification = $dom->createElement('DocumentIdentification');
        $documentIdentification->appendChild($dom->createElement('Standard', 'GS1'));
        $documentIdentification->appendChild($dom->createElement('TypeVersion', '3.2'));
        $documentIdentification->appendChild($dom->createElement('InstanceIdentifier', '100002'));
        $documentIdentification->appendChild($dom->createElement('Type', 'Transport Instruction'));
        $documentIdentification->appendChild($dom->createElement('CreationDateAndTime', $dataArray['EDI_FILE_CREATION_TIMESTAMP']));
        $standardBusinessDocumentHeader->appendChild($documentIdentification);

        $businessScope = $dom->createElement('BusinessScope');
        $standardBusinessDocumentHeader->appendChild($businessScope);

        $scope1 = $dom->createElement('Scope');
        $scope1->appendChild($dom->createElement('Type', 'EDIcustomerNumber'));
        $scope1->appendChild($dom->createElement('InstanceIdentifier', '90000050'));
        $businessScope->appendChild($scope1);

        $scope2 = $dom->createElement('Scope');
        $scope2->appendChild($dom->createElement('Type', 'fileType'));
        $scope2->appendChild($dom->createElement('InstanceIdentifier', 'NF'));
        $businessScope->appendChild($scope2);

        $scope3 = $dom->createElement('Scope');
        $scope3->appendChild($dom->createElement('Type', 'department'));
        $scope3->appendChild($dom->createElement('InstanceIdentifier', '04'));
        $businessScope->appendChild($scope3);

        $scope4 = $dom->createElement('Scope');
        $scope4->appendChild($dom->createElement('Type', 'application'));
        $scope4->appendChild($dom->createElement('InstanceIdentifier', 'INT'));
        $businessScope->appendChild($scope4);

        // Add transportStatusRequest element
        $transportStatusRequest = $dom->createElement('transportStatusRequest');
        $transportStatusRequestMessage->appendChild($transportStatusRequest);

        $transportStatusRequest->appendChild($dom->createElement('creationDateTime', $dataArray['EDI_FILE_CREATION_TIMESTAMP']));
        $transportStatusRequest->appendChild($dom->createElement('documentStatusCode', 'ADDITIONAL_TRANSMISSION'));

        $transportStatusRequestIdentification = $dom->createElement('transportStatusRequestIdentification');
        $transportStatusRequestIdentification->appendChild($dom->createElement('entityIdentification', $dataArray['EDI_REFERENCE_NUMBER']));
        $transportStatusRequest->appendChild($transportStatusRequestIdentification);

        $transportStatusRequest->appendChild($dom->createElement('transportStatusInformationCode', 'STATUS_ONLY'));
        $transportStatusRequest->appendChild($dom->createElement('transportStatusObjectCode', 'SHIPMENT'));

        $transportStatusRequestor = $dom->createElement('transportStatusRequestor');
        $transportStatusRequest->appendChild($transportStatusRequestor);

        $additionalPartyIdentification = $dom->createElement('additionalPartyIdentification');
        $additionalPartyIdentification->setAttribute('additionalPartyIdentificationTypeCode', 'searchname');
        $additionalPartyIdentification->appendChild($dom->createTextNode($dataArray['EDI_SENDER']));
        $transportStatusRequestor->appendChild($additionalPartyIdentification);

        $transportStatusRequestShipment = $dom->createElement('transportStatusRequestShipment');
        $transportStatusRequest->appendChild($transportStatusRequestShipment);

        $additionalShipmentIdentification = $dom->createElement('additionalShipmentIdentification');
        $additionalShipmentIdentification->setAttribute('additionalShipmentIdentificationTypeCode', 'refopd');
        $additionalShipmentIdentification->appendChild($dom->createTextNode($dataArray['SHIPMENT_REFERENCE_NUMBER']));
        $transportStatusRequestShipment->appendChild($additionalShipmentIdentification);

        // Output XML
        $dom->formatOutput = true;
        $xmlString = $dom->saveXML();

        return $xmlString;
    }
}
