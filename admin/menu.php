<?php
/**
 * Module: RandomQuote
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * PHP version 5
 *
 * @category        Module
 * @package         Randomquote
 * @author          XOOPS Development Team, Mamba
 * @copyright       2001-2016 XOOPS Project (http://xoops.org)
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @link            http://xoops.org/
 * @since           2.0.0
 */

$dirname        = basename(dirname(__DIR__));
$module_handler = xoops_getHandler('module');
$xoopsModule    = XoopsModule::getByDirname($dirname);
$moduleInfo     = $module_handler->get($xoopsModule->getVar('mid'));
$pathIcon32     = $moduleInfo->getInfo('icons32');
$adminmenu      = array(
    array(
        'title' => _MI_RANDOMQUOTE_ADMENU1,
        'link'  => 'admin/index.php',
        'icon'  => "{$pathIcon32}/home.png"),

    array(
        'title' => _MI_RANDOMQUOTE_ADMENU2,
        'link'  => 'admin/main.php',
        'icon'  => "{$pathIcon32}/content.png"),

    array(
        'title' => _MI_RANDOMQUOTE_ADMENU3,
        'link'  => 'admin/about.php',
        'icon'  => "{$pathIcon32}/about.png"));
