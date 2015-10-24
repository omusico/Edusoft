<?php
/**
 * @author lucas.wawrzyniak
 * @copyright Copyright (c) 2013 Lucas Wawrzyniak
 * @licence New BSD License
 */

namespace SMS\Model;

use \SMS\Model\Adapter\AdapterInterface;
use \SMS\Model\Content;
use \SMS\Model\Number;
use \SMS\SMSException;

class SMS
{
    /**
     * @var \SMS\Model\Number
     */
    protected $from;

    /**
     * @var \SMS\Model\Number
     */
    protected $to;

    /**
     * @var \SMS\Model\Content
     */
    protected $content;

    /**
     * @var \SMS\Model\Adapter\AdapterInterface
     */
    protected $adapter;

    /**
     * @var bool
     */
    protected $result;

    /**
     * @param \SMS\Model\Adapter\AdapterInterface $adapter
     * @return \SMS\Model\SMS
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * @return \SMS\Model\Adapter\AdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param \SMS\Model\Content $content
     * @return \SMS\Model\SMS
     */
    public function setContent(Content $content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return \SMS\Model\Content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param \SMS\Model\Number $from
     * @return \SMS\Model\SMS
     */
    public function setFrom(Number $from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return \SMS\Model\Number
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return bool
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param \SMS\Model\Number $to
     * @return \SMS\Model\SMS
     */
    public function setTo(Number $to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return \SMS\Model\Number
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return bool
     * @throws \SMS\SMSException
     * @throws \Exception
     */
    public function send()
    {
        if (empty($this->adapter)) {
            throw new SMSException('Adapter not set');
        }

        $this->adapter->preSend($this->from, $this->to, $this->content);
        $this->result = $this->adapter->send($this->from, $this->to, $this->content);
        $this->adapter->postSend($this->from, $this->to, $this->content, $this->result);

        return $this->result;
    }
}