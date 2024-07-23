<?php

namespace App\Services\Matches\Repository;

use App\Helpers\GeocodingHelper;
use App\Models\Document;
use App\Models\Match\Consolidation;

class MatchService
{
    public static function reject()
    {

    }

    public static function getConsolidationInfo(Consolidation $consolidation)
    {

    }

    public function getRoutesByPlanningAndTN($transportPlanning, $documentArray)
    {
        $prematchService = new PrematchService();
        $routeArray = [];

        $transportPlanningDocuments = $transportPlanning->documents;

        $documents = Document::find($documentArray);


        foreach ($documents as $document) {
            $routeArray[] = $prematchService->generateRoute($document, 'download', $transportPlanning);
            $routeArray[] = $prematchService->generateRoute($document, 'upload', $transportPlanning);
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
}
