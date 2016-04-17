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

include_once __DIR__ . '/admin_header.php';
//It recovered the value of argument op in URL$
$op = cleanVarsRandomquote($_REQUEST, 'op', 'list', 'string');
switch ($op) {
    case 'list':
    default:
        echo $adminMenu->addNavigation(basename(__FILE__));
        $adminMenu->addItemButton(_AM_RANDOMQUOTE_NEWCITAS, 'main.php?op=new_quote', 'add');
        echo $adminMenu->renderButton('left');
        $criteria = new CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('ASC');
        $numrows    = $quotesHandler->getCount();
        $quotes_arr = $quotesHandler->getall($criteria);

        //Table view
        if ($numrows > 0) {
            echo "<table width='100%' cellspacing='1' class='outer'>
                <tr>
                    <th align=\"center\">" . _AM_RANDOMQUOTE_QUOTES_QUOTE . "</th>
                        <th align=\"center\">" . _AM_RANDOMQUOTE_QUOTES_AUTHOR . "</th>
                        <th align=\"center\">" . _AM_RANDOMQUOTE_QUOTES_STATUS . "</th>
                        <th align=\"center\">" . _AM_RANDOMQUOTE_QUOTES_WAITING . "</th>
                        <th align=\"center\">" . _AM_RANDOMQUOTE_QUOTES_ONLINE . "</th>

                    <th align='center' width='10%'>" . _AM_RANDOMQUOTE_FORMACTION . '</th>
                </tr>';

            $class = 'odd';

            foreach (array_keys($quotes_arr) as $i) {
                if ($quotes_arr[$i]->getVar('quotes_pid') == 0) {
                    echo "<tr class='" . $class . "'>";
                    $class = ($class === 'even') ? 'odd' : 'even';
                    echo '<td>' . $quotes_arr[$i]->getVar('quote') . '</td>';
                    echo "<td align=\"center\">" . $quotes_arr[$i]->getVar('author') . '</td>';

                    $verif_quote_status = ($quotes_arr[$i]->getVar('quote_status') == 1) ? _YES : _NO;
                    echo "<td align=\"center\">" . $verif_quote_status . '</td>';

                    $verif_quote_waiting = ($quotes_arr[$i]->getVar('quote_waiting') == 1) ? _YES : _NO;
                    echo "<td align=\"center\">" . $verif_quote_waiting . '</td>';

                    $verif_quote_online = ($quotes_arr[$i]->getVar('quote_online') == 1) ? _YES : _NO;
                    echo "<td align=\"center\">" . $verif_quote_online . '</td>';

                    echo "<td align='center' width='10%'>
                        <a href='main.php?op=edit_quote&id=" . $quotes_arr[$i]->getVar('id') . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
                        <a href='main.php?op=delete_quote&id=" . $quotes_arr[$i]->getVar('id') . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
                        </td>";
                    echo '</tr>';
                }
            }
            echo '</table><br /><br />';
        }

        break;
    case 'new_quote':
        echo $adminMenu->addNavigation(basename(__FILE__));
        $adminMenu->addItemButton(_AM_RANDOMQUOTE_QUOTESLIST, 'main.php?op=list', 'list');
        echo $adminMenu->renderButton('left');

        $obj  = $quotesHandler->create();
        $form = $obj->getForm();
        $form->display();
        break;
    case 'save_quote':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('main.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (isset($_REQUEST['id'])) {
            $obj = $quotesHandler->get($_REQUEST['id']);
        } else {
            $obj = $quotesHandler->create();
        }

        //Form text
        $obj->setVar('quote', $_REQUEST['quote']);
        //Form autor
        $obj->setVar('author', $_REQUEST['author']);
        //Form quote_status
        $verif_quote_status = ($_REQUEST['quote_status'] == 1) ? '1' : '0';
        $obj->setVar('quote_status', $verif_quote_status);
        //Form quote_waiting
        $verif_quote_waiting = ($_REQUEST['quote_waiting'] == 1) ? '1' : '0';
        $obj->setVar('quote_waiting', $verif_quote_waiting);
        //Form quote_online
        $verif_quote_online = ($_REQUEST['quote_online'] == 1) ? '1' : '0';
        $obj->setVar('quote_online', $verif_quote_online);

        if ($quotesHandler->insert($obj)) {
            redirect_header('main.php?op=list', 2, _AM_RANDOMQUOTE_FORMOK);
        }

        echo $obj->getHtmlErrors();
        $form = $obj->getForm();
        $form->display();
        break;
    case 'edit_quote':
        echo $adminMenu->addNavigation(basename(__FILE__));
        $adminMenu->addItemButton(_AM_RANDOMQUOTE_NEWCITAS, 'main.php?op=new_quote', 'add');
        $adminMenu->addItemButton(_AM_RANDOMQUOTE_QUOTESLIST, 'main.php?op=list', 'list');
        echo $adminMenu->renderButton('left');
        $obj  = $quotesHandler->get($_REQUEST['id']);
        $form = $obj->getForm();
        $form->display();
        break;
    case 'delete_quote':
        $obj = $quotesHandler->get($_REQUEST['id']);
        if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('main.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($quotesHandler->delete($obj)) {
                redirect_header('main.php', 3, _AM_RANDOMQUOTE_FORMDELOK);
            } else {
                echo $obj->getHtmlErrors();
            }
        } else {
            xoops_confirm(array('ok' => 1, 'id' => $_REQUEST['id'], 'op' => 'delete_quote'), $_SERVER['REQUEST_URI'], sprintf(_AM_RANDOMQUOTE_FORMSUREDEL, $obj->getVar('quote')));
        }
        break;
}
include_once __DIR__ . '/admin_footer.php';
