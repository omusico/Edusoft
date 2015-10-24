<?php
/**
 * @author lucas.wawrzyniak
 * @copyright Copyright (c) 2013 Lucas Wawrzyniak
 * @licence New BSD License
 */

namespace SMS\Model\Adapter;

use \Zend\EventManager\EventManagerInterface;
use \Zend\EventManager\EventManager;
use \Zend\EventManager\EventManagerAwareInterface;

use \SMS\Model\Number;
use \SMS\Model\Content;

abstract class AdapterAbstract implements AdapterInterface, EventManagerAwareInterface
{
    /**
     * @var \Zend\EventManager\EventManager
     */
    protected $eventManager;

    /**
     * @param EventManagerInterface $events
     * @return \SMS\Model\Adapter\AdapterAbstract|void
     */
    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers(array(
            __CLASS__,
            get_called_class(),
        ));
        $this->eventManager = $events;
        return $this;
    }

    /**
     * @return EventManager|EventManagerInterface
     */
    public function getEventManager()
    {
        if (null === $this->eventManager) {
            $this->setEventManager(new EventManager());
        }
        return $this->eventManager;
    }

    /**
     * @param \SMS\Model\Number $from
     * @param \SMS\Model\Number $to
     * @param \SMS\Model\Content $content
     */
    public function preSend(Number $from, Number $to, Content $content)
    {
        $this->getEventManager()->trigger('SMS.preSend', null, array($from, $to, $content));
    }

    /**
     * @param \SMS\Model\Number $from
     * @param \SMS\Model\Number $to
     * @param \SMS\Model\Content $content
     * @param $result
     */
    public function postSend(Number $from, Number $to, Content $content, $result)
    {
        $this->getEventManager()->trigger('SMS.postSend', null, array($from, $to, $content, $result));
    }
}