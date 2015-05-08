<?php
namespace gb\domain;

require_once( "gb/domain/DomainObject.php" );

class Port extends DomainObject {
      
    private $port_code;
    private $port_name;
    private $tax;
    private $longitude;
    private $latitude;
    private $time_zone;
    private $dst_zone;
    private $country_id;

    function __construct( $id=null ) {
        //$this->name = $name;
        parent::__construct( $id );
    }
        
    function setPortCode ( $port_code ) {
        $this->port_code = $port_code;
    }
    
    function getPortCode () {
        return $this->port_code;
    }
    
    function setPortName ($port_name) {
        $this->port_name = $port_name;
    }
    
    function getPortName() {
        return $this->port_name;
    }
    
    function setTax ($tax) {
        $this->tax = $tax;
    }
    
    function getTax () {
        return $this->tax;
    }

    function setLongitude ($longitude) {
        $this->longitude = $longitude;
    }

    function getLongitude () {
        return $this->longitude;
    }

    function setLatitude ($latitude) {
        $this->latitude = $latitude;
    }

    function getLatitude () {
        return $this->latitude;
    }

    function setTimeZone ($time_zone) {
        $this->time_zone = $time_zone;
    }

    function getTimeZone () {
        return $this->time_zone;
    }

    function setDstZone ($dst_zone) {
        $this->tax = $dst_zone;
    }

    function getDstZone () {
        return $this->dst_zone;
    }

    function setCountryId ($country_id) {
        $this->country_id = $country_id;
    }

    function getCountryId () {
        return $this->country_id;
    }

}

?>
