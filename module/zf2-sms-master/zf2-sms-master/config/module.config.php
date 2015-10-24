<?php
/**
 * @author lucas.wawrzyniak
 * @copyright Copyright (c) 2013 Lucas Wawrzyniak
 * @licence New BSD License
 */
return array(
    'service_manager' => array(
        'factories' => array(
            'SMS\Factory' => function (\Zend\ServiceManager\ServiceManager $sm) {
                $factory = new \SMS\Factory();
                return $factory;
            },
        ),
    ),
);