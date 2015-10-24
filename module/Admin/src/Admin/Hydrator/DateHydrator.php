<?php
namespace Admin\Hydrator;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;




class DateHydrator extends DoctrineObject {
    protected function handleTypeConversions($value, $typeOfField) 
    {

        if($typeOfField == 'datetime'){
            return \DateTime::createFromFormat('d/m/Y', $value);
        }

        return parent::handleTypeConversions($value, $typeOfField);
    }
}