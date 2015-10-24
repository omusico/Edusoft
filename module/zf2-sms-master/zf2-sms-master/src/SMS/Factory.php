<?php
/**
 * @author lucas.wawrzyniak
 * @copyright Copyright (c) 2013 Lucas Wawrzyniak
 * @licence New BSD License
 */

namespace SMS;

use SMS\Model\Content;
use SMS\Model\Number;
use SMS\Model\SMS;
use SMS\Facade;
use SMS\Model\Adapter\SMSAPI;
use SMS\Model\Adapter\OVHAPI;
use SMS\Model\Adapter\Mock;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Factory implements ServiceLocatorAwareInterface
{
    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $serviceLocator;

    /**
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    /**
     * @return \SMS\Facade
     */
    public function getFacadeSMS() {
        $facade = new Facade();
        $facade->setFactory($this);

        return $facade;
    }

    /**
     * @param $content string
     * @return \SMS\Model\Content
     */
    public function makeContent($content)
    {
        $content = new Content($content);
        return $content;
    }

    /**
     * @param $countryPrefix string
     * @param $localNumber string
     * @return \SMS\Model\Number
     */
    public function makeNumber($countryPrefix, $localNumber)
    {
        $number = new Number($countryPrefix, $localNumber);
        return $number;
    }

    /**
     * @return \SMS\Model\SMS
     */
    public function makeSMSAPI()
    {
        $adapter = new SMSAPI();
        $adapter->setFacadeSMS($this->getFacadeSMS());

        $sms = new SMS();
        $sms->setAdapter($adapter);

        return $sms;
    }
    
    /**
     * @return \SMS\Model\SMS
     */
    public function makeOVHAPI()
    {
    	$adapter = new OVHAPI();
    	$adapter->setFacadeSMS($this->getFacadeSMS());
    
    	$sms = new SMS();
    	$sms->setAdapter($adapter);
    
    	return $sms;
    }
    
    

    /**
     * @return \SMS\Model\SMS
     */
    public function makeMock()
    {
        $adapter = new Mock();
        $adapter->setFacadeSMS($this->getFacadeSMS());

        $sms = new SMS();
        $sms->setAdapter($adapter);

        return $sms;
    }
}