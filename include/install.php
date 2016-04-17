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

$indexFile = 'index.html';
$blankFile = XOOPS_ROOT_PATH . '/modules/randomquote/assets/images/icons/blank.gif';

//Creation du dossier "uploads" pour le module à la racine du site
$module_uploads = XOOPS_ROOT_PATH . '/uploads/randomquote';
if (!is_dir($module_uploads)) {
    //    mkdir($module_uploads, 0777);
    if (!@mkdir($module_uploads, 0757) && !is_dir($module_uploads)) {
        throw Exception("Couldn't create this directory: " . $module_uploads);
    }
}
chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH . '/uploads/randomquote/index.html');

//Creation du fichier citas dans uploads
$module_uploads = XOOPS_ROOT_PATH . '/uploads/randomquote/citas';
if (!is_dir($module_uploads)) {
    //    mkdir($module_uploads, 0777);
    if (!@mkdir($module_uploads, 0757) && !is_dir($module_uploads)) {
        throw Exception("Couldn't create this directory: " . $module_uploads);
    }
}
chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH . '/uploads/randomquote/citas/index.html');
