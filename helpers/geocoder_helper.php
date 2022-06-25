<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Geocoder
// 
// This method returns an object that has the latitude and longitude of an address.
// The information is retrieved from Google Maps.

class GeoInfo {
    public $lat;
    public $long;
}

function Geocoder($address)
{
    $geocode = @file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=false');

    $output = json_decode($geocode);

    $info = new GeoInfo();

    if( $output->status == 'OK' ) {
        $info->lat  = $output->results[0]->geometry->location->lat;
        $info->long = $output->results[0]->geometry->location->lng;
    } else {
        $info->lat  = 0;
        $info->long = 0;
    }

    return $info;
}

/* End of file geocoder_helper.php */
/* Location: ./application/helpers/geocoder_helper.php */