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

/**
 *
 * Prepares system prior to attempting to install module
 * @param obj $module {@link XoopsModule}
 *
 * @return bool true if ready to install, false if not
 */
function xoops_module_pre_install_randomquote(&$module)
{

    if (!class_exists('RandomquoteUtilities')) {
        xoops_load('utilities', 'randomquote');
    }
    //check for minimum XOOPS version
    if (!RandomquoteUtilities::checkXoopsVer($module)) {
        return false;
    }

    // check for minimum PHP version
    if (!RandomquoteUtilities::checkPHPVer($module)) {
        return false;
    }
    return true;
}

/**
 *
 * Performs tasks required during installation of the module
 * @param obj $module {@link XoopsModule}
 *
 * @return bool true if installation successful, false if not
 */
function xoops_module_install_randomquote(&$module) {
    return true;
}
