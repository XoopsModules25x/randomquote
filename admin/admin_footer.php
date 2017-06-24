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

$pathIcon32      = Xmf\Module\Admin::iconUrl('', 32);

echo "<div class='adminfooter'>\n"
     ."  <div style='text-align: center;'>\n"
     ."    <a href='http://www.xoops.org' rel='external'><img src='{$pathIcon32}/xoopsmicrobutton.gif' alt='XOOPS' title='XOOPS'></a>\n"
     ."  </div>\n"
     .'  ' . _AM_MODULEADMIN_ADMIN_FOOTER . "\n"
     .'</div>';

xoops_cp_footer();

/*
echo "<div class='adminfooter'>\n"
     . "  <div class='center'>\n"
     . "    <a href='"
     . $GLOBALS['xoopsModule']->getInfo('author_website_url')
     . "' target='_blank'><img src='{$pathIcon32}/xoopsmicrobutton.gif' alt='"
     . $GLOBALS['xoopsModule']->getInfo('author_website_name')
     . "' title='"
     . $GLOBALS['xoopsModule']->getInfo('author_website_name')
     . "'></a>\n"
     . "  </div>\n"
     . "  <div class='center smallsmall italic pad5'>\n"
     . '    '
     . _AM_RANDOMQUOTE_MAINTAINED_BY
     . " <a class='tooltip' rel='external' href='http://"
     . $GLOBALS['xoopsModule']->getInfo('module_website_url')
     . "' "
     . "title='"
     . _AM_RANDOMQUOTE_MAINTAINED_TITLE
     . "'>"
     . _AM_RANDOMQUOTE_MAINTAINED_TEXT
     . "</a>\n"
     . "  </div>\n"
     . '</div>';
xoops_cp_footer();
*/
