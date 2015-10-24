<?php
/**
 * @author lucas.wawrzyniak
 * @copyright Copyright (c) 2013 Lucas Wawrzyniak
 * @licence New BSD License
 */

namespace SMS\Model\Adapter;

use \SMS\Model\Number;
use \SMS\Model\Content;

interface AdapterInterface
{
    public function preSend(Number $from, Number $to, Content $content);
    public function send(Number $from, Number $to, Content $content);
    public function postSend(Number $from, Number $to, Content $content, $result);
}