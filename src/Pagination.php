<?php

namespace Src;

use Illuminate\Pagination\Paginator;

class Pagination
{
    /**
     * Get the URL for a given page.
     */
    public static function getUrlPage()
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        return ( preg_replace('/&?page=[0-9]+&?/', '', $actual_link));

    }

    /**
     * Set the current page
     * @param $currentPage
     */
    public static function setPage($currentPage)
    {
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
    }
}
