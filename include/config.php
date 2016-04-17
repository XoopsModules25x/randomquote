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

// defined('XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');

if (!defined('RANDOMQUOTE_MODULE_PATH')) {
    define('RANDOMQUOTE_DIRNAME', 'randomquote');
    define('RANDOMQUOTE_PATH', XOOPS_ROOT_PATH . '/modules/' . RANDOMQUOTE_DIRNAME);
    define('RANDOMQUOTE_URL', XOOPS_URL . '/modules/' . RANDOMQUOTE_DIRNAME);
    define('RANDOMQUOTE_ADMIN', RANDOMQUOTE_URL . '/admin/index.php');
    define('RANDOMQUOTE_AUTHOR_LOGOIMG', RANDOMQUOTE_URL . '/assets/images/logo_module.png');
}
// module information
$mod_copyright = "<a href='http://xoops.org' title='XOOPS Project' target='_blank'>
                     <img src='" . RANDOMQUOTE_AUTHOR_LOGOIMG . "' alt='XOOPS Project' /></a>";
