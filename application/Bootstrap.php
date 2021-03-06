<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected $_docRoot;

	protected function _initPath()
	{
		$this->_docRoot = realpath(APPLICATION_PATH . '/../');
		Zend_Registry::set('docRoot', $this->_docRoot);
	}

	protected function _initLoaderResource()
	{
		$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
				'basePath' => $this->_docRoot . '/application',
				'namespace' => 'Saffron'
			));
		$resourceLoader->addResourceTypes(array(
			'model' => array(
				'namespace' => 'Model',
				'path' => 'models'
			)
		));
	}

	protected function _initLog()
	{
		$writer = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/../data/logs/error.log');
		return new Zend_Log($writer);
	}

	protected function _initView()
	{
		$view = new Zend_View();
		return $view;
	}

	protected function _initUploadDirAndConstant() {

        $uploadPath = '../public/uploads';

        if (!file_exists($uploadPath)) {
            if (!mkdir($uploadPath)) {
                throw new Exception('Cannot make the following directorry: ' . $uploadPath);
            }
        }

        // if $uploadPath was created than define a constant
        defined('UPLOAD_PATH') || define('UPLOAD_PATH', '../public/uploads');
    }


}