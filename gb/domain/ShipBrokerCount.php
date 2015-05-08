<?php
namespace gb\domain;

require_once( "gb/domain/DomainObject.php" );

class ShipBrokerCount extends DomainObject {
      
    private $name;
    private $popularity;

    function __construct( $name=null ) {
        //$this->name = $name;
        parent::__construct( $name );
    }
        
    function setName ( $name ) {
        $this->name = $name;        
    }
    
    function getName () {
        return $this->name;
    }

    function setPopularity ($popularity) {
        $this->popularity = $popularity;
    }
    
    function getPopularity () {
        return $this->popularity;
    }
}

?>
