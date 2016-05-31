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

function b_waiting_randomquote()
{
    $moduleDirName = basename(dirname(__DIR__));
    include_once $GLOBALS['xoops']->path("/modules/{$moduleDirName}/class/constants.php");

    $xoopsDB       = XoopsDatabaseFactory::getDatabaseConnection();
    $block         = array();
    $quotesHandler = xoops_getmodulehandler('quotes', $moduleDirName);

    // quotes waiting approval
    $result = $quotesHandler->getCount(new Criteria('quote_status', RandomquoteConstants::STATUS_WAITING));
    if ($result) {
        $block = array('adminlink'     => $GLOBALS['xoops']->url("www/modules/{$moduleDirName}/admin/main.php?op=list&status=" . RandomquoteConstants::STATUS_WAITING),
                       'pendingnum'    => (int)$result,
                       'lang_linkname' => _PI_WAITING_WAITINGS);
    }

    return $block;
}
