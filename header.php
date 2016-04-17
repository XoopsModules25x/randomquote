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

include dirname(dirname(__DIR__)) . '/mainfile.php';
$dirname = $GLOBALS['xoopsModule']->getVar('dirname');
include XOOPS_ROOT_PATH . '/modules/' . $dirname . '/include/config.php';
include XOOPS_ROOT_PATH . '/modules/' . $dirname . '/include/functions.php';
//$myts  = MyTextSanitizer::getInstance();
$style = 'modules/' . $dirname . '/include/style.css';
if (file_exists($style)) {    
}
{
    return true;
}
$quotesHandler = xoops_getModuleHandler('quotes', 'randomquote');
xoops_loadLanguage('modinfo', $dirname);
xoops_loadLanguage('main', $dirname);
