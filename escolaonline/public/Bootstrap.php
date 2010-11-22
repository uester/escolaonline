<?php
set_include_path ('.' 
	. PATH_SEPARATOR . 
	'./' 
	. PATH_SEPARATOR . 
	'../library' 
	. PATH_SEPARATOR . 
	'../library/uson/form' 
	. PATH_SEPARATOR . 
	'../application/default/models' 
	. PATH_SEPARATOR . 
	'../application' 
	. PATH_SEPARATOR . 
	get_include_path ());

require_once 'Zend/Loader.php';

class Bootstrap {
	
	public static $frontController = null;
	public static $root = '';
	public static $registry = null;
	
	public static function run() {
		self::prepare ();
		$response = self::$frontController->dispatch ();
		self::sendResponse ( $response );
	}
	
	public static function setupEnvironment() {
		error_reporting ( E_ALL | E_STRICT );
		ini_set ( 'display_errors', true );
		date_default_timezone_set ( 'America/Sao_Paulo' );
		self::$root = "../";
	}
	
	public static function prepare() {
		self::setupEnvironment ();
		Zend_Loader::registerAutoload ();
		self::setupRegistry ();
		self::setupConfiguration ();
		self::setupFrontController ();
		self::setupView ();
		self::setupDatabase ();
	}
	
	public static function setupFrontController() {
		self::$frontController = Zend_Controller_Front::getInstance ();
		self::$frontController->throwExceptions ( true );
		self::$frontController->returnResponse ( true );
		self::$frontController->setControllerDirectory ( 
			array ('default' => self::$root . 'application/default/controllers'));
	}
	
	public static function setupView() {
		$view = new Zend_View ( );
		$view->setEncoding ( 'UTF-8' );
		Zend_Layout::startMvc ( 
			array ('layoutPath' => self::$root . 'application/default/views/layouts', 
		'layout' => 'layout' ));
		$registry = Zend_Registry::getInstance();
		$registry->set('view',$view);
	}
	
	public static function sendResponse(Zend_Controller_Response_Http $response) {
		$response->setHeader ( 'Content-Type', 'text/html; charset=UTF-8', true );
		$response->sendResponse ();
	}
	
	public static function setupRegistry() {
		self::$registry = new Zend_Registry ( array (), ArrayObject::ARRAY_AS_PROPS );
		Zend_Registry::setInstance ( self::$registry );
		$registry = Zend_Registry::getInstance ();
		$registry->set ( 'root', self::$root );
	}
	
	public static function setupConfiguration() {
		$config = new Zend_Config_Ini ( self::$root . 'application/default/config/config.ini', 'desenvolvimento' );
		self::$registry->configuration = $config;
		$session = Zend_Registry::getInstance ();
		$session->set ( 'config', $config );
	}
	
	public static function setupDatabase() {
		$config = self::$registry->configuration;
		$db = Zend_Db::factory ( $config->db->adapter, $config->db->toArray () );
		$db->query ( "SET NAMES 'utf8'" );
		self::$registry->database = $db;
		Zend_Db_Table::setDefaultAdapter ( $db );
	}
}