<?php

namespace App\Services\Dictionary;

use App\Factories\DictionaryFactory;
use App\Models\Workspace;

class DictionaryService
{
    public function getDictionaryList($dictionaryName)
    {
        if (method_exists(DictionaryFactory::class, $dictionaryName)) {
            $dictionary = call_user_func('App\Factories\DictionaryFactory' . '::' . $dictionaryName, false);

            if (!is_array($dictionary)) {
                if (array_key_exists('id', $_GET)) {
                    return $dictionary->find($_GET['id']);
                }

                if (array_key_exists('query', $_GET)) {
                    return $dictionary->where('name', 'like', '%' . $_GET['query'] . '%')->limit(25)->get();
                }

                return $dictionary->limit(25)->get();
            } else {

                if (array_key_exists('id', $_GET)) {
                    return $dictionary[$_GET['id'] - 1];
                }

                if (array_key_exists('query', $_GET)) {
                    return $this->findElementsBySubstringKey($dictionary, $_GET['query']);
                }

                return $dictionary;
            }
        }
        return null;
    }

    private function findElementsBySubstringKey($array, $substring)
    {
        $matchingElements = [];
        for ($i = 0; $i < count($array); $i++) {
            if (strpos($array[$i]['name'], $substring) !== false) {
                $matchingElements[] = $array[$i];

            }
        }

        return $matchingElements;
    }

}
