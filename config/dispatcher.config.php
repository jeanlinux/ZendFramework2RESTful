<?php

/**
 * dispatcher.config
 * 
 * @file: dispatcher.config.php
 * @author: Komang Arthayasa <komang@fogitive.com>
 */
return array(
    'sphp' => array(
        'contentType' => 'text/plain',
        'adapter' => '\Zend\Serializer\Adapter\PhpSerialize',
        'options' => array(),
    ),
    'json' => array(
        'contentType' => 'application/json',
        'adapter' => '\Zend\Serializer\Adapter\Json',
        'options' => array(),
    ),
    'xml' => array(
        'contentType' => 'application/xml',
        'adapter' => '\Restful\Serializer\Adapter\Xml',
        'options' => array(
            'typeHints' => true,
            'defaultTagName' => 'item',
            'keyAttribute' => 'itemId',
            'typeAttribute' => 'itemType',
            'rootAttributes' => array(
                'created' => date('Y-m-d H:i:s')
            )
        ),
    ),
);