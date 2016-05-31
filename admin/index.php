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

include_once __DIR__ . '/admin_header.php';

//count quotes
$totalCount   = $quotesHandler->getCount();
$offlineCount = $quotesHandler->getCount(new Criteria('quote_status', RandomquoteConstants::STATUS_OFFLINE, '='));
$onlineCount  = $quotesHandler->getCount(new Criteria('quote_status', RandomquoteConstants::STATUS_ONLINE, '='));
$waitingCount = (string) ($totalCount - $offlineCount - $onlineCount);

// InfoBox quotes
$adminMenu->addInfoBox(_AM_RANDOMQUOTE_STATISTICS);
// InfoBox quotes
$adminMenu->addInfoBoxLine(_AM_RANDOMQUOTE_STATISTICS, _AM_RANDOMQUOTE_THEREARE_QUOTES, $totalCount);
$adminMenu->addInfoBoxLine(_AM_RANDOMQUOTE_STATISTICS, _AM_RANDOMQUOTE_QUOTES_OFFLINE, $offlineCount, 'red');
$adminMenu->addInfoBoxLine(_AM_RANDOMQUOTE_STATISTICS, _AM_RANDOMQUOTE_QUOTES_ONLINE , $onlineCount, 'green');
$adminMenu->addInfoBoxLine(_AM_RANDOMQUOTE_STATISTICS, _AM_RANDOMQUOTE_QUOTES_WAITING, $waitingCount, 'orange');
// Render Index
echo $adminMenu->addNavigation(basename(__FILE__));
echo $adminMenu->renderIndex();
include_once __DIR__ . '/admin_footer.php';
