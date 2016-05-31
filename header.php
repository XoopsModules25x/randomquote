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

include dirname(dirname(__DIR__)) . '/mainfile.php';
$moduleDirName = basename(__DIR__);

xoops_load('constants', $moduleDirName);

$style = "modules/{$moduleDirName}/include/style.css";
if (file_exists($GLOBALS['xoops']->path("/{$style}"))) {
    $GLOBALS['xoTheme']->addStylesheet($GLOBALS['xoops']->url("www/{$style}"));
}
$quotesHandler = xoops_getModuleHandler('quotes', $moduleDirName);
xoops_loadLanguage('modinfo', $moduleDirName);
xoops_loadLanguage('main', $moduleDirName);
