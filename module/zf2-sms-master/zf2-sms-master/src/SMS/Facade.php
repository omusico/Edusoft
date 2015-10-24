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

class Facade
{
    /**
     * @var \SMS\Factory
     */
    protected $factory;

    /**
     * @param \SMS\Factory $factory
     * @return \SMS\Facade
     */
    public function setFactory(Factory $factory)
    {
        $this->factory = $factory;
        return $this;
    }

    /**
     * @return \SMS\Factory
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @param $content string
     * @return \SMS\Model\Content
     */
    public function makeContent($content)
    {
        return $this->factory->makeContent($content);
    }

    /**
     * @param $countryPrefix string
     * @param $localNumber string
     * @return \SMS\Model\Number
     */
    public function makeNumber($countryPrefix, $localNumber)
    {
        return $this->factory->makeNumber($countryPrefix, $localNumber);
    }

    /**
     * @return \SMS\Model\SMS
     */
    public function makeSMSAPI()
    {
        return $this->factory->makeSMSAPI();
    }
    
    /**
     * @return \SMS\Model\SMS
     */
    public function makeOVHAPI()
    {
    	return $this->factory->makeOVHAPI();
    }

    /**
     * @return \SMS\Model\SMS
     */
    public function makeMock()
    {
        return $this->factory->makeMock();
    }
}