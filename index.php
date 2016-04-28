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
 * RandomQuote module for xoops
 *
 * @copyright       XOOPS Project (http://xoops.org)
 * @license         GPL 2.0 or later
 * @package         randomquote
 * @since           2.0.0
 * @author          XOOPS Development Team <name@site.com> - <http://xoops.org>
 */

include_once __DIR__ . '/header.php';
$xoopsOption = array();
$xoopsOption['template_main'] = 'randomquote_index.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';
include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
//$style = '../assets/css/table.css';
// keywords
RandomQuoteUtilities::setMetaKeywordsRandomquote($GLOBALS['xoopsModuleConfig']['keywords']);
// description
RandomQuoteUtilities::setMetaDescriptionRandomquote(_MA_RANDOMQUOTE_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', RANDOMQUOTE_URL . '/index.php');
$GLOBALS['xoopsTpl']->assign('randomquote_url', RANDOMQUOTE_URL);
$GLOBALS['xoopsTpl']->assign('adv', $GLOBALS['xoopsModuleConfig']['advertise']);
//
$GLOBALS['xoopsTpl']->assign('social_bookmarks', $GLOBALS['xoopsModuleConfig']['social_bookmarks']);
$GLOBALS['xoopsTpl']->assign('fbcomments', $GLOBALS['xoopsModuleConfig']['fbcomments']);
//
$GLOBALS['xoopsTpl']->assign('admin', RANDOMQUOTE_ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $mod_copyright);

$quotesHandler = xoops_getModuleHandler('quotes', 'randomquote');

$criteria = new CriteriaCompo();
$criteria->setSort('id');
$criteria->setOrder('ASC');
$numrows    = $quotesHandler->getCount();
$quotes_arr = $quotesHandler->getall($criteria);

//Table view
if ($numrows > 0) {
    echo "<table width='100%' cellspacing='1' class='outer'>
<tr>
<th align=\"center\">" . _MA_RANDOMQUOTE_QUOTES_QUOTE . "</th>
<th align=\"center\">" . _MA_RANDOMQUOTE_QUOTES_AUTHOR . '</th>

</tr>';

    $class = 'odd';

    foreach (array_keys($quotes_arr) as $i) {
        if ($quotes_arr[$i]->getVar('quotes_pid') == 0) {
            echo "<tr class='" . $class . "'>";
            $class = ($class === 'even') ? 'odd' : 'even';
            echo '<td> ' . $quotes_arr[$i]->getVar('quote') . '</td>';
            echo "<td align=\"center\">" . $quotes_arr[$i]->getVar('author') . '</td>';
            echo '</tr>';
        }
    }
    echo '</table><br /><br />';
}

//
include_once XOOPS_ROOT_PATH . '/footer.php';
