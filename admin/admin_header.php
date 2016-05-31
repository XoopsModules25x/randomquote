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

include_once dirname(dirname(dirname(__DIR__))) . '/mainfile.php';
include_once $GLOBALS['xoops']->path('/include/cp_header.php');

$moduleDirName = $GLOBALS['xoopsModule']->getVar('dirname');

XoopsLoad::load('xoopsrequest');
XoopsLoad::load('quotes', $moduleDirName);
XoopsLoad::load('constants', $moduleDirName);

$pathIcon16      = $GLOBALS['xoops']->url('www/' . $GLOBALS['xoopsModule']->getInfo('icons16'));
$pathIcon32      = $GLOBALS['xoops']->url('www/' . $GLOBALS['xoopsModule']->getInfo('icons32'));
$pathModuleAdmin = $GLOBALS['xoops']->path('www/' . $GLOBALS['xoopsModule']->getInfo('dirmoduleadmin'));
$quotesHandler   = xoops_getModuleHandler('quotes', $moduleDirName);

$myts = MyTextSanitizer::getInstance();
if (!isset($GLOBALS['xoopsTpl']) || !($GLOBALS['xoopsTpl'] instanceof XoopsTpl)) {
    include_once $GLOBALS['xoops']->path("/class/template.php");
    $xoopsTpl = new XoopsTpl();
}

$GLOBALS['xoopsTpl']->assign('pathIcon16', $pathIcon16);
$GLOBALS['xoopsTpl']->assign('pathIcon32', $pathIcon32);
//Load languages
xoops_loadLanguage('admin', $moduleDirName);
xoops_loadLanguage('modinfo', $moduleDirName);
xoops_loadLanguage('main', $moduleDirName);
require_once "{$pathModuleAdmin}/moduleadmin/moduleadmin.php";

xoops_cp_header();
$adminMenu = new ModuleAdmin();
