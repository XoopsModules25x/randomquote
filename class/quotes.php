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

// defined('XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');

/**
 * Class RandomquoteQuotes
 */
class RandomquoteQuotes extends XoopsObject
{
    //Constructor
    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->initVar('id', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('quote', XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar('author', XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar('quote_status', XOBJ_DTYPE_INT, null, false, 10);
        $this->initVar('quote_waiting', XOBJ_DTYPE_INT, null, false, 10);
        $this->initVar('quote_online', XOBJ_DTYPE_INT, null, false, 1);

        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('dosmiley', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('doxcode', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('doimage', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('dobr', XOBJ_DTYPE_INT, 1, false);
    }

    /**
     * @param bool $action
     *
     * @return XoopsThemeForm
     */
    public function getForm($action = false)
    {
        if ($action === false) {
            $action = XoopsRequest::getString('REQUEST_URI','','SERVER');
        }

        $title = $this->isNew() ? sprintf(_AM_RANDOMQUOTE_QUOTES_ADD) : sprintf(_AM_RANDOMQUOTE_QUOTES_EDIT);

        include_once(XOOPS_ROOT_PATH . '/class/xoopsformloader.php');

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');

        $author     = $this->isNew() ? '' : $this->getVar('author');
        $textAuthor = new XoopsFormText(_AM_RANDOMQUOTE_QUOTES_AUTHOR, 'author', 50, 255, $author);
        $form->addElement($textAuthor);

        $editorConfigs           = array();
        $editorConfigs['name']   = 'quote';
        $editorConfigs['value']  = $this->getVar('quote', 'e');
        $editorConfigs['rows']   = 10;
        $editorConfigs['cols']   = 80;
        $editorConfigs['width']  = '100%';
        $editorConfigs['height'] = '400px';
        $editorConfigs['editor'] = $GLOBALS['xoopsModuleConfig']['randomquote_editor'];
        $form->addElement(new XoopsFormEditor(_AM_RANDOMQUOTE_QUOTES_QUOTE, 'quote', $editorConfigs), true);

        $quote_status       = $this->isNew() ? 0 : $this->getVar('quote_status');
        $check_quote_status = new XoopsFormCheckBox(_AM_RANDOMQUOTE_QUOTES_STATUS, 'quote_status', $quote_status);
        $check_quote_status->addOption(1, ' ');
        $form->addElement($check_quote_status);
        $quote_waiting       = $this->isNew() ? 0 : $this->getVar('quote_waiting');
        $check_quote_waiting = new XoopsFormCheckBox(_AM_RANDOMQUOTE_QUOTES_WAITING, 'quote_waiting', $quote_waiting);
        $check_quote_waiting->addOption(1, ' ');
        $form->addElement($check_quote_waiting);
        $quote_online       = $this->isNew() ? 0 : $this->getVar('quote_online');
        $check_quote_online = new XoopsFormCheckBox(_AM_RANDOMQUOTE_QUOTES_ONLINE, 'quote_online', $quote_online);
        $check_quote_online->addOption(1, ' ');
        $form->addElement($check_quote_online);

        $form->addElement(new XoopsFormHidden('op', 'save_quote'));

        //Submit buttons
        $button_tray   = new XoopsFormElementTray('', '');
        $submit_button = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
        $button_tray->addElement($submit_button);

        $cancel_button = new XoopsFormButton('', '', _CANCEL, 'cancel');
        $cancel_button->setExtra('onclick="history.go(-1)"');
        $button_tray->addElement($cancel_button);

        $form->addElement($button_tray);

        return $form;
    }
}

/**
 * Class RandomquoteQuotesHandler
 */
class RandomquoteQuotesHandler extends XoopsPersistableObjectHandler
{
    /**
     * @param null|XoopsDatabase $db
     */
    public function __construct(XoopsDatabase $db)
    {
        parent::__construct($db, 'randomquote_quotes', 'RandomquoteQuotes', 'id', 'quote');
    }
}
