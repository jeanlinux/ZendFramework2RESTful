<?php

/**
 * Dispatcher Event Callback Handler
 * 
 * @file: Dispatcher.php
 * @author: Komang Arthayasa <komang@fogitive.com>
 */

namespace Restful\Response {

    class Dispatcher {
        
        protected $_options = array(
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
                'options' => array(),
            ),
        );

        public function __construct(array $options = array()) {
            $this->_options = $options + $this->_options;
        }

        public function render($format, array $content,\Zend\Http\Response $response) {
            $adapterClass = $this->_options[$format]['adapter'];
            $contentType = $this->_options[$format]['contentType'];
            $options = $this->_options[$format]['options'];
            
            $response->headers()->addHeaderLine('Content-Type',$contentType);
            
            $adapter = new $adapterClass;
            $response->setContent($adapter->serialize($content,$options));
            
            return $response;
        }
    }

}