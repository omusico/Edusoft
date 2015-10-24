<?php
/**
 * @author lucas.wawrzyniak
 * @copyright Copyright (c) 2013 Lucas Wawrzyniak
 * @licence New BSD License
 */

namespace SMS\Model;

class Number
{
    /**
     * @var string
     */
    protected $countryPrefix;

    /**
     * @var string
     */
    protected $localNumber;

    /**
     * @param $countryPrefix string
     * @return \SMS\Model\Number
     */
    public function setCountryPrefix($countryPrefix)
    {
        $this->countryPrefix = $countryPrefix;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryPrefix()
    {
        return $this->countryPrefix;
    }

    /**
     * @param $localNumber
     * @return \SMS\Model\Number
     */
    public function setLocalNumber($localNumber)
    {
        $this->localNumber = $localNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocalNumber()
    {
        return $this->localNumber;
    }

    /**
     * @param $countryPrefix string
     * @param $localNumber string
     */
    public function __construct($countryPrefix, $localNumber)
    {
        $this->setCountryPrefix($countryPrefix);
        $this->setLocalNumber($localNumber);
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->countryPrefix . $this->localNumber;
    }
}