<?php

namespace Src\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Property extends Eloquent
{
    /**
     * Get the Location for the Property.
     */
    public function location()
    {
        return $this->belongsTo('Src\Models\Location', '_fk_location', '__pk');
    }

    /**
     * Get all of the bookings for the location.
     */
    public function bookings()
    {
        return $this->hasMany('Src\Models\Booking', '_fk_property', '__pk');
    }
}
