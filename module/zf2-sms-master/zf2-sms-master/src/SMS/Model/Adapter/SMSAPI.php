<?php
/**
 * @author lucas.wawrzyniak
 * @copyright Copyright (c) 2013 Lucas Wawrzyniak
 * @licence New BSD License
 */

namespace SMS\Model\Adapter;

use \SMS\Model\Number;
use \SMS\Model\Content;
use \SMS\Facade;
use \SMS\SMSException;

class SMSAPI extends AdapterAbstract
{
    /**
     * @var \SMS\Facade
     */
    protected $facadeSMS;

    /**
     * @param \SMS\Facade $facade
     */
    public function setFacadeSMS(Facade $facade)
    {
        $this->facadeSMS = $facade;
    }

    /**
     * @param \SMS\Model\Number $from
     * @param \SMS\Model\Number $to
     * @param \SMS\Model\Content $content
     * @return bool
     * @throws \SMS\SMSException
     * @throws \Exception
     */
    public function send(Number $from, Number $to, Content $content)
    {
        $file = fopen($this->prepareUrl($from, $to, $content), 'r');
        $response = fread($file, 1024);
        fclose($file);

        if ($response != 'OK') {
            throw new SMSException($response);
        }
        return true;
    }

    /**
     * @param \SMS\Model\Number $from
     * @param \SMS\Model\Number $to
     * @param \SMS\Model\Content $content
     * @return string
     */
    private function prepareUrl(Number $from, Number $to, Content $content)
    {
        $from = urlencode($from->getNumber());
        $to = urlencode($to->getNumber());
        $content = urlencode($content->getContent());

        $config = $this->facadeSMS->getFactory()->getServiceLocator()->get('Config');

        $format = "%s?username=%s&password=%s&to=%s&message=%s&from=%s";
        return sprintf(
            $format,
            $config['smsapi']['url'],
            $config['smsapi']['username'],
            $config['smsapi']['password'],
            $to, $content, $from
        );
    }
}