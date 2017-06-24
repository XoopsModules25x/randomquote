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
use Xmf\Request;

require_once __DIR__ . '/admin_header.php';
xoops_cp_header();

$op = Request::getCmd('op', '');

switch ($op) {
    case 'list':
    default:
       $adminObject->displayNavigation(basename(__FILE__));
       $adminObject->addItemButton(_AM_RANDOMQUOTE_NEW_QUOTES, 'main.php?op=new_quote', 'add');
       $adminObject->displayButton('left');
        $criteria = new CriteriaCompo();
        if (isset($_REQUEST['status'])) {
            $status = Request::getInt('status', RandomquoteConstants::STATUS_ONLINE);
            $criteria->add(new Criteria('quote_status', $status));
        } else {
            $criteria->setSort('id');
        }
        $criteria->setOrder('ASC');
        $quotesObjArray = $quotesHandler->getAll($criteria);
        $quoteCount     = (!empty($quotesObjArray) ? count($quotesObjArray) : 0);

        //Table view
        if ($quoteCount) {
            echo "\n"
                 . "<table class='outer width100 bspacing1'>\n"
                 . "<thead>\n"
                 . "  <tr>\n"
                 . "    <th class='txtcenter width5'>"
                 . _AM_RANDOMQUOTE_QUOTES_STATUS
                 . "</th>\n"
                 . "    <th class='txtcenter width10'>"
                 . _AM_RANDOMQUOTE_QUOTES_DATE
                 . "</th>\n"
                 . "    <th class='txtcenter'>"
                 . _AM_RANDOMQUOTE_QUOTES_QUOTE
                 . "</th>\n"
                 . "    <th class='txtcenter width20'>"
                 . _AM_RANDOMQUOTE_QUOTES_AUTHOR
                 . "</th>\n"
                 . "    <th class='txtcenter width10'>"
                 . _AM_RANDOMQUOTE_FORMACTION
                 . "</th>\n"
                 . "  </tr>\n"
                 . "  </thead>\n"
                 . "  <tbody>\n";

            $class = 'even';

            $statusIcons = array(RandomquoteConstants::STATUS_OFFLINE => array('image' => 'off.png', 'text' => _AM_RANDOMQUOTE_QUOTES_OFFLINE_TXT),
                                 RandomquoteConstants::STATUS_ONLINE  => array('image' => 'on.png', 'text' => _AM_RANDOMQUOTE_QUOTES_ONLINE_TXT),
                                 RandomquoteConstants::STATUS_WAITING => array('image' => 'warning.png', 'text' => _AM_RANDOMQUOTE_QUOTES_WAITING_TXT));
            foreach ($quotesObjArray as $quoteObj) {
                //            foreach (array_keys($quotes_arr) as $i) {
                $class             = ('even' == $class) ? 'odd' : 'even';
                $thisStatus        = $quoteObj->getVar('quote_status');
                $quote_status_link = "<img src='{$pathIcon16}/{$statusIcons[$thisStatus]['image']}'" . " alt='{$statusIcons[$thisStatus]['text']}'" . " title='{$statusIcons[$thisStatus]['text']}'>";
                echo "  <tr class='{$class}'>\n"
                     . "    <td class='txtcenter'>"
                     . $quote_status_link
                     . "</td>\n"
                     . "    <td class='txtcenter'>"
                     . ucfirst(formatTimestamp(strtotime($quoteObj->getVar('create_date')), 'm'))
                     . "</td>\n"
                     . '    <td>'
                     . $quoteObj->getVar('quote')
                     . "</td>\n"
                     . "    <td class='txtcenter'>"
                     . $quoteObj->getVar('author')
                     . "</td>\n"
                     . "    <td class='txtcenter'>\n"
                     . "      <a href='./main.php?op=edit_quote&id="
                     . $quoteObj->getVar('id')
                     . "'><img src='{$pathIcon16}/edit.png' alt='"
                     . _EDIT
                     . "' title='"
                     . _EDIT
                     . "'></a>\n"
                     . "      <a href='./main.php?op=delete_quote&id="
                     . $quoteObj->getVar('id')
                     . "'><img src='{$pathIcon16}/delete.png' alt='"
                     . _DELETE
                     . "' title='"
                     . _DELETE
                     . "'></a>\n"
                     . "    </td>\n"
                     . "  </tr>\n";
            }
            echo "  </tbody>\n" . "</table><br><br>\n";
        } else {
            //no quotes in the dB
            echo "<div class=\"clear spacer;\"> </div>\n"
                 . '<div class="center bold italic large line180">'
                 . sprintf(_AM_RANDOMQUOTE_THEREARE_QUOTES, _NO)
                 . "</div>\n"
                 . "<div class=\"clear spacer line180\"> </div>\n";
        }
        break;

    case 'new_quote':
       $adminObject->displayNavigation(basename(__FILE__));
       $adminObject->addItemButton(_AM_RANDOMQUOTE_QUOTES_LIST, 'main.php?op=list', 'list');
       $adminObject->displayButton('left');

        $obj  = $quotesHandler->create();
        $form = $obj->getForm();
        $form->display();
        break;

    case 'save_quote':
        // check to make sure this passes form submission security
        if ($GLOBALS['xoopsSecurity'] instanceof XoopsSecurity) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                // failed xoops security check
                redirect_header($_SERVER['PHP_SELF'], RandomquoteConstants::REDIRECT_DELAY_MEDIUM, $GLOBALS['xoopsSecurity']->getErrors(true));
            }
        } else {
            redirect_header('index.php', RandomquoteConstants::REDIRECT_DELAY_MEDIUM, _MD_RANDOMQUOTE_INVALID_SECURITY_TOKEN);
        }

        $input = new stdClass; // setup input array

        $input->id       = Request::getInt('id', RandomquoteConstants::DEFAULT_ID, 'POST');
        $input->quote    = Request::getText('quote', '', 'POST');
        $input->author   = Request::getText('author', '', 'POST');
        $input->item_tag = Request::getString('item_tag', '', 'POST');

        $verify_quote_status = Request::getInt('quote_status', RandomquoteConstants::STATUS_OFFLINE, 'POST');
        $input->quote_status = in_array($verify_quote_status, array(RandomquoteConstants::STATUS_ONLINE,
                                                                     RandomquoteConstants::STATUS_OFFLINE,
                                                                     RandomquoteConstants::STATUS_WAITING)) ? $verify_quote_status : RandomquoteConstants::STATUS_OFFLINE;

        if (!empty($input->id)) {
            $obj     = $quotesHandler->get($input->id);
            $add_msg = _AM_RANDOMQUOTE_FORM_UPDATE_OK;
        } else {
            $obj     = $quotesHandler->create();
            $add_msg = _AM_RANDOMQUOTE_FORM_ADD_OK;
        }

        $obj->setVars(array('quote'        => $input->quote,
                            'author'       => $input->author,
                            'quote_status' => $input->quote_status));

        if ($objId = $quotesHandler->insert($obj)) {
            //            $moduleHandler = xoops_gethandler('module');
            $tagModule = XoopsModule::getByDirname('tag');
            if (($tagModule instanceof XoopsModule) && $tagModule->isactive()) {
                $tagHandler = xoops_getModuleHandler('tag', 'tag');
                $tagHandler->updateByItem($input->item_tag, $objId, $thisDirname, 0);
            }
            redirect_header('main.php?op=list', RandomquoteConstants::REDIRECT_DELAY_MEDIUM, $add_msg);
        }

        echo $obj->getHtmlErrors();
        $form = $obj->getForm();
        $form->display();
        break;

    case 'edit_quote':
       $adminObject->displayNavigation(basename(__FILE__));
       $adminObject->addItemButton(_AM_RANDOMQUOTE_NEW_QUOTES, 'main.php?op=new_quote', 'add');
       $adminObject->addItemButton(_AM_RANDOMQUOTE_QUOTES_LIST, 'main.php?op=list', 'list');
       $adminObject->displayButton('left');
        $id = Request::getInt('id', RandomquoteConstants::DEFAULT_ID);
        if (empty($id)) {
            redirect_header($_SERVER['PHP_SELF'] . '?op=new_quote');
        }
        $obj  = $quotesHandler->get($id);
        $form = $obj->getForm();
        $form->display();
        break;

    case 'delete_quote':
        $delOk = Request::getInt('ok', RandomquoteConstants::CONFIRM_NOT_OK, 'POST');
        $id    = Request::getInt('id', RandomquoteConstants::DEFAULT_ID);
        if ($delOk) {
            // check to make sure this passes form submission security
            if ($GLOBALS['xoopsSecurity'] instanceof XoopsSecurity) {
                if (!$GLOBALS['xoopsSecurity']->check()) {
                    // failed xoops security check
                    redirect_header($_SERVER['PHP_SELF'], RandomquoteConstants::REDIRECT_DELAY_MEDIUM, $GLOBALS['xoopsSecurity']->getErrors(true));
                }
            } else {
                redirect_header('index.php', RandomquoteConstants::REDIRECT_DELAY_MEDIUM, _MD_RANDOMQUOTE_INVALID_SECURITY_TOKEN);
            }
            $obj = $quotesHandler->get($id);
            if ($obj instanceof RandomquoteQuotes) {
                $itemId = $obj->getVar('id');
                if ($quotesHandler->delete($obj)) {
                    // now clear out items in tag module for this item
                    $moduleHandler = xoops_getHandler('module');
                    $tagModule     = XoopsModule::getByDirname('tag');
                    if (($tagModule instanceof XoopsModule) && $tagModule->isactive()) {
                        $tagHandler = xoops_getModuleHandler('tag', 'tag');
                        $tagHandler->updateByItem(array(), $itemId, $thisDirname);  //clear all tags for this item
                    }
                    redirect_header($_SERVER['PHP_SELF'], RandomquoteConstants::REDIRECT_DELAY_MEDIUM, _AM_RANDOMQUOTE_FORMDELOK);
                } else {
                    echo $obj->getHtmlErrors();
                }
            } else {
                redirect_header($_SERVER['PHP_SELF'], RandomquoteConstants::REDIRECT_DELAY_MEDIUM, _AM_RANDOMQUOTE_INVALID_QUOTE_ID);
            }
        } else {
            $obj = $quotesHandler->get($id);
            xoops_confirm(array('ok' => RandomquoteConstants::CONFIRM_OK, 'id' => $id, 'op' => 'delete_quote'), $_SERVER['REQUEST_URI'], sprintf(_AM_RANDOMQUOTE_FORMSUREDEL, $obj));
        }
        break;
}
require_once __DIR__ . '/admin_footer.php';
