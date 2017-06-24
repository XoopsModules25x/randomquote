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

// defined('XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');

$moduleDirName = basename(__DIR__);
xoops_load('XoopsLists');
xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();

$modversion = array(
    'version'             => '2.11',
    'module_status'       => 'RC 1',
    'release_date'        => '2016/6/23',
    'name'                => _MI_RANDOMQUOTE_ADMIN_NAME,
    'description'         => _MI_RANDOMQUOTE_ADMIN_DESC,
    'official'            => 0,
    //1 if supported by XOOPS CORE Dev Team, 0 otherwise
    'author'              => 'XOOPS Module Development Team',
    //          'author_mail' => 'webmaster@xoops.org',
    'author_website_url'  => 'http://xoops.org',
    'author_website_name' => 'XOOPS Project',
    'credits'             => 'XOOPS Module Development Team',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'www.gnu.org/licenses/gpl-2.0.html',
    'help'                => 'page=help',
    'helpsection'         => array(
        array(
            'name' => _MI_RANDOMQUOTE_ADMIN_HELP,
            'link' => 'page=help'
        ),
        array(
            'name' => _MI_RANDOMQUOTE_ADMIN_HELP_FEATURES,
            'link' => 'page=module_index'
        )
    ),

    //                  'manual' => 'install.txt',
    //             'manual_file' => XOOPS_URL . "/modules/{$moduleDirName}/docs/link to manual file",
    'min_php'             => '5.5',
    'min_xoops'           => '2.5.8',
    'min_admin'           => '1.2',
    'min_db'              => array('mysql' => '5.5'),
    'image'               => 'assets/images/logoModule.png',
    'dirname'             => $moduleDirName,

    'modicons16'          => 'assets/images/icons/16',
    'modicons32'          => 'assets/images/icons/32',

    // About
    //            'release_info' => 'module_release_info',
    //            'release_file' => XOOPS_URL . "/modules/{$moduleDirName}/docs/module_release_info file",
    //           'demo_site_url' => "http://xoops.org",
    //          'demo_site_name' => 'XOOPS Demo Site',
    //          'forum_site_url' => "http://xoops.org",
    //         'forum_site_name' => 'XOOPS Project',
    'module_website_url'  => 'http://xoops.org/modules/newbb',
    'module_website_name' => 'XOOPS Project',

    // Admin things
    'hasAdmin'            => 1,
    // Admin system menu
    'system_menu'         => 1,
    'hasMain'             => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    // Mysql file
    'sqlfile'             => array('mysql' => 'sql/mysql.sql'),
    // Tables
    'tables'              => array("{$moduleDirName}_quotes"),

    // Scripts to run upon installation or update
    'onInstall'           => 'include/oninstall.php',
    'onUpdate'            => 'include/onupdate.php',
    'onUninstall'         => 'include/onuninstall.php',

    // Search
    'hasSearch'           => 1,
    'search'              => array(
        'file' => 'include/search.inc.php',
        'func' => $moduleDirName . '_search'
    ),
    // Templates
    'templates'           => array(
        array(
            'file'        => $moduleDirName . '_index.tpl',
            'description' => 'randomquote index page'
        ),
        /*
                                            array('file' => $moduleDirName . '_quotes.tpl',
                                           'description' => 'randomquote quotes page'),
        */
        array(
            'file'        => $moduleDirName . '_header.tpl',
            'description' => 'randomquote header page'
        ),

        array(
            'file'        => $moduleDirName . '_footer.tpl',
            'description' => 'randomquote footer page'
        )
    ),
    //Blocks
    'blocks'              => array(
        array(
            'file'        => 'views.php',
            'name'        => _MI_RANDOMQUOTE_QUOTES_BLOCK_RECENT,
            'description' => _MI_RANDOMQUOTE_QUOTES_BLOCK_RECENT_DESC,
            'show_func'   => 'showRandomquoteBlockViews',
            'edit_func'   => 'editRandomquoteBlockViews',
            'options'     => 'recent|5|25|0',
            'template'    => $moduleDirName . '_quotes_block_recent.tpl'
        ),

        array(
            'file'        => 'views.php',
            'name'        => _MI_RANDOMQUOTE_QUOTES_BLOCK_DAY,
            'description' => _MI_RANDOMQUOTE_QUOTES_BLOCK_DAY_DESC,
            'show_func'   => 'showRandomquoteBlockViews',
            'edit_func'   => 'editRandomquoteBlockViews',
            'options'     => 'day|5|25|0',
            'template'    => $moduleDirName . '_quotes_block_day.tpl'
        ),

        array(
            'file'        => 'views.php',
            'name'        => _MI_RANDOMQUOTE_QUOTES_BLOCK_RANDOM,
            'description' => _MI_RANDOMQUOTE_QUOTES_BLOCK_RANDOM_DESC,
            'show_func'   => 'showRandomquoteBlockViews',
            'edit_func'   => 'editRandomquoteBlockViews',
            'options'     => 'random|5|25|0',
            'template'    => $moduleDirName . '_quotes_block_random.tpl'
        )
    ),

    // Config
    'config'              => array(
        array(
            'name'        => 'randomquote_editor',
            'title'       => '_MI_RANDOMQUOTE_EDITOR',
            'description' => '_MI_RANDOMQUOTE_EDITOR_DESC',
            'formtype'    => 'select',
            'valuetype'   => 'text',
            'default'     => 'dhtml',
            'options'     => array_flip($editorHandler->getList())
        ),

        array(
            'name'        => 'keywords',
            'title'       => '_MI_RANDOMQUOTE_KEYWORDS',
            'description' => '_MI_RANDOMQUOTE_KEYWORDS_DESC',
            'formtype'    => 'textbox',
            'valuetype'   => 'text',
            'default'     => ''
        ),

        array(
            'name'        => 'advertise',
            'title'       => '_MI_RANDOMQUOTE_ADVERTISE',
            'description' => '_MI_RANDOMQUOTE_ADVERTISE_DESC',
            'formtype'    => 'textarea',
            'valuetype'   => 'text',
            'default'     => ''
        ),
        /*
                                                    array('name' => 'social_bookmarks',
                                                         'title' => '_MI_RANDOMQUOTE_SOCIAL_BOOKMARKS',
                                                   'description' => '_MI_RANDOMQUOTE_SOCIAL_BOOKMARKS_DESC',
                                                      'formtype' => 'yesno',
                                                     'valuetype' => 'int',
                                                       'default' => 0),

                                                    array('name' => 'fbcomments',
                                                         'title' => '_MI_RANDOMQUOTE_FBCOMMENTS',
                                                   'description' => '_MI_RANDOMQUOTE_FBCOMMENTS_DESC',
                                                      'formtype' => 'yesno',
                                                     'valuetype' => 'int',
                                                       'default' => 0)
                */
    )
);
