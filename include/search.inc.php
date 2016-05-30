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
 * @copyright       {@link http://xoops.org 2001-2016 XOOPS Project}
 * @license         {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @link            http://xoops.org XOOPS
 * @since           2.00
 */

function randomquote_search($queryarray, $andor, $limit, $offset, $userid)
{
    $ret = array();
    if (0 != (int)$userid) {
        return $ret;
    }

    $moduleDirName = basename(dirname(__DIR__));
    include_once $GLOBALS['xoops']->path("/modules/{$moduleDirName}/class/constants.php");

    $quoteHandler = xoops_getmodulehandler('quotes', 'randomquote');
    $entryFields  = array('id', 'quote', 'author', 'create_date');
    $criteria     = new CriteriaCompo();
    $criteria->add(new Criteria('quote_status', RandomquoteConstants::STATUS_ONLINE));
    $criteria->setSort('create_date');
    $criteria->setOrder('DESC');
    $criteria->setLimit((int) $limit);
    $criteria->setStart((int) $offset);

    if ((is_array($queryarray)) && !empty($queryarray)) {
        $criteria->add(new Criteria('quote', "%{$queryarray[0]}%", 'LIKE'));
        $criteria->add(new Criteria('author', "%{$queryarray[0]}%", 'LIKE'), 'OR');
        array_shift($queryarray); //get rid of first element

        foreach ($queryarray as $query) {
            $criteria->add(new Criteria('quote', "%{$query}%", 'LIKE'), $andor);
            $criteria->add(new Criteria('author', "%{$query}%", 'LIKE'), 'OR');
        }
    }
    $quoteObjs = $quoteHandler->getAll($criteria, $entryFields);
    foreach ($quoteObjs as $thisQuote) {
        $ttl = xoops_substr(strip_tags((string) $thisQuote), 0, 60, $trimmarker = '...');
        $ret[] = array (
                        'image' => 'assets/images/icons/quote.png',
                         'link' => "index.php?id=" . $thisQuote->getVar('id'),
                        'title' => $ttl,
                         'time' => strtotime($thisQuote->getVar('create_date')),
//                          'uid' => $entry['uid']
                       );

    }

    unset($quoteObjs);
    return $ret;
}
