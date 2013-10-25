<?
defined('C5_EXECUTE') or die("Access Denied.");

$rl = Router::getInstance();

/** 
 * Install
 */
$rl->register('/install', 'InstallController::view');
$rl->register('/install/select_language', 'InstallController::select_language');
$rl->register('/install/setup', 'InstallController::setup');
$rl->register('/install/test_url/{num1}/{num2}', 'InstallController::test_url');
$rl->register('/install/configure', 'InstallController::configure');
$rl->register('/install/run_routine/{pkgHandle}/{routine}', 'InstallController::run_routine');


/** 
 * Tools - legacy
 */
$rl->register('/tools/{tool}', 'ToolController::display', 'tool', array('tool' => '[A-Za-z0-9_/]+'));

/** 
 * Editing Interfaces
 */
$rl->register('/system/panels/dashboard', 'DashboardPanelController::view');
$rl->register('/system/panels/sitemap', 'SitemapPanelController::view');
$rl->register('/system/panels/add_block', 'AddBlockPanelController::view');

/** 
 * Page Routes - these must come at the end.
 */
$rl->register('/', 'dispatcher', 'home');
$rl->register('{path}', 'dispatcher', 'page', array('path' => '.+'));

