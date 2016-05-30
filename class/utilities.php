<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * Module: RandomQuote
 *
 * @category        Module
 * @package         randomquote
 * @author          XOOPS Module Development Team
 * @author          Mamba
 * @copyright       {@link http://xoops.org The XOOPS Project}
 * @license         {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @link            http://xoops.org XOOPS
 * @since           2.00
 */
 /**
  * RandomquoteUtilities
  *
  * Static utilities class to provide common functionality
  *
  */
class RandomquoteUtilities
{
    /**
     *
     * Verifies XOOPS version meets minimum requirements for this module
     * @static
     * @param XoopsModule
     *
     * @return bool true if meets requirements, false if not
     */
    public static function checkXoopsVer(&$module) {
        xoops_loadLanguage('admin', $module->dirname());
        //check for minimum XOOPS version
        $currentVer  = substr(XOOPS_VERSION, 6); // get the numeric part of string
        $currArray   = explode('.', $currentVer);
        $requiredVer = "" . $module->getInfo('min_xoops'); //making sure it's a string
        $reqArray    = explode('.', $requiredVer);
        $success     = true;
        foreach ($reqArray as $k=>$v) {
            if (isset($currArray[$k])) {
                if ($currArray[$k] > $v) {
                    break;
                } elseif ($currArray[$k] = $v) {
                    continue;
                } else {
                    $success = false;
                    break;
                }
            } else {
                if (intval($v) > 0) { // handles things like x.x.x.0_RC2
                    $success = false;
                    break;
                }
            }
        }

        if (!$success) {
            $module->setErrors(sprintf(_AM_RANDOMQUOTE_ERROR_BAD_XOOPS, $requiredVer, $currentVer));
        }

        return $success;
    }
    /**
     *
     * Verifies PHP version meets minimum requirements for this module
     * @static
     * @param XoopsModule
     *
     * @return bool true if meets requirements, false if not
     */
    public static function checkPHPVer(&$module) {
        xoops_loadLanguage('admin', $module->dirname());
        // check for minimum PHP version
        $phpLen   = strlen(PHP_VERSION);
        $extraLen = strlen(PHP_EXTRA_VERSION);
        $verNum   = trim(substr(PHP_VERSION, 0, ($phpLen-$extraLen)));
        $reqVer   = trim($module->getInfo('min_php') . ""); //make sure it's a string and then trim it

        $success  = true;
        if ($verNum >= $reqVer) {
            $module->setErrors(sprintf(_AM_RANDOMQUOTE_ERROR_BAD_PHP, $reqVer, $verNum));
            $success = false;
        }

        return $success;
    }
}
