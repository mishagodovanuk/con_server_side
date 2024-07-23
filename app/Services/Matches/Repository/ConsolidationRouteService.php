<?php

namespace App\Services\Matches\Repository;

use App\Helpers\GeocodingHelper;
use App\Models\Document;
use App\Models\TransportPlanning;
use App\Models\Warehouse;
use DateTime;

class ConsolidationRouteService
{
    public function getRoutesByPlanningAndTN($transportPlanning, $documentArray)
    {
        $routeArray = [];

        $transportPlanningDocuments = $transportPlanning->documents;

        $documents = Document::find($documentArray);


        foreach ($documents as $document) {
            $routeArray[] = $this->generateRoute($document, 'download', $transportPlanning);
            $routeArray[] = $this->generateRoute($document, 'upload', $transportPlanning);
        }

        foreach ($transportPlanningDocuments as $transportPlanningDocument) {
            $routeArray[] = $this->generateRoute($transportPlanningDocument, 'download', $transportPlanning);
            $routeArray[] = $this->generateRoute($transportPlanningDocument, 'upload', $transportPlanning);
        }


        $lastUploadCoordinates = end($routeArray)['coordinates'];

        $sortedArray = array_slice($routeArray, 0, count($routeArray) - 1);
        foreach ($sortedArray as &$route) {
            $distance = GeocodingHelper::haversineDistance(
                json_decode($lastUploadCoordinates, true),
                json_decode($route['coordinates'], true)
            );
            $route['distance'] = $distance;
        }

        usort($sortedArray, static function ($a, $b) {
            return $a['distance'] < $b['distance'];
        });

        $sortedPoints = array_values($sortedArray);
        foreach ($sortedPoints as $key => $sortedPoint) {
            $sortedArray[$key] = $sortedPoint;
        }

        for ($i = 0; $i < count($sortedArray); $i++) {
            $routeArray[$i] = $sortedArray[$i];
        }
        $membersArray = [];
        foreach ($routeArray as $key => &$route) {
            if ($route['type'] == 'download') {
                $elementID = $key - 1;

                if (array_key_exists($elementID, $routeArray)) {
                    $route['current_pallets'] = $route['current_pallets']
                        + $routeArray[$elementID]['current_pallets'];
                    $route['weight'] = $route['weight'] + $routeArray[$elementID]['weight'];
                }

                $membersArray[] = $route['company'];

                $route['members'] = count(array_unique($membersArray));
            } else {
                if (count($membersArray)) {
                    $route['current_pallets'] = $routeArray[$key - 1]['current_pallets'] -
                        $route['self_pallets'];
                    $route['weight'] = $routeArray[$key - 1]['weight'] - $route['self_weight'];
                    $keyToDelete = array_search($route['company'], $membersArray);
                    unset($membersArray[$keyToDelete]);
                    $route['members'] = count(array_unique($membersArray));
                } else {
                    $route['current_pallets'] = -$route['self_pallets'];
                    $route['weight'] = -$route['self_weight'];
                    $route['members'] = 0;
                }
            }
        }

        return $routeArray;
    }

    public function getRoutesByCargoRequest($cargoRequest, $transportPlanningArray)
    {
        $routeArray = [];


        $transportPlannings = TransportPlanning::find($transportPlanningArray);


        $routeArray[] = $this->generateRouteForCargoRequest($cargoRequest, 'download');
        $routeArray[] = $this->generateRouteForCargoRequest($cargoRequest, 'upload');


        foreach ($transportPlannings as $transportPlanning) {
            foreach ($transportPlanning->documents as $transportPlanningDocument) {
                $routeArray[] = $this->generateRoute($transportPlanningDocument, 'download', $transportPlanning);
                $routeArray[] = $this->generateRoute($transportPlanningDocument, 'upload', $transportPlanning);
            }
        }

        $lastUploadCoordinates = end($routeArray)['coordinates'];

        $sortedArray = array_slice($routeArray, 0, count($routeArray) - 1);
        foreach ($sortedArray as &$route) {
            $distance = GeocodingHelper::haversineDistance(
                json_decode($lastUploadCoordinates, true),
                json_decode($route['coordinates'], true)
            );
            $route['distance'] = $distance;
        }

        usort($sortedArray, static function ($a, $b) {
            return $a['distance'] < $b['distance'];
        });

        $sortedPoints = array_values($sortedArray);
        foreach ($sortedPoints as $key => $sortedPoint) {
            $sortedArray[$key] = $sortedPoint;
        }

        for ($i = 0; $i < count($sortedArray); $i++) {
            $routeArray[$i] = $sortedArray[$i];
        }
        $membersArray = [];
        foreach ($routeArray as $key => &$route) {
            if ($route['type'] == 'download') {
                $elementID = $key - 1;

                if (array_key_exists($elementID, $routeArray)) {
                    $route['current_pallets'] = $route['current_pallets']
                        + $routeArray[$elementID]['current_pallets'];
                    $route['weight'] = $route['weight'] + $routeArray[$elementID]['weight'];
                }

                $membersArray[] = $route['company'];

                $route['members'] = count(array_unique($membersArray));
            } else {
                if (count($membersArray)) {
                    $route['current_pallets'] = $routeArray[$key - 1]['current_pallets'] -
                        $route['self_pallets'];
                    $route['weight'] = $routeArray[$key - 1]['weight'] - $route['self_weight'];
                    $keyToDelete = array_search($route['company'], $membersArray);
                    unset($membersArray[$keyToDelete]);
                    $route['members'] = count(array_unique($membersArray));
                } else {
                    $route['current_pallets'] = -$route['self_pallets'];
                    $route['weight'] = -$route['self_weight'];
                    $route['members'] = 0;
                }
            }
        }
        dd($routeArray);
        return $routeArray;
    }

