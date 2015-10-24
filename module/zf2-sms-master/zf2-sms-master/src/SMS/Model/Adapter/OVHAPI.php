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
use Zend\Http\Client as Client ;

class OVHAPI extends AdapterAbstract
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
        
        
    $client = new Client();
        $client->setUri($this->prepareUrl($from, $to, $content));
        $client->setMethod('GET');
        $client->setOptions(array(
                         'ssltransport' => 'tls',
                         'sslverify_peer' => false,
                         'sslcapath' => '/etc/ssl/certs'
                                                        ));
        $response = $client->send($client->getRequest());
        $responsejson = json_decode($response->getContent());

        if($responsejson->status != 100)
        {
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
        
        $format = "%s?account=%s&login=%s&password=%s&from=%s&to=%s&message=%s&contentType=application/json";
        return sprintf(
            $format,
            $config['ovhapi']['url'],
        	$config['ovhapi']['account'],
            $config['ovhapi']['username'],
            $config['ovhapi']['password'],
        	$config['ovhapi']['from'],
        	$to,
        	$content
       				);
    }
}