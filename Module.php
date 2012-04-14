<?php

/**
 * Module
 * 
 * @file: Module.php
 * @author: Komang Arthayasa <komang@fogitive.com>
 */

namespace Restful {

    use Zend\Module\Manager,
        Zend\EventManager\StaticEventManager,
        Zend\Mvc\MvcEvent,
        Zend\Module\Consumer\AutoloaderProvider;

    class Module implements AutoloaderProvider {

        protected static $options;

        public function init(Manager $moduleManager) {
            $events = StaticEventManager::getInstance();
            $events->attach('Zend\Mvc\Controller\RestfulController','dispatch', array($this, 'onDispatch'), -100);
            $events->attach('Zend\Mvc\Application','dispatch.error', array($this, 'onDispatch'),-100);
        }

        public function getAutoloaderConfig() {
            return array(
                'Zend\Loader\ClassMapAutoloader' => array(
                    __DIR__ . '/autoload_classmap.php',
                ),
                'Zend\Loader\StandardAutoloader' => array(
                    'namespaces' => array(
                        __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                    ),
                ),
            );
        }

        public function getConfig() {
            return include __DIR__ . '/config/module.config.php';
        }

        public function onDispatch(MvcEvent $e) {
            $result = $e->getResult();
            if ($e->isError()) {
                $vars = $result->getVariables();
                $errorId = $vars->offsetGet('reason');
                $errorMessage=$vars->offsetGet('message');
                $content = array(
                    'error' => (is_null($errorId)) ? 'notfound-error' : $errorId,
                    'message' => $errorMessage,
                );
                unset($vars);
            } else {
                $content = array(
                    'content' => (is_array($result)) ? $result : $result->getVariables(),
                );
            }
            $match = $e->getRouteMatch();
            $format = (empty($match)) ? 'json' : strtolower($e->getRouteMatch()->getParam('format'));
            $dispatcher = $e->getTarget()->getLocator()->get('dispatcher');
            return $dispatcher->render($format, $content, $e->getResponse());
        }

    }

}