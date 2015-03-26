<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Customer.php" );


class CustomerMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM CUSTOMER where ssn = ?";
        $this->selectAllStmt = "SELECT * FROM CUSTOMER ";   
        $this->selectCityStmt = "SELECT city FROM CUSTOMER GROUP BY city";      
    } 
    
    function getCollection( array $raw ) {
        
        $customerCollection = array();
        foreach($raw as $row) {
            array_push($customerCollection, $this->doCreateObject($row));
        }
        
        return $customerCollection;
    }

    function getCollectionCity( array $raw) {
        $customerCollection = array();
        foreach($raw as $row) {
            array_push($customerCollection,  $row['city']);
        }
        
        return $customerCollection;
    }

    protected function doCreateObject( array $array ) {
        
        $obj = null;        
        if (count($array) > 0) {
            $obj = new \gb\domain\Customer( $array['ssn'] );

            $obj->setSsn($array['ssn']);
            $obj->setNumber($array["number"]);
            $obj->setFirstName($array['first_name']);
            $obj->setLastName($array['last_name']);
            $obj->setStreet($array['street']);
            $obj->setBus($array['bus']);
            $obj->setPostalCode($array['postal_code']);
            $obj->setCity($array['city']);
        } 
        
        return $obj;
    }

    protected function doInsert( \gb\domain\DomainObject $object ) {
        /*$values = array( $object->getName() ); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );*/
    }
    
    function update( \gb\domain\DomainObject $object ) {
        //$values = array( $object->getName(), $object->getId(), $object->getId() ); 
        //$this->updateStmt->execute( $values );
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    
    function selectAllStmt() {
        return $this->selectAllStmt;
    }

    function selectCityStmt() {
        return $this->selectCityStmt; 
    }
    
    function getCustomersInCity ($city) {
        
        $con = $this->getConnectionManager();
        $selectStmt = "SELECT * FROM CUSTOMER where city = ?";
        $cities = $con->executeSelectStatement($selectStmt, array($city));        
        return $this->getCollection($cities);
    }
}


?>
