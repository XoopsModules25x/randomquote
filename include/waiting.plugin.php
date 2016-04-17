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

function b_waiting_randomquote()
{
    $xoopsDB = XoopsDatabaseFactory::getDatabaseConnection();
    $ret     = array();

    // waiting quotes
    $block = array();

    $result = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('randomquote_quotes') . ' WHERE quote_waiting=1');
    if ($result) {
        $block['adminlink'] = XOOPS_URL . '/modules/randomquote/admin/main.php?op=listWaiting';
        list($block['pendingnum']) = $xoopsDB->fetchRow($result);
        $block['lang_linkname'] = _PI_WAITING_WAITINGS;
    }
    $ret[] = $block;

    return $ret;
}
