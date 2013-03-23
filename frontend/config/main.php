<?php
/**
 * main.php
 *
 * This file holds frontend configuration settings.
 *
 * @author: Andrew Mallonee <amallonee@yahoo.com>
 * Date: 3/23/2013
 * Time: 3:35 PM
 */
$frontendConfigDir = dirname(__FILE__);

$root = $frontendConfigDir . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..';

$params = require_once($frontendConfigDir . DIRECTORY_SEPARATOR . 'params.php');

// Setup some default path aliases. These alias may vary from projects.
Yii::setPathOfAlias('root', $root);
Yii::setPathOfAlias('common', $root . DIRECTORY_SEPARATOR . 'common');
Yii::setPathOfAlias('frontend', $root . DIRECTORY_SEPARATOR . 'frontend');
Yii::setPathOfAlias('www', $root. DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR . 'www');
Yii::setPathOfAlias('bootstrap', $root . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'bootstrap');

$mainLocalFile = $frontendConfigDir . DIRECTORY_SEPARATOR . 'main-local.php';
$mainLocalConfiguration = file_exists($mainLocalFile)? require($mainLocalFile): array();

$mainEnvFile = $frontendConfigDir . DIRECTORY_SEPARATOR . 'main-env.php';
$mainEnvConfiguration = file_exists($mainEnvFile) ? require($mainEnvFile) : array();

return CMap::mergeArray(
    array(
        // @see http://www.yiiframework.com/doc/api/1.1/CApplication#basePath-detail
	'basePath' => 'frontend',
	// set parameters
	'params' => $params,
	// preload components required before running applications
	// @see http://www.yiiframework.com/doc/api/1.1/CModule#preload-detail
	'preload' => array(
            'log',
            'bootstrap'
        ),
        // @see http://www.yiiframework.com/doc/api/1.1/CApplication#language-detail
        'language' => 'en',
        // uncomment if a theme is used
        /*'theme' => '',*/
        // setup import paths aliases
        // @see http://www.yiiframework.com/doc/api/1.1/YiiBase#import-detail
        'import' => array(
            'common.components.*',
            'common.extensions.*',
            'common.extensions.imageEdit.*',
            'common.models.*',
            //User Module
            'common.modules.user.models.*',
            'common.modules.user.components.*',
            //Rights Module
            'common.modules.rights.*',
            'common.modules.rights.components.*',
            // uncomment if behaviors are required
            // you can also import a specific one
            /* 'common.extensions.behaviors.*', */
            // uncomment if validators on common folder are required
            /* 'common.extensions.validators.*', */
            'application.components.*',
            'application.controllers.*',
            'application.models.*'
        ),
        /* uncomment and set if required */
        // @see http://www.yiiframework.com/doc/api/1.1/CModule#setModules-detail
        'modules' => array(
            'rights'=> array(
                'install' => false,    
            ),
            'message' => array(
                'userModel' => 'Users',
                'getNameMethod' => 'getFullName',
                'getSuggestMethod' => 'getSuggest',
                'viewPath' => '/message/fancy',
            ),
            'user' => array(
                'hash' => 'md5',
                'sendActivationEmail' => true,
                'loginNotActive' => false,
                'activeAfterRegister' => false,
                'autoLogin' => true,
                'registrationUrl' => array('/user/registration'),
                'recoveryUrl' => array('/user/recovery'),
                'loginUrl' => array('/user/login'),
                'returnUrl' => array('/user/profile'),
                'returnLogoutUrl' => array('/user/login'),
            ),
            'gii'=>array(
                'class'=>'system.gii.GiiModule',
                'password'=>'Alien9987!',
            ),
        ), 
        'components' => array(
            'user'=>array(
                'class' => 'RWebUser',
                'allowAutoLogin' => true,
                'loginUrl' => array('/user/login'),
            ),
            'errorHandler' => array(
                // @see http://www.yiiframework.com/doc/api/1.1/CErrorHandler#errorAction-detail
                'errorAction'=>'site/error'
            ),
            'bootstrap'=>array(
                'class' => 'common.extensions.bootstrap.components.Bootstrap',
                'responsiveCss' => true,  
            ),
            'db'=>array(
                'connectionString' => 'mysql:host=purplepage.db.10691077.hostedresource.com;port=3306;dbname=purplepage',
                'username' => 'purplepage',
                'password' => 'Alien9987!',
                'charset' => 'utf8',
            ),
            'urlManager' => array(
                'urlFormat' => 'path',
                'showScriptName' => false,
                'urlSuffix' => '/',
                'rules' => $params['url.rules']
            ),
            //'user' => array(
            //    'class' => 'RWebUser',    
            //),
            'authManager' => array(
                'class' => 'RDbAuthManager',
                'connectionID' => 'db',
                'defaultRoles' => array('Authenticated', 'Guest'),
                'assignmentTable' => 'authassignment',
            ),
            /* make sure you have your cache set correctly before uncommenting */
            /* 'cache' => $params['cache.core'], */
            /* 'contentCache' => $params['cache.content'] */
        ),
    ),
        
    CMap::mergeArray($mainEnvConfiguration, $mainLocalConfiguration)
);