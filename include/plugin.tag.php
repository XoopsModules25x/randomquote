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
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @author          ZySpec <owners@zyspec.com>
 * @copyright       {@link http://xoops.org 2001-2016 XOOPS Project}
 * @license         {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @link            http://xoops.org XOOPS
 * @since           2.11
 */

defined('XOOPS_ROOT_PATH') || exit('Restricted access');

XoopsLoad::load('XoopsFilterInput');

/** Get item fields: title, content, time, link, uid, tags
 *
 * Note that $items is "by reference" so modifying it in this
 * routine in effect passes it back...
 *
 * @param array $items
 *
 * @return bool
 **/
function randomquote_tag_iteminfo(&$items)
{
    if (empty($items) || !is_array($items)) {
        return false;
    }

    $moduleDirName = basename(dirname(__DIR__));
    include_once $GLOBALS['xoops']->path("/modules/{$moduleDirName}/class/constants.php");

    $itemsId = array();
    $catsId  = array();

    foreach (array_keys($items) as $catId) {
        $catsId[] = (int)$catId;
        foreach (array_keys($items[$catId]) as $itemId) {
            $itemsId[] = (int)$itemId;
        }
    }

    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria('id', '(' . implode(',', $itemsId) . ')', 'IN'));
    $criteria->add(new Criteria('quote_status', RandomquoteConstants::STATUS_ONLINE));

    $quoteHandler = xoops_getmodulehandler('quotes', $moduleDirName);
    $quoteObjs    = $quoteHandler->getObjects($criteria, true);

    foreach ($catsId as $catId) {
        foreach ($itemsId as $itemId) {
            $quoteObj               = $quoteObjs[$itemId];
            $items[$catId][$itemId] = array('title'   => $quoteObj, //uses class majic __toString
                                            'link'    => "index.php?id={$itemId}",
                                            'time'    => strtotime($quoteObj->getVar('create_date')),
                                            'content' => '',
                                            //                                             'tags' => tag_parse_tag($quoteObj->getVar('item_tag', 'n')), // optional
                                            //                                              'uid' => $quoteObj->getVar('uid'),
            );
        }
    }

    unset($quoteObjs);
    return true;
}

/**
 * Remove orphan tag-item links
 *
 * @param int $mid module ID
 */
function randomquote_tag_synchronization($mid)
{
    $moduleDirName = basename(dirname(__DIR__));
    include_once $GLOBALS['xoops']->path("/modules/{$moduleDirName}/class/constants.php");

    $itemHandler = xoops_getmodulehandler('quotes', $moduleDirName);
    $linkHandler = xoops_getmodulehandler('link', 'tag');

    $itemClass = $moduleDirName . 'QuotesHandler';
    if ((!$itemHandler instanceof $itemClass) || (!$linkHandler instanceof TagLink)) {
        $result = false;
    } else {
        $mid           = XoopsFilterInput::clean($mid, 'INT');
        $moduleHandler = xoops_gethandler('module');
        $rqModule      = XoopsModule::getByDirname($moduleDirName);

        // check to make sure module is active and trying to sync randomquote
        if (($rqModule instanceof XoopsModule) && ($rqModule->isactive()) && ($rqModule->mid() == $mid)) {
            // clear tag-item links
            $sql    = "DELETE FROM {$linkHandler->table}"
                      . " WHERE tag_modid = {$mid}"
                      . "    AND "
                      . "    (tag_itemid NOT IN "
                      . "        (SELECT DISTINCT {$itemHandler->keyName} "
                      . "           FROM {$itemHandler->table} "
                      . "           WHERE {$itemHandler->table}.quote_status = "
                      . RandomquoteConstants::STATUS_ONLINE
                      . "        )"
                      . "    )";
            $result = $linkHandler->db->queryF($sql);
        } else {
            $result = false;
        }
    }

    return ($result) ? true : false;
}
