<?php
//  ------------------------------------------------------------------------ //
//                      Random Quotes Module for                             //
//               XOOPS - PHP Content Management System 2.0                   //
//                            Versión 1.0.0                                  //
//                   Copyright (c) 2002 Mario Figge                          //
//                       http://www.zona84.com                               //
// ------------------------------------------------------------------------- //

include "../../../mainfile.php";
include_once XOOPS_ROOT_PATH."/class/xoopsmodule.php";
include XOOPS_ROOT_PATH."/include/cp_functions.php";
if ( $xoopsUser ) {
    $xoopsModule = XoopsModule::getByDirname("randomquote");
    if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
        redirect_header(XOOPS_URL."/",3,_NOPERM);
        exit();
    }
} else {
    redirect_header(XOOPS_URL."/",3,_NOPERM);
    exit();
}
if ( file_exists("../language/".$xoopsConfig['language']."/main.php") ) {
    include "../language/".$xoopsConfig['language']."/main.php";
} else {
    include "../language/english/main.php";
}
