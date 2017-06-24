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
 * @author          ZySpec <owners@zyspec.com>
 * @copyright       {@link http://xoops.org 2001-2016 XOOPS Project}
 * @license         {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @link            http://xoops.org XOOPS
 * @since           2.00
 */

/**
 *
 * Prepares system prior to attempting to uninstall module
 * @param XoopsModule $module {@link XoopsModule}
 *
 * @return bool true if ready to uninstall, false if not
 */
function xoops_module_pre_uninstall_randomquote($module)
{
    // Do some synchronization with tags to remove tags associated with this module

    $success   = true;
    $tagModule = XoopsModule::getByDirname('tag');
    if ($tagModule instanceof XoopsModule) {
        // first delete all quotes
        $quotesHandler = xoops_getModuleHandler('quotes', $module->dirname());
        if ($quotesHandler->getCount() > 0) {
            $quoteObjs = $quotesHandler->deleteAll();
            //now 'unlink' the quote tags from Tag modules
            require_once $GLOBALS['xoops']->path('/modules/tag/include/functions.recon.php');
            $success = tag_synchronization();
            if (!$success) {
                xoops_loadLanguage('admin', $module->dirname());
                $module->setErrors(_AM_RANDOMQUOTE_ERROR_TAG_REMOVAL);
            }
        }
    }

    return $success;
}

/**
 *
 * Performs tasks required during uninstallation of the module
 * @param XoopsModule $module {@link XoopsModule}
 *
 * @return bool true if uninstallation successful, false if not
 */
function xoops_module_uninstall_randomquote($module)
{
    $success = true;
    return $success;
}
