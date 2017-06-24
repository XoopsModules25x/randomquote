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
 * @author          Herve Thouzard
 * @copyright       {@link http://xoops.org 2001-2016 XOOPS Project}
 * @copyright       Herve Thouzard
 * @license         {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @link            http://xoops.org XOOPS
 * @since           2.00
 */

if ((!defined('XOOPS_ROOT_PATH')) || !($GLOBALS['xoopsUser'] instanceof XoopsUser) || !$GLOBALS['xoopsUser']->IsAdmin()) {
    exit('Restricted access' . PHP_EOL);
}

/**
 * @param string $tablename
 *
 * @return bool
 */
function tableExists($tablename)
{
    $result = $GLOBALS['xoopsDB']->queryF("SHOW TABLES LIKE '$tablename'");
    return ($GLOBALS['xoopsDB']->getRowsNum($result) > 0) ? true : false;
}

/**
 *
 * Prepares system prior to attempting to install module
 * @param XoopsModule $module {@link XoopsModule}
 *
 * @return bool true if ready to install, false if not
 */
function xoops_module_pre_update_randomquote($module)
{
    if (!class_exists('RandomquoteUtility')) {
        xoops_load('utility', 'randomquote');
    }
    //check for minimum XOOPS version
    if (!RandomquoteUtility::checkVerXoops($module)) {
        return false;
    }

    // check for minimum PHP version
    if (!RandomquoteUtility::checkVerPhp($module)) {
        return false;
    }
    return true;
}

/**
 *
 * Performs tasks required during update of the module
 * @param XoopsModule $module {@link XoopsModule}
 * @return bool
 */
function xoops_module_update_randomquote(XoopsModule $module, $installedVersion = null)
{
    xoops_loadLanguage('admin', $module->dirname());
    $errors = 0;
    if (tableExists($GLOBALS['xoopsDB']->prefix('citas'))) {
        $sql    = sprintf('ALTER TABLE ' . $GLOBALS['xoopsDB']->prefix('citas') . ' CHANGE `citas` `quote` TEXT');
        $result = $GLOBALS['xoopsDB']->queryF($sql);
        if (!$result) {
            $module->setErrors(_AM_RANDOMQUOTE_UPGRADEFAILED0);
            ++$errors;
        }

        $sql    = sprintf('ALTER TABLE '
                          . $GLOBALS['xoopsDB']->prefix('citas')
                          . " ADD COLUMN `quote_status` int (10) NOT NULL default '0',"
                          . " ADD COLUMN `quote_waiting` int (10) NOT NULL default '0',"
                          . " ADD COLUMN `quote_online` int (10) NOT NULL default '0';");
        $result = $GLOBALS['xoopsDB']->queryF($sql);
        if (!$result) {
            $module->setErrors(_AM_RANDOMQUOTE_UPGRADEFAILED1);
            ++$errors;
        }

        $sql    = sprintf('ALTER TABLE ' . $GLOBALS['xoopsDB']->prefix('citas') . ' RENAME ' . $GLOBALS['xoopsDB']->prefix('randomquote_quotes'));
        $result = $GLOBALS['xoopsDB']->queryF($sql);
        if (!$result) {
            $module->setErrors(_AM_RANDOMQUOTE_UPGRADEFAILED2);
            ++$errors;
        }
    }

    if ($installedVersion < 211) {
        // add column for quotes table for date created
        $result      = $GLOBALS['xoopsDB']->queryF('SHOW COLUMNS FROM ' . $GLOBALS['xoopsDB']->prefix('randomquote_quotes') . " LIKE 'create_date'");
        $foundCreate = $GLOBALS['xoopsDB']->getRowsNum($result);
        if (empty($foundCreate)) {
            // column doesn't exist, so try and add it
            $success = $GLOBALS['xoopsDB']->queryF('ALTER TABLE ' . $GLOBALS['xoopsDB']->prefix('reandomquote_quotes') . ' ADD create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP AFTER quote_status');
            if (!$success) {
                $module->setErrors(sprintf(_AM_RANDOMQUOTE_ERROR_COLUMN, 'create_date'));
                ++$errors;
            }
        }

        // change status to indicate quote waiting approval
        $sql    = 'UPDATE ' . $GLOBALS['xoopsDB']->prefix('randomquote_quotes') . ' SET quote_status=2 WHERE `quote_waiting` > 0';
        $result = $GLOBALS['xoopsDB']->queryF($sql);
        if (!$result) {
            $module->setErrors(_AM_RANDOMQUOTE_UPGRADEFAILED1);
            ++$errors;
        }

        // change status to indicate quote online
        $sql    = 'UPDATE ' . $GLOBALS['xoopsDB']->prefix('randomquote_quotes') . ' SET quote_status=1 WHERE `quote_online` > 0';
        $result = $GLOBALS['xoopsDB']->queryF($sql);
        if (!$result) {
            $module->setErrors(_AM_RANDOMQUOTE_UPGRADEFAILED1);
            ++$errors;
        }

        // drop the waiting and online columns
        $sql    = sprintf('ALTER TABLE ' . $GLOBALS['xoopsDB']->prefix('randomquote_quotes') . ' DROP COLUMN `quote_waiting`,' . ' DROP COLUMN `quote_online`;');
        $result = $GLOBALS['xoopsDB']->queryF($sql);
        if (!$result) {
            $module->setErrors(_AM_RANDOMQUOTE_UPGRADEFAILED1);
            ++$errors;
        }
    }

    return $errors ? false : true;
}