    public function generateRoute($document, $type, $transportPlanning): array
    {
        $documentDataArray = $document->allBlocksToArray();
        $dataFields = (new TransportPlanning())->getFieldsByType($document->documentType->key);

        $downloadOrUnloadDate = $type === 'download' ?
            $dataFields['loadingDate'] : $dataFields['unloadingDate'];
        $downloadOrUnloadWarehouseField = $type === 'download' ?
            $dataFields['loadingWarehouseField'] : $dataFields['unloadingWarehouseField'];

        $uploadTime1 = DateTime::createFromFormat('H:i', $documentDataArray['header'][$downloadOrUnloadDate][1]);
        $uploadTime2 = DateTime::createFromFormat('H:i', $documentDataArray['header'][$downloadOrUnloadDate][2]);
        $uploadTime = $uploadTime1->diff($uploadTime2);
        $time = $uploadTime->h * 60 + $uploadTime->i;

        $date = DateTime::createFromFormat('Y-m-d', $documentDataArray['header'][$downloadOrUnloadDate][0]);
        $startTime = $documentDataArray['header'][$dataFields['unloadingDate']][1];
        $endTime = $documentDataArray['header'][$dataFields['unloadingDate']][2];
        $uploadWarehouse = Warehouse::find($documentDataArray['header_ids'][$downloadOrUnloadWarehouseField . '_id']);

        $palletsCount = 0;
        $weight = 0;
        foreach ($document->goods as $item) {
            $palletsCount += (int)json_decode($item->getOriginal('pivot_data'),
                true)['1text_field_1'];
            $weight += ($item->packages[0]->weight_brutto * $item->getOriginal('pivot_count'));
        }

        return [
            'company' => $documentDataArray['header']['1select_field_1'],
            'type' => $type,
            'coordinates' => $uploadWarehouse->coordinates,
            'time_from' => $documentDataArray['header'][$downloadOrUnloadDate][1],
            'time_to' => $documentDataArray['header'][$downloadOrUnloadDate][2],
            'time' => $time,
            "time_range" => $date->format('d.m.Y') . ' ' . $startTime . '-' . $endTime,
            'warehouse_city_or_name' => $uploadWarehouse->address->settlement?->name ?? $uploadWarehouse->name,
            'warehouse_address' => $this->generateWarehouseAddress($uploadWarehouse),
            'current_pallets' => $palletsCount,
            'common_pallets' => $transportPlanning->transport->capacity_eu ?? $transportPlanning->transport->equipment?->capacity_eu,
            'weight' => round($weight),
            'self_weight' => $weight,
            'self_pallets' => $palletsCount,
            'common_weight' => $transportPlanning->transport?->carrying_capacity ?
                $transportPlanning->transport?->carrying_capacity * 1000 :
                $transportPlanning->additional_equipment?->carrying_capacity * 1000
        ];
    }

    public function generateRouteForCargoRequest($document, $type)
    {
        $documentDataArray = $document->allBlocksToArray();

        if ($type == 'download') {
            $dataFields = [
                'date' => '10dateTimeRange_field_10',
                'settlement' => '6select_field_6',
                'radius' => '12text_field_12'
            ];
        } else {
            $dataFields = [
                'date' => '11dateTimeRange_field_11',
                'settlement' => '7select_field_7',
                'radius' => '13text_field_13'
            ];
        }

        $dataFields['company'] = '1select_field_1';

        $downloadTime1 = DateTime::createFromFormat('H:i', $documentDataArray['header'][$dataFields['date']][1]);
        $downloadTime2 = DateTime::createFromFormat('H:i', $documentDataArray['header'][$dataFields['date']][2]);
        $downloadTime = $downloadTime1->diff($downloadTime2);
        $date = DateTime::createFromFormat('Y-m-d', $documentDataArray['header'][$dataFields['date']][0]);
        $startTime = $documentDataArray['header'][$dataFields['date']][1];
        $endTime = $documentDataArray['header'][$dataFields['date']][2];

        $settlement = $documentDataArray['header'][$dataFields['settlement']];

        $data = [
            'company' => $documentDataArray['header'][$dataFields['company']],
            'type' => $type,
            'time_from' => $documentDataArray['header'][$dataFields['date']][1],
            'time_to' => $documentDataArray['header'][$dataFields['date']][2],
            'time' => $downloadTime->h * 60 + $downloadTime->i,
            'coordinates' => json_encode(GeocodingHelper::getCoordinates($settlement)),
            "time_range" => $date->format('d.m.Y') . ' ' . $startTime . '-' . $endTime,
            "settlement" => $settlement,
            'radius' => $documentDataArray['header'][$dataFields['radius']],
        ];


        return $data;
    }


    private function generateWarehouseAddress(Warehouse $warehouse): string
    {
        return $warehouse->address->settlement?->name ?
            $warehouse->address()->addFullAddress()->first()->full_address : $warehouse->address->comment;
    }
}
