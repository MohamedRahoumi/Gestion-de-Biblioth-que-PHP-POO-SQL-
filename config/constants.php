<?php

// Application constants
define('APP_NAME', getenv('APP_NAME') ?: 'MYBOOK');
define('SESSION_LIFETIME', getenv('SESSION_LIFETIME') ?: 3600);

// Paths
define('ROOT_PATH', dirname(__DIR__));
define('VIEWS_PATH', ROOT_PATH . '/views');
define('MODELS_PATH', ROOT_PATH . '/models');
define('CONTROLLERS_PATH', ROOT_PATH . '/controllers');
define('UTILS_PATH', ROOT_PATH . '/utils');
