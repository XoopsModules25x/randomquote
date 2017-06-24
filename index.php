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
 */

require_once __DIR__ . '/header.php';
$xoopsOption                  = (!isset($xoopsOption)) ? array() : $xoopsOption;
$xoopsOption['template_main'] = 'randomquote_index.tpl';
require_once $GLOBALS['xoops']->path('www/header.php');
require_once $GLOBALS['xoops']->path('www/class/pagenav.php');
xoops_load('xoopsrequest');

$myts = MyTextSanitizer::getInstance();

// keywords
$prefKeywords = $GLOBALS['xoopsModuleConfig']['keywords'];
$prefKeywords = $myts->undoHtmlSpecialChars($myts->displayTarea($prefKeywords));
if (isset($xoTheme) && is_object($xoTheme)) {
    $xoTheme->addMeta('meta', 'keywords', strip_tags($prefKeywords));
} else { // Compatibility for old Xoops versions
    $xoopsTpl->assign('xoops_meta_keywords', strip_tags($prefKeywords));
}

// description
$prefDesc = _MA_RANDOMQUOTE_DESC;
$prefDesc = $myts->undoHtmlSpecialChars($myts->displayTarea($prefDesc));
if (isset($xoTheme) && is_object($xoTheme)) {
    $xoTheme->addMeta('meta', 'description', strip_tags($prefDesc));
} else { // Compatibility for old Xoops versions
    $xoopsTpl->assign('xoops_meta_description', strip_tags($prefDesc));
}

$GLOBALS['xoopsTpl']->assign(array('xoops_mpageurl'  => $GLOBALS['xoops']->url("www/modules/{$moduleDirName}/index.php"),
                                   'randomquote_url' => $GLOBALS['xoops']->url("www/modules/{$moduleDirName}"),
                                   'adv'             => $GLOBALS['xoopsModuleConfig']['advertise'],
                                   //                                 'social_bookmarks' => $GLOBALS['xoopsModuleConfig']['social_bookmarks'],
                                   //                                       'fbcomments' => $GLOBALS['xoopsModuleConfig']['fbcomments'],
                                   'admin'           => $GLOBALS['xoops']->url("www/modules/{$moduleDirName}/admin/index.php"),
                                   'copyright'       => "<a href='http://xoops.org' title='XOOPS Project' target='_blank'>
                     <img src='" . $GLOBALS['xoops']->url("www/modules/{$moduleDirName}/assets/images/logo_module.png") . "' alt='XOOPS Project'></a>",
                                   'breadcrumb'      => '<a href="' . $GLOBALS['xoops']->url('www') . '">' . _YOURHOME . '</a>  &raquo; ' . $GLOBALS['xoopsModule']->name(),));

$quotesHandler = xoops_getModuleHandler('quotes', $moduleDirName);

$aQuote   = Request::getInt('id', RandomquoteConstants::DEFAULT_ID);
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('quote_status', RandomquoteConstants::STATUS_ONLINE)); //only show online quotes
if ($aQuote) { // this is done to accomodate the tags module
    $criteria->add(new Criteria('id', $aQuote)); // if only want to see a single quote
}
$criteria->setSort('author');
$criteria->setOrder('ASC');
$quoteObjArray = $quotesHandler->getAll($criteria);
$numrows       = (!empty($quoteObjArray)) ? count($quoteObjArray) : 0;
//$numrows    = $quotesHandler->getCount();
//Table view
if ($numrows) {
    $bodyTxt = "<table class='outer width100 outer bspacing1'>\n"
               . "  <thead>\n"
               . "  <tr>\n"
               . "    <th class='txtcenter'>"
               . _MA_RANDOMQUOTE_QUOTES_QUOTE
               . "</th>\n"
               . "    <th class='txtcenter'>"
               . _MA_RANDOMQUOTE_QUOTES_AUTHOR
               . "</th>\n"
               . "  </tr>\n"
               . "  </thead>\n"
               . "  <tbody>\n";

    $class = 'even';

    foreach ($quoteObjArray as $thisQuote) {
        //        if (0 == $quotes_arr[$i]->getVar("quotes_pid")) {
        $class = ('even' == $class) ? 'odd' : 'even';
        $bodyTxt .= "  <tr class='{$class}'>\n" . '    <td> ' . $thisQuote->getVar('quote') . "</td>\n" . "    <td class='txtcenter'>" . $thisQuote->getVar('author') . "</td>\n" . "  </tr>\n";
        $GLOBALS['xoopsTpl']->append('sets', array('quote'  => $thisQuote->getVar('quote'),
                                                   'author' => $thisQuote->getVar('author')));
        //        }
    }
    $bodyTxt .= "  </tbody>\n" . "</table><br><br>\n";
} else {
    $bodyTxt = "<div class='txtcenter bold italic'>\n" . ' ' . _MA_RANDOMQUOTE_NO_QUOTES . "\n" . "</div>\n";
}
$GLOBALS['xoopsTpl']->assign('bodyTxt', $bodyTxt);
//
require_once $GLOBALS['xoops']->path('/footer.php');
