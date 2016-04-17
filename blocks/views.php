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

include_once XOOPS_ROOT_PATH . '/modules/randomquote/include/functions.php';

/**
 * @param $options
 *
 * @return array
 */
function showRandomquoteBlockViews($options)
{
    include_once XOOPS_ROOT_PATH . '/modules/randomquote/class/quotes.php';
    //    $myts = MyTextSanitizer::getInstance();

    $citas      = array();
    $type_block = $options[0];
    $nb_quotes  = $options[1];
    //    $lenght_title = $options[2];

    $quotesHandler = xoops_getModuleHandler('quotes', 'randomquote');
    $criteria      = new CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);

    switch ($type_block) {
        // for block: citas recent
        case 'recent':
            $criteria->add(new Criteria('quote_online', 1));
            //            $criteria->setSort("quotes_date_created");
            $criteria->setSort('id');
            $criteria->setOrder('DESC');
            break;
        // for block: citas today's
        case 'day':
            $criteria->add(new Criteria('quote_online', 1));
            //            $criteria->add(new Criteria("quotes_date_created", strtotime(date("Y/m/d")), ">="));
            //            $criteria->add(new Criteria("quotes_date_created", strtotime(date("Y/m/d")) + 86400, "<="));
            //            $criteria->setSort("quotes_date_created");
            $criteria->setOrder('ASC');
            $criteria->setSort('RAND()');
            break;
        // for block: citas random
        case 'random':
            $criteria->add(new Criteria('quote_online', 1));
            $criteria->setSort('RAND()');
            break;
    }

    $criteria->setLimit($nb_quotes);
    $quotes_arr = $quotesHandler->getall($criteria);
    foreach (array_keys($quotes_arr) as $i) {
        $citas[$i]['quote']  = $quotes_arr[$i]->getVar('quote');
        $citas[$i]['author'] = $quotes_arr[$i]->getVar('author');
    }

    return $citas;
}

/**
 * @param $options
 *
 * @return string
 */
function editRandomquoteBlockViews($options)
{
    $quotes_arr = array();
    $form       = '' . _MB_RANDOMQUOTE_QUOTES_DISPLAY . "\n";
    $form .= "<input type=\"hidden\" name=\"options[0]\" value=\"" . $options[0] . "\" />";
    $form .= "<input name=\"options[1]\" size=\"5\" maxlength=\"255\" value=\"" . $options[1] . "\" type=\"text\" />&nbsp;<br />";
    $form .= '' . _MB_RANDOMQUOTE_QUOTES_TITLELENGTH . " : <input name=\"options[2]\" size=\"5\" maxlength=\"255\" value=\"" . $options[2] . "\" type=\"text\" /><br /><br />";
    array_shift($options);
    array_shift($options);
    array_shift($options);
    $form .= '' . _MB_RANDOMQUOTE_QUOTES_CATTODISPLAY . "<br /><select name=\"options[]\" multiple=\"multiple\" size=\"5\">";
    $form .= "<option value=\"0\" " . (array_search(0, $options) === false ? '' : "selected=\"selected\"") . '>' . _MB_RANDOMQUOTE_QUOTES_ALLCAT . '</option>';
    foreach (array_keys($quotes_arr) as $i) {
        $form .= "<option value=\"" . $quotes_arr[$i]->getVar('quotes_id') . "\" " . (array_search($quotes_arr[$i]->getVar('quotes_id'), $options) === false ? '' : "selected=\"selected\"") . '>' . $quotes_arr[$i]->getVar('quotes_title') . '</option>';
    }
    $form .= '</select>';

    return $form;
}
