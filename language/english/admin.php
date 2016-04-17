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

//Menu
define('_AM_RANDOMQUOTE_STATISTICS', 'Random Quote Statistics');
define('_AM_RANDOMQUOTE_THEREARE_CITAS', "There are <span class='bold'>%s</span> Quotes in the Database"); //Buttons
define('_AM_RANDOMQUOTE_NEWCITAS', 'Add New quote');
define('_AM_RANDOMQUOTE_QUOTESLIST', 'List quotes');
//Index

//General
define('_AM_RANDOMQUOTE_FORMOK', 'Quote added successfully');
define('_AM_RANDOMQUOTE_FORMDELOK', 'Deleted successfully');
define('_AM_RANDOMQUOTE_FORMSUREDEL', "Are you sure to Delete: <span style='font-weight: bold; color: Red;'> %s </span>");
define('_AM_RANDOMQUOTE_FORMSURERENEW', "Are you sure to Update: <span style='font-weight: bold; color: Red;'> %s </span>");
define('_AM_RANDOMQUOTE_FORMUPLOAD', 'Upload');
define('_AM_RANDOMQUOTE_FORMIMAGE_PATH', 'File presents in %s');
define('_AM_RANDOMQUOTE_FORMACTION', 'Action');
define('_AM_RANDOMQUOTE_QUOTES_ADD', 'Add a quote');
define('_AM_RANDOMQUOTE_QUOTES_EDIT', 'Edit a quote');
define('_AM_RANDOMQUOTE_QUOTES_DELETE', 'Delete a quote');
define('_AM_RANDOMQUOTE_QUOTES_ID', 'Id');
define('_AM_RANDOMQUOTE_QUOTES_QUOTE', 'Quote');
define('_AM_RANDOMQUOTE_QUOTES_AUTHOR', 'Author');
define('_AM_RANDOMQUOTE_QUOTES_STATUS', 'Status');
define('_AM_RANDOMQUOTE_QUOTES_WAITING', 'Waiting');
define('_AM_RANDOMQUOTE_QUOTES_ONLINE', 'Online');

//Blocks.php
define('_AM_RANDOMQUOTE_QUOTES_BLOCK_DAY', 'Quote of Today');
define('_AM_RANDOMQUOTE_QUOTES_BLOCK_RANDOM', 'Random Quote');
define('_AM_RANDOMQUOTE_QUOTES_BLOCK_RECENT', 'Recent Quote');

//Permissions
define('_AM_RANDOMQUOTE_PERMISSIONS_ACCESS', 'Permissions to access');
define('_AM_RANDOMQUOTE_PERMISSIONS_VIEW', 'Permissions to view');
define('_AM_RANDOMQUOTE_PERMISSIONS_SUBMIT', 'Permissions to submit');
//Error NoFrameworks
define('_AM_ERROR_NOFRAMEWORKS', "Error: You don&#39;t use the Frameworks 'admin module'. Please install this Frameworks");
define('_AM_RANDOMQUOTE_MAINTAINEDBY', 'is maintained by the');

define('_AM_RANDOMQUOTE_UPGRADEFAILED0', "Update failed - couldn't rename field 'citas'");
define('_AM_RANDOMQUOTE_UPGRADEFAILED1', "Update failed - couldn't add new fields");
define('_AM_RANDOMQUOTE_UPGRADEFAILED2', "Update failed - couldn't rename table 'citas'");
