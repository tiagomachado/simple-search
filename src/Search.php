<?php

namespace Src;

use Src\Models\Property;
use Src\Pagination;

/**
 *For this proposal I used:
 *
 * Illuminate/database: The Illuminate Database component
 * is a full database toolkit for PHP (https://github.com/illuminate/database)
 *
 * Illuminate/pagination: Help in the construction
 * of pagination (https://github.com/illuminate/pagination)
 *
 * Class Search
 * @package Src
 */
class Search
{

    /**
     *Simple search where it returns the properties
     *
     * @param $request
     * @return $properties
     */
    public function getProperties($request)
    {
        if (!empty($request)) {

            if ($page = $request['page']) {
                Pagination::setPage($request['page']);
            }

            $properties = (new Property)->newQuery();

            if ($location = $request['location']) {
                $properties->whereHas('location', function ($query) use ($location) {
                    $query->where('location_name', 'LIKE', '%' . $location . '%');
                });
            }

            if (($start = $request['start']) && ($end = $request['end'])) {
                $properties->whereDoesntHave('bookings', function ($query) use ($start, $end) {
                    $query->where(function ($query) use ($start, $end) {
                        $query->whereBetween('start_date', [$start, $end])
                              ->orWhereBetween('end_date', [$start, $end]);
                    });
                });
            }
            if ($sleeps = $request['sleeps']) {
                $properties->where('sleeps', '>=', $sleeps);
            }
            if ($beds = $request['beds']) {
                $properties->where('beds', '>=', $beds);
            }

            if (isset($request['accepet_pets'])) {
                $properties->where('accepet_pets', 1);
            }

            if (isset($request['near_beach'])) {
                $properties->where('near_beach', 1);
            }

            return $properties->paginate(2);
        }
    }
}
