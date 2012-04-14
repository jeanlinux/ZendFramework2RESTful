<?php
/**
 * module.config
 * 
 * @file: module.config.php
 * @author: Komang Arthayasa <komang@fogitive.com>
 */

return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                'index' => 'Restful\Controller\IndexController',
                'dispatcher' => 'Restful\Response\Dispatcher',
            ),
            'Restful\Response\Dispatcher' => array(
                'parameters' => array(
                    'options' => include(__DIR__.'/dispatcher.config.php')
                ),
            ),
            'Zend\Mvc\Router\RouteStack' => array(
                'parameters' => array(
                    'routes' => array(
                        'restful' => array(
                            'type' => 'Zend\Mvc\Router\Http\Segment',
                            'options' => array(
                                'route' => '/[:controller[.:format][/:id]]',
                                'constraints' => array(
                                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    'format' => '(xml|json|sphp)',
                                    'id' => '[1-9][0-9]*',
                                ),
                                'defaults' => array(
                                    'controller' => 'Restful\Controller\IndexController',
                                    'format' => 'json',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);