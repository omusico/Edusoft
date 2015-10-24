<?php
/**
 * @author lucas.wawrzyniak
 * @copyright Copyright (c) 2013 Lucas Wawrzyniak
 * @licence New BSD License
 */

namespace SMS\Model;

class Content
{
    protected $content;

    /**
     * @param $content string
     * @return \SMS\Model\Content
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param $content
     */
    public function __construct($content)
    {
        $this->setContent($content);
    }

    /**
     * @return boolean
     */
    public function isEmpty()
    {
        return (empty($this->content)) ? true : false;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return mb_strlen($this->content);
    }
}