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

require_once __DIR__ . '/admin_header.php';
// Display Admin header
xoops_cp_header();

//count quotes
$totalCount   = $quotesHandler->getCount();
$offlineCount = $quotesHandler->getCount(new Criteria('quote_status', RandomquoteConstants::STATUS_OFFLINE, '='));
$onlineCount  = $quotesHandler->getCount(new Criteria('quote_status', RandomquoteConstants::STATUS_ONLINE, '='));
$waitingCount = (string)($totalCount - $offlineCount - $onlineCount);

// InfoBox quotes
$adminObject->addInfoBox(_AM_RANDOMQUOTE_STATISTICS);
// InfoBox quotes
$adminObject->addInfoBoxLine(sprintf(_AM_RANDOMQUOTE_THEREARE_QUOTES, $totalCount));
$adminObject->addInfoBoxLine(sprintf(_AM_RANDOMQUOTE_QUOTES_OFFLINE, '<span class="red">' . $offlineCount . '</span>'),'', 'red');
$adminObject->addInfoBoxLine(sprintf(_AM_RANDOMQUOTE_QUOTES_ONLINE, '<span class="green">' . $onlineCount . '</span>'),'', 'green');
$adminObject->addInfoBoxLine(sprintf(_AM_RANDOMQUOTE_QUOTES_WAITING, '<span class="orange">' . $waitingCount . '</span>'),'', 'orange');
// Render Index
$adminObject->displayNavigation(basename(__FILE__));

xoops_loadLanguage('admin/modulesadmin', 'system');
require_once __DIR__ . '/../testdata/index.php';
$adminObject->addItemButton(_AM_SYSTEM_MODULES_INSTALL_TESTDATA, '__DIR__ . /../../testdata/index.php?op=load', 'add');
$adminObject->displayButton('left', '');

$adminObject->displayIndex();

require_once __DIR__ . '/admin_footer.php';
