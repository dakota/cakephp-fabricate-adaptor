<?php
/**
 * Test suite bootstrap for CakeFabricate.
 *
 * This function is used to find the location of CakePHP whether CakePHP
 * has been installed as a dependency of the plugin, or the plugin is itself
 * installed as a dependency of an application.
 */

use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;

$findRoot = function ($root) {
    do {
        $lastRoot = $root;
        $root = dirname($root);
        if (is_dir($root . '/vendor/cakephp/cakephp')) {
            return $root;
        }
    } while ($root !== $lastRoot);

    throw new Exception("Cannot find the root of the application, unable to run tests");
};
$root = $findRoot(__FILE__);
unset($findRoot);

chdir($root);
require_once 'vendor/cakephp/cakephp/src/basics.php';

require_once 'vendor/autoload.php';

define('ROOT', $root . DS . 'tests' . DS . 'test_app' . DS);
define('APP', ROOT . 'App' . DS);
define('TMP', sys_get_temp_dir() . DS);

Configure::write('debug', true);
Configure::write('App', [
    'namespace' => 'App',
    'paths' => [
        'plugins' => [ROOT . 'Plugin' . DS],
        'templates' => [ROOT . 'App' . DS . 'Template' . DS]
    ]
]);

if (!getenv('db_dsn')) {
    putenv('db_dsn=sqlite:///:memory:');
}
ConnectionManager::config('test', ['url' => getenv('db_dsn')]);

Plugin::load('CakeFabricate', [
    'path' => dirname(dirname(__FILE__)) . DS,
]);
