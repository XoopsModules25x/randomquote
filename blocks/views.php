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

$moduleDirName = basename(dirname(__DIR__));
require_once $GLOBALS['xoops']->path("/modules/{$moduleDirName}/class/constants.php");

/**
 *
 * Show a random quote in a block
 *
 * @param array    {
 * @param string   [0] block type
 * @param int      [1] number of quotes to display
 *                 }
 *
 * @return array {
 *                 array {
 * @param string   [quote]
 * @param string   [author]
 *                 }
 *                 }
 */
function showRandomquoteBlockViews($options)
{
    $moduleDirName = basename(dirname(__DIR__));

    //    xoops_load('constants', 'randomquote');

    $citas         = array();
    $type_block    = $options[0];
    $nb_quotes     = (int)$options[1];
    $length_title  = (int)$options[2];
    $quotesHandler = xoops_getModuleHandler('quotes', $moduleDirName);
    $criteria      = new CriteriaCompo();

    switch ($type_block) {
        case 'recent':
            $criteria->add(new Criteria('quote_status', RandomquoteConstants::STATUS_ONLINE));
            $criteria->setSort('create_date');
            $criteria->setOrder('DESC');
            break;

        case 'day':
            $criteria->add(new Criteria('quote_status', RandomquoteConstants::STATUS_ONLINE));
            $criteria->add(new Criteria('create_date', strtotime(date('Y/m/d')), '>='));
            $criteria->add(new Criteria('create_date', strtotime(date('Y/m/d')) + 86400, '<='));
            $criteria->setSort('create_date');
            $criteria->setOrder('ASC');
            //            $criteria->setSort('RAND()');
            break;

        case 'random':
        default:
            $criteria->add(new Criteria('quote_status', RandomquoteConstants::STATUS_ONLINE));
            $criteria->setSort('RAND()');
            break;
    }

    if ((int)$nb_quotes > 0) {
        $criteria->setLimit($nb_quotes);
    }
    $quoteObjsArray = $quotesHandler->getAll($criteria);
    foreach ($quoteObjsArray as $thisQuote) {
        if ($length_title > 0) {
            $short_quote = xoops_substr($thisQuote->getVar('quote'), 0, $length_title, $trimmarker = '...');
        } else {
            $short_quote = $thisQuote->getVar('quote');
        }
        $citas[] = array('quote'  => $short_quote,
                         'author' => $thisQuote->getVar('author'));
    }

    return $citas;
}

/**
 * @param array $options Preferences config array
 *
 * @return string HTML form to edit module options
 */
function editRandomquoteBlockViews($options)
{
    $quotes_arr = array();
    $form       = ''
                  . _MB_RANDOMQUOTE_QUOTES_DISPLAY
                  . "\n"
                  . "<input type='hidden' name='options[0]' value='{$options[0]}'>\n"
                  . "<input type='text' name='options[1]' value='{$options[1]}' size='3' maxlength='4'>&nbsp;<br>\n"
                  . ''
                  . _MB_RANDOMQUOTE_QUOTES_SHORTEN
                  . " <input type='number' name='options[2]' value='{$options[2]} size='3' maxlength='5'' min='0' step='5'> "
                  . _MB_RANDOMQUOTE_QUOTES_CHARACTERS
                  . '<br><br>';
    /*
        array_shift($options);
        array_shift($options);
        array_shift($options);
        $form .= "" . _MB_RANDOMQUOTE_QUOTES_CATTODISPLAY . "<br>\n"
               . "<select name='options[]' multiple='multiple' size='5'>\n"
               . "<option value='0'" . (false === array_search(0, $options) ? "" : " selected='selected'") . ">" . _MB_RANDOMQUOTE_QUOTES_ALLCAT . "</option>\n";
        foreach (array_keys($quotes_arr) as $i) {
            $form .= "<option value='" . $quotes_arr[$i]->getVar('quotes_id') . "'" . (false === array_search($quotes_arr[$i]->getVar('quotes_id'), $options) ? '' : " selected='selected'") . ">"
                   . $quotes_arr[$i]->getVar('quotes_title') . "</option>\n";
        }
        $form .= "</select>\n";
    */
    return $form;
}
