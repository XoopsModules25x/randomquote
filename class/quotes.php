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
 * Module: RandomQuote
 *
 * @category        Module
 * @package         randomquote
 * @author          XOOPS Module Development Team
 * @author          Mamba
 * @copyright       {@link http://xoops.org The XOOPS Project}
 * @license         {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @link            http://xoops.org XOOPS
 * @since           2.00
 */

// defined('XOOPS_ROOT_PATH') || exit('Restricted access');

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
        $this->initVar('quote', XOBJ_DTYPE_TXTAREA, null, true);
        $this->initVar('author', XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar('quote_status', XOBJ_DTYPE_INT, null, false, 10);
        $this->initVar('create_date', XOBJ_DTYPE_INT, time(), false, 11);
        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('dosmiley', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('doxcode', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('doimage', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('dobr', XOBJ_DTYPE_INT, 1, false);
    }

    /**
     *
     * Magic function to display obj as string
     */
    public function __toString()
    {
        return $this->getVar('quote') . ' -  ' . $this->getVar('author');
    }

    /**
     * Displays the Edit (Create) quote form
     *
     * @param mixed $action
     *
     * @return object {@see XoopsThemeForm)
     */
    public function getForm($action = false)
    {
        if (false === $action) {
            $action = XoopsRequest::getString('REQUEST_URI', '', 'SERVER');
        }

        $title = $this->isNew() ? sprintf(_AM_RANDOMQUOTE_QUOTES_ADD) : sprintf(_AM_RANDOMQUOTE_QUOTES_EDIT);

        xoops_load('constants', 'randomquote');
        include_once $GLOBALS['xoops']->path("/class/xoopsformloader.php");

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');

        $author     = $this->isNew() ? '' : $this->getVar('author');
        $id         = ($this->getVar('id')) ? $this->getVar('id') : RandomquoteConstants::DEFAULT_ID;
        $textAuthor = new XoopsFormText(_AM_RANDOMQUOTE_QUOTES_AUTHOR, 'author', 50, 255, $author);
        $form->addElement($textAuthor);

        $editorConfigs = array('name'   => 'quote',
                               'value'  => $this->getVar('quote', 'e'),
                               'rows'   => 10,
                               'cols'   => 50,
                               'width'  => '100%',
                               'height' => '400px',
                               'editor' => $GLOBALS['xoopsModuleConfig']['randomquote_editor']);
        $form->addElement(new XoopsFormEditor(_AM_RANDOMQUOTE_QUOTES_QUOTE, 'quote', $editorConfigs), true);

        /*
         * pseudo code
         * see if tag module is present & active
         * load the formtag class
         * display the tag form element to collect the tag item
         */
        $moduleHandler = xoops_gethandler('module');
        $tagModule     = XoopsModule::getByDirname('tag');
        if (($tagModule instanceof XoopsModule) && ($tagModule->isactive())) {
            $tagClassExists = XoopsLoad::load('formtag', 'tag');  // get the TagFormTag class
            if ($tagClassExists) {
                if ($this->isNew()) {
                    $tag_items = array();
                } else {
                    $moduleMid  = $GLOBALS['xoopsModule']->mid();
                    $tagHandler = xoops_getmodulehandler('tag', 'tag');
                    $tag_items  = $tagHandler->getByItem($id, $moduleMid, 0);
                }
                $tag_string = implode('|', $tag_items);
                $form->addElement(new TagFormTag('item_tag', 60, 255, $tag_string, 0));
            }
        } else {
            $form->addElement(new XoopsFormHidden('item_tag', ''));
        }

        $quote_status       = ($this->isNew()) ? RandomquoteConstants::STATUS_ONLINE : $this->getVar('quote_status');
        $check_quote_status = new XoopsFormRadio(_AM_RANDOMQUOTE_QUOTES_STATUS, 'quote_status', $quote_status);
        $check_quote_status->addOption(RandomquoteConstants::STATUS_OFFLINE, _AM_RANDOMQUOTE_QUOTES_OFFLINE_TXT);
        $check_quote_status->addOption(RandomquoteConstants::STATUS_ONLINE, _AM_RANDOMQUOTE_QUOTES_ONLINE_TXT);
        $check_quote_status->addOption(RandomquoteConstants::STATUS_WAITING, _AM_RANDOMQUOTE_QUOTES_WAITING_TXT);
        $form->addElement($check_quote_status);

        $form->addElement(new XoopsFormHidden('op', 'save_quote'));
        $form->addElement(new XoopsFormHidden('id', $id));

        //Submit buttons
        $button_tray = new XoopsFormButtonTray('submit', _SUBMIT);
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
     * @param null|object $db
     */
    function __construct(&$db)
    {
        parent::__construct($db, 'randomquote_quotes', 'RandomquoteQuotes', 'id', 'quote');
    }
}
