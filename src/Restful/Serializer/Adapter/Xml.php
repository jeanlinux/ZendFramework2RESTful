<?php
/**
 * XML serializer adapter uses PEAR XML Serializer/Unserializer
 * 
 * @file: Xml.php
 * @author: Komang Arthayasa <komang@fogitive.com>
 */

namespace Restful\Serializer\Adapter;

use Zend\Serializer\Adapter\AbstractAdapter,
    Zend\Serializer\Exception\InvalidArgumentException,
    Zend\Serializer\Exception\RuntimeException;

class Xml extends AbstractAdapter {

    protected $_options = array(
        'rootName' => 'response', 
        'encoding' => 'UTF-8'
    );

    public function serialize($value, array $opts = array()) {
        $opts = $opts + $this->_options;
        try {
            $PearXmlSerializer = new \XML_Serializer;
            if ($PearXmlSerializer->serialize($value,$opts)) {
                return $PearXmlSerializer->getSerializedData();
            } 
            else {
                throw new RuntimeException('Serialization failed', 0, $e);
            }
        } catch (\InvalidArgumentException $e) {
            throw new InvalidArgumentException('Serialization failed: ' . $e->getMessage(), 0, $e);
        } catch (\Exception $e) {
            throw new RuntimeException('Serialization failed: ' . $e->getMessage(), 0, $e);
        }
    }

    public function unserialize($xml, array $opts = array()) {
        $opts = $opts + $this->_options;
        try {
            $PearXmlSerializer = new \XML_Unserializer;
            if ($PearXmlSerializer->unserialize($xml,$opts)) {
                return $PearXmlSerializer->getUnserializedData();
            } 
            else {
                throw new RuntimeException('unserialization failed', 0, $e);
            }
        } catch (\InvalidArgumentException $e) {
            throw new InvalidArgumentException('unserialization failed: ' . $e->getMessage(), 0, $e);
        } catch (\Exception $e) {
            throw new RuntimeException('unserialization failed: ' . $e->getMessage(), 0, $e);
        }
    }

}