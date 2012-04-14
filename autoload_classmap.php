<?php
/**
 * autoload_classmap
 * 
 * @file: autoload_classmap.php
 * @author: Komang Arthayasa <komang@fogitive.com>
 */

return array(
    'Restful\Module' => __DIR__ . '/Module.php',
    'Restful\Response\Dispatcher' => __DIR__ . '/src/Restful/Response/Dispatcher.php',
    'Restful\Serializer\Adapter\Xml' => __DIR__ . '/src/Restful/Serializer/Adapter/Xml.php',
    'Restful\Controller\IndexController'  => __DIR__ . '/src/Restful/Controller/IndexController.php',
    'XML_Serializer' => __DIR__ .'/src/PEAR/XML/Serializer.php',
);