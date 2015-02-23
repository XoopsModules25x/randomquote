<?php
//  ------------------------------------------------------------------------ //
//                      Random Quotes Module for                             //
//               XOOPS - PHP Content Management System 2.0                   //
//                            Versión 1.0.0                                  //
//                   Copyright (c) 2002 Mario Figge                          //
//                       http://www.zona84.com                               //
// ------------------------------------------------------------------------- //

/******************************************************************************
 * Function: random_quote_show
 * Input   : void
 * Output  : $texto: Text of the quote
             $autor: Autor of the quote
 ******************************************************************************/
function random_quote_show() {
    global $xoopsDB;
    $block = array();
    $result = $xoopsDB->query("SELECT texto, autor FROM ".$xoopsDB->prefix("citas")." ORDER BY RAND() LIMIT 1");
    list($texto, $autor)= $xoopsDB->fetchRow($result);
    $block['texto']=$texto;
    $block['autor']=$autor;
    return $block;
}
?>