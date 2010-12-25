<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }

	protected function _initFrontController()
    {
        $frontController = Zend_Controller_Front::getInstance();
        $frontController->setControllerDirectory(APPLICATION_PATH .'/controllers');
        $frontController->setParam('env', APPLICATION_ENV);
        //$frontController->setParam('config',$this->_config);
        $frontController->setRequest(new Zend_Controller_Request_Http());
        // action helpers
        Zend_Controller_Action_HelperBroker::addPath(APPLICATION_PATH .'/controllers/helpers');
        $actionStack = Zend_Controller_Action_HelperBroker::getStaticHelper('actionStack');
        $actionStack->actionToStack('zoneHeaderOut','zone');
        $actionStack->actionToStack('navigation','global');
        $actionStack->actionToStack('banner','global',''/*, array("test" => "toto")*/);
		$actionStack->actionToStack('zoneHeaderIn','zone');
//        Zend_Debug::dump($actionStack);
    }

    public function run()
    {
        $frontController = Zend_Controller_Front::getInstance();
        $frontController->dispatch();
    }

}

