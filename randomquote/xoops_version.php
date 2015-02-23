<?php
//  ------------------------------------------------------------------------ //
//                      Random Quotes Module for                             //
//               XOOPS - PHP Content Management System 2.0                   //
//                            Versi�n 1.0.0                                  //
//                   Copyright (c) 2002 Mario Figge                          //
//                       http://www.zona84.com                               //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
$modversion['name'] = _RQ_NAME;
$modversion['version'] = 1.20;
$modversion['description'] = _RQ_DESC;
$modversion['credits'] = "Chefry";
$modversion['author'] = "Mario Figge http://www.zona84.com/";
$modversion['help'] = "randomquote.html";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 1;
$modversion['image'] = "images/slogo.png";
$modversion['dirname'] = "randomquote";

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
//$modversion['sqlfile']['postgresql'] = "sql/pgsql.sql";

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = "citas";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Blocks
$modversion['blocks'][1]['file'] = "random_quote.php";
$modversion['blocks'][1]['name'] = _RQ_BNAME;
$modversion['blocks'][1]['description'] = _RQ_BDESC;
$modversion['blocks'][1]['show_func'] = "random_quote_show";
$modversion['blocks'][1]['template'] = 'random_quote_block.html';

?>