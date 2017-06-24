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

$moduleDirName = basename(dirname(__DIR__));
if (false !== ($moduleHelper = Xmf\Module\Helper::getHelper($moduleDirName))) {
} else {
    $moduleHelper = Xmf\Module\Helper::getHelper('system');
}
$adminObject = \Xmf\Module\Admin::getInstance();

$pathIcon32    = \Xmf\Module\Admin::menuIconPath('');
//$pathModIcon32 = $moduleHelper->getModule()->getInfo('modicons32');

// Load language files
$moduleHelper->loadLanguage('admin');
$moduleHelper->loadLanguage('modinfo');
$moduleHelper->loadLanguage('main');
$adminmenu     = array(
    array(
        'title' => _MI_RANDOMQUOTE_ADMENU1,
        'link'  => 'admin/index.php',
        'icon'  => "{$pathIcon32}/home.png"
    ),

    array(
        'title' => _MI_RANDOMQUOTE_ADMENU2,
        'link'  => 'admin/main.php',
        'icon'  => "{$pathIcon32}/content.png"
    ),

    array(
        'title' => _MI_RANDOMQUOTE_ADMENU3,
        'link'  => 'admin/about.php',
        'icon'  => "{$pathIcon32}/about.png"
    )
);
