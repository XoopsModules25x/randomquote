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
 * @author          XOOPS Development Team, Mamba, Herve Thouzard
 * @copyright       2001-2016 XOOPS Project (http://xoops.org), Herve Thouzard
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @link            http://xoops.org/
 * @since           2.0.0
 *
 * @param $tablename
 *
 * @return bool
 */

function tableExists($tablename)
{
    global $xoopsDB;
    $result = $xoopsDB->queryF("SHOW TABLES LIKE '$tablename'");

    return ($xoopsDB->getRowsNum($result) > 0);
}

/**
 * @return bool
 */
function xoops_module_update_randomquote()
{
    global $xoopsDB;
    $errors = 0;
    if (tableExists($xoopsDB->prefix('citas'))) {
        $sql    = sprintf('ALTER TABLE ' . $xoopsDB->prefix('randomquote_quotes') . ' CHANGE `citas` `quote` TEXT');
        $result = $xoopsDB->queryF($sql);
        if (!$result) {
            echo '<br />' . _AM_RANDOMQUOTE_UPGRADEFAILED0;
            ++$errors;
        }

        $sql    = sprintf('ALTER TABLE ' . $xoopsDB->prefix('citas') . " ADD COLUMN `quote_status` int (10) NOT NULL default '0',
                        ADD COLUMN `quote_waiting` int (10) NOT NULL default '0',
                        ADD COLUMN `quote_online` int (10) NOT NULL default '0';");
        $result = $xoopsDB->queryF($sql);
        if (!$result) {
            echo '<br />' . _AM_RANDOMQUOTE_UPGRADEFAILED1;
            ++$errors;
        }

        $sql    = sprintf('ALTER TABLE ' . $xoopsDB->prefix('citas') . ' RENAME ' . $xoopsDB->prefix('randomquote_quotes'));
        $result = $xoopsDB->queryF($sql);
        if (!$result) {
            echo '<br />' . _AM_RANDOMQUOTE_UPGRADEFAILED2;
            ++$errors;
        }
    }

    return true;
}
