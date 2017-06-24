<?php
/*
 You may not change or alter any portion of this comment or credits of
 supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit
 authors.

 This program is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * Module: RandomQuote
 *
 * @category        Module
 * @package         randomquote
 * @author          XOOPS Module Development Team
 * @author          Mamba
 * @copyright       {@link http://xoops.org 2001-2016 XOOPS Project}
 * @license         {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @link            http://xoops.org XOOPS
 * @since           2.00
 */

require_once __DIR__ . '/../../../include/cp_header.php';
//require_once __DIR__ . '/../include/config.php';
require_once __DIR__ . '/../class/utility.php';
$moduleDirName = basename(dirname(__DIR__));

XoopsLoad::load('quotes', $moduleDirName);
XoopsLoad::load('constants', $moduleDirName);

if (false !== ($moduleHelper = Xmf\Module\Helper::getHelper($moduleDirName))) {
} else {
    $moduleHelper = Xmf\Module\Helper::getHelper('system');
}
/** @var Xmf\Module\Admin $adminObject */
$adminObject = Xmf\Module\Admin::getInstance();

$myts = MyTextSanitizer::getInstance();

if (!isset($GLOBALS['xoopsTpl']) || !($GLOBALS['xoopsTpl'] instanceof XoopsTpl)) {
    require_once $GLOBALS['xoops']->path('class/template.php');
    $xoopsTpl = new XoopsTpl();
}

$pathIcon16      = Xmf\Module\Admin::iconUrl('', 16);
$pathIcon32      = Xmf\Module\Admin::iconUrl('', 32);
$pathModIcon32 = $moduleHelper->getModule()->getInfo('modicons32');

// Local icons path
$xoopsTpl->assign('pathModIcon16', $pathIcon16);
$xoopsTpl->assign('pathModIcon32', $pathIcon32);

// Load language files
$moduleHelper->loadLanguage('admin');
$moduleHelper->loadLanguage('modinfo');
$moduleHelper->loadLanguage('main');


$quotesHandler   = xoops_getModuleHandler('quotes', $moduleDirName);

$myts = MyTextSanitizer::getInstance();
if (!isset($GLOBALS['xoopsTpl']) || !($GLOBALS['xoopsTpl'] instanceof XoopsTpl)) {
    require_once $GLOBALS['xoops']->path('/class/template.php');
    $xoopsTpl = new XoopsTpl();
}

$GLOBALS['xoopsTpl']->assign('pathIcon16', $pathIcon16);
$GLOBALS['xoopsTpl']->assign('pathIcon32', $pathIcon32);
