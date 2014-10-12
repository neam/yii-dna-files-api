<?php

// convenience variables
$applicationDirectory = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
$projectRoot = $applicationDirectory . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..';
$baseUrl = (dirname($_SERVER['SCRIPT_NAME']) == '/' || dirname($_SERVER['SCRIPT_NAME']) == '\\') ? '' :
    dirname($_SERVER['SCRIPT_NAME']);

// main application configuration
$config = array(
    'name' => 'Yii DNA Media API',
    'language' => 'en',
    'sourceLanguage' => 'en', // source code language
    'basePath' => $applicationDirectory,
    'aliases' => array(
        'root' => $projectRoot,
        'app' => $applicationDirectory,
        'vendor' => $applicationDirectory . '/../vendor',
        'dna' => $projectRoot . '/dna',
        'app' => 'application',
    ),
    // autoloading model and component classes
    'import' => array(
        'application.components.*',
        'application.controllers.*',
    ),
    'modules' => array(
        'p3media' => array(
            'params' => array(
                'presets' => array( /*
                    'related-thumb' => array(
                        'name' => 'Related Panel Thumbnail',
                        'commands' => array(
                            'resize' => array(200, 200, 2),
                            'quality' => '100',
                        ),
                        'type' => 'jpg',
                    ),
                    'item-list-thumbnail' => array(
                        'name' => 'Item Thumbnail',
                        'commands' => array(
                            'resize' => array(110, 70, 2),
                            'quality' => '85',
                        ),
                        'type' => 'jpg',
                    ),
                    'wide-profile-info-picture' => array(
                        'name' => 'Wide Profile Info Picture',
                        'commands' => array(
                            'resize' => array(110, 110, 7),
                            'quality' => 85,
                        ),
                    ),
                    'user-profile-picture' => array(
                        'name' => 'User Profile Picture',
                        'commands' => array(
                            'resize' => array(160, 160, 7), // Image::AUTO
                            'quality' => '85',
                        ),
                        'type' => 'jpg',
                    ),
                    'user-profile-picture-large' => array(
                        'name' => 'User Profile Picture Large',
                        'commands' => array(
                            'resize' => array(262, 262, 7), // Image::AUTO
                            'quality' => '85',
                        ),
                        'type' => 'jpg',
                    ),
                    'user-profile-picture-small' => array(
                        'name' => 'User Profile Picture Small',
                        'commands' => array(
                            'resize' => array(70, 70, 7), // Image::AUTO
                            'quality' => '85',
                        ),
                        'type' => 'jpg',
                    ),
                    'user-profile-picture-mini' => array(
                        'name' => 'User Profile Picture Mini',
                        'commands' => array(
                            'resize' => array(25, 25, 7), // Image::AUTO
                            'quality' => '85',
                        ),
                        'type' => 'jpg',
                    ),
                    'original-public-webm' => array(
                        //'name'         => 'Original File Public',
                        'originalFile' => true,
                        'savePublic' => true,
                        'type' => 'webm',
                    ),
                    'original-public-mp4' => array(
                        //'name'         => 'Original File Public',
                        'originalFile' => true,
                        'savePublic' => true,
                        'type' => 'mp4',
                    ),
                    'large' => array(
                        'name' => 'Large JPG 1600px',
                        'commands' => array(
                            'resize' => array(1600, 1600, 2), // Image::AUTO
                            'quality' => '85',
                        ),
                        'type' => 'jpg',
                    ),
                    'medium' => array(
                        'name' => 'Medium PNG 800px',
                        'commands' => array(
                            'resize' => array(800, 800, 2), // Image::AUTO
                            'quality' => '85',
                        ),
                        'type' => 'png',
                    ),
                    'medium-crop' => array(
                        'name' => 'Medium PNG cropped 800x600px',
                        'commands' => array(
                            'resize' => array(800, 600, 7), // crop
                            'quality' => '85',
                        ),
                        'type' => 'png',
                    ),
                    'small' => array(
                        'name' => 'Small PNG 400px',
                        'commands' => array(
                            'resize' => array(400, 400, 2), // Image::AUTO
                            'quality' => '85',
                        ),
                        'type' => 'png',
                    ),
                    'icon-32' => array(
                        'name' => 'Icon PNG 32x32',
                        'commands' => array(
                            'resize' => array(32, 32),
                        ),
                        'type' => 'png'
                    ),
                    'download' => array(
                        'name' => 'Download File',
                        'originalFile' => true,
                        'attachment' => true,
                    ),
                    'original' => array(
                        //'name'         => 'Original File', // uncomment name to enable preset in dropdowns
                        'originalFile' => true,
                    ),
                    'original-public' => array(
                        //'name'         => 'Original File Public',
                        'originalFile' => true,
                        'savePublic' => true,
                    ),
                    'p3media-ckbrowse' => array(
                        'commands' => array(
                            'resize' => array(150, 120), // use third parameter for master setting, see Image constants
                            #'quality' => 80, // for jpegs
                        ),
                        'type' => 'png'
                    ),
                    'p3media-manager' => array(
                        'commands' => array(
                            'resize' => array(300, 200), // use third parameter for master setting, see Image constants
                            #'quality' => 80, // for jpegs
                        ),
                        'type' => 'png'
                    ),
                    'p3media-upload' => array(
                        'commands' => array(
                            'resize' => array(60, 30), // use third parameter for master setting, see Image constants
                            #'quality' => 80, // for jpegs
                        ),
                        'type' => 'png'
                    ),
                     */
                ),
            ),
        ),
    ),
    // application components
    'components' => array(
        'request' => array(
            'baseUrl' => $baseUrl,
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(

                // root home page
                '/' => 'site/index',

                // "phundament/p3media" module
                'p3media/<controller>/<action>' => 'p3media/<controller>/<action>',
                '<lang:[a-z]{2}(_[a-z]{2})?>/p3media/<controller>/<action>' => 'p3media/<controller>/<action>',
                '<lang:[a-z]{2}(_[a-z]{2})?>/img/<preset:[a-zA-Z0-9-._]+>/<title:.+>_<id:\d+><extension:.[a-zA-Z0-9]{1,}+>' => 'p3media/file/image',

                // common
                '<lang:[a-z]{2}(_[a-z]{2})?>' => '',
                '<lang:[a-z]{2}(_[a-z]{2})?>/<controller>' => '<controller>',
                '<lang:[a-z]{2}(_[a-z]{2})?>/<controller>/<action>' => '<controller>/<action>',

                '<lang:[a-z]{2}(_[a-z]{2})?>/<controller:\w+>/<id:[\w-]+>' => '<controller>/view',
                '<lang:[a-z]{2}(_[a-z]{2})?>/<controller:\w+>/<action:\w+>/<id:[\w-]+>' => '<controller>/<action>',

                // disabled due to url rule collision, e.g. "videoFile/slug" = "videoFile/browse"
                '<controller:\w+>/<id:[\w-]+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:[\w-]+>' => '<controller>/<action>',
            ),


        ),
        'cache' => array(
            'class' => 'CDummyCache',
        ),
        'image' => array(
            'class' => 'dna-vendor.phundament.p3extensions.components.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(),
);

// Import the DNA classes and configuration
require($projectRoot . '/dna/dna-api-revisions/' . YII_DNA_REVISION . '/include.php');

// Extensions' includes
include($applicationDirectory . '/../vendor/neam/yii-dna-debug-modes-and-error-handling/config/error-handling.php');
include($applicationDirectory . '/../vendor/neam/yii-dna-debug-modes-and-error-handling/config/debug-modes.php');

// This is a REST application, so we want' to handle errors accordingly.
$config['components']['errorHandler'] = array(
    'class' => 'YiiDnaErrorHandler',
);

// Uncomment to easily see the active merged configuration
//echo "<pre>";print_r($config);echo "</pre>";die();

return $config;
