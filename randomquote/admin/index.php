<?php
//  ------------------------------------------------------------------------ //
//                      Random Quotes Module for                             //
//               XOOPS - PHP Content Management System 2.0                   //
//                            Versión 1.0.0                                  //
//                   Copyright (c) 2002 Mario Figge                          //
//                       http://www.zona84.com                               //
// ------------------------------------------------------------------------- //

include_once "admin_header.php";

$op = "list";

if (isset($HTTP_GET_VARS)) {
    foreach ($HTTP_GET_VARS as $k => $v) {
        $$k = $v;
    }
}

if (isset($HTTP_POST_VARS)) {
    foreach ($HTTP_POST_VARS as $k => $v) {
        $$k = $v;
    }
}

if(isset($_GET) && isset($_GET['op'])) {
	$op = $_GET['op'];
	if($op=='del') {
		$id = (int)$_GET['id'];
	}
}

if(isset($_POST) && isset($_POST['op'])) {
	$op = $_POST['op'];
	if($op=='add') {
		$autor = $_POST['autor'];
		$texto = $_POST['texto'];
	}
	if($op=='del' && isset($_POST['ok'])) {
		$ok = (int)$_POST['ok'];
		$id = (int)$_POST['id'];
	}
}

if ( !empty($contents_preview) ) {
    $myts =& MyTextSanitizer::getInstance();
    xoops_cp_header();

    $html = empty($nohtml) ? 1 : 0;
    $smiley = empty($nosmiley) ? 1 : 0;
    $xcode = empty($noxcode) ? 1 : 0;
    $p_title = $myts->makeTboxData4Preview($album);
    $p_contents = $myts->makeTareaData4Preview($comentario, $html, $smiley, $xcode);
    echo"<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr><td class='bg2'>
    <table width='100%' border='0' cellpadding='4' cellspacing='1'>
    <tr class='bg3' align='center'><td align='left'>$p_title</td></tr><tr class='bg1'><td>$p_contents</td></tr></table></td></tr></table><br />";
    $album = $myts->makeTboxData4PreviewInForm($album);
    $comentario = $myts->makeTareaData4PreviewInForm($comentario);
    include "contentsform.php";

    xoops_cp_footer();
    exit();
}

if ($op == "list") {
    // List quoete in database, and form for add new.
    $myts =& MyTextSanitizer::getInstance();
    xoops_cp_header();

    echo "
    <h4 style='text-align:left;'>"._RQ_TITLE."</h4>
    <form action='index.php' method='post'>
    <table border='0' cellpadding='0' cellspacing='0' width='100%'><tr><td class='bg2'>
    <table width='100%' border='0' cellpadding='4' cellspacing='1'>
    <tr class='bg3' align='center'><td align='left'>"._RQ_TEXTO."</td><td>"._RQ_AUTOR."</td><td>&nbsp;</td></tr>";
    $result = $xoopsDB->query("SELECT * FROM ".$xoopsDB->prefix("citas"));
    $count = 0;
    while ( list($id, $texto, $autor) = $xoopsDB->fetchRow($result) ) {
        $texto=$myts->makeTboxData4Edit($texto);
        $autor=$myts->makeTboxData4Edit($autor);
        echo "<tr class='bg1'><td align='left'>
            <input type='hidden' value='$id' name='id[]' />
            <input type='hidden' value='$texto' name='oldtexto[]' />
            <textarea name='newtexto[]' rows='2'>$texto</textarea>
            </td>
        <td align='center'>
            <input type='hidden' value='$autor' name='oldautor[]' />
            <input type='text' value='$autor' name='newautor[]' maxlength='255' size='20' />
        </td>
        <td nowrap='nowrap' align='right'><a href='index.php?op=del&amp;id=".$id."&amp;ok=0'>"._DELETE."</a></td></tr>";
        $count++;
    }
    if ($count > 0) {
        echo "<tr align='center' class='bg3'><td colspan='4'><input type='submit' value='"._SUBMIT."' /><input type='hidden' name='op' value='edit' /></td></tr>";
    }
    echo "</table></td></tr></table></form>
    <br /><br />
    <h4 style='text-align:left;'>"._RQ_ADD."</h4>
    <form action='index.php' method='post'>
    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
        <tr>
        <td class='bg2'>
            <table width='100%' border='0' cellpadding='4' cellspacing='1'>
                <tr nowrap='nowrap'>
                <td class='bg3'>"._RQ_AUTOR." </td>
                <td class='bg1'>
                    <input type='text' name='autor' size='30' maxlength='255' />
                </td></tr>
                <tr nowrap='nowrap'>
                <td class='bg3'>"._RQ_TEXTO." </td>
                <td class='bg1'>
                    <textarea name='texto' cols='150' rows='3'></textarea>
                </td></tr>
                <tr>
                <td class='bg3'>&nbsp;</td>
                <td class='bg1'>
                    <input type='hidden' name='op' value='add' />
                    <input type='submit' value='"._SUBMIT."' />
                </td></tr>
            </table>
        </td></tr>
    </table>
    </form>";

    xoops_cp_footer();
    exit();
}

if ($op == "add") {
    // Add quote
    $myts =& MyTextSanitizer::getInstance();
    $artista = $myts->makeTboxData4Save($autor);
    $texto = $myts->makeTboxData4Save($texto);
    $newid = $xoopsDB->genId($xoopsDB->prefix("citas")."id");
    $sql = "INSERT INTO ".$xoopsDB->prefix("citas")." (id, autor, texto) VALUES (".$newid.", '".$autor."', '".$texto."')";
   
   if (!$xoopsDB->query($sql)) {
        xoops_cp_header();
        echo "Could not add category";
        xoops_cp_footer();
    } else {
        redirect_header("index.php?op=list",1,_XD_DBSUCCESS);
    }
	
	//echo $sql;
    exit();
}

if ($op == "edit") {
    // Edit quotes
    $myts =& MyTextSanitizer::getInstance();
    $count = count($newautor);
    for ($i = 0; $i < $count; $i++) {
        if ( $newautor[$i] != $oldautor[$i] || $newtexto[$i] != $oldtexto[$i]) {
            $autor = $myts->makeTboxData4Save($newautor[$i]);
            $texto = $myts->makeTboxData4Save($newtexto[$i]);
            $sql = "UPDATE ".$xoopsDB->prefix("citas")." SET autor='".$autor."',texto='".$texto."' WHERE id=".$id[$i]."";
            $xoopsDB->query($sql);
        }
    }
    redirect_header("index.php?op=list",1,_XD_DBSUCCESS);
    exit();
}

if ($op == "del") {
    // Delete quote
    if ($ok == 1) {
        $sql = "DELETE FROM ".$xoopsDB->prefix("citas")." WHERE id = ".$id ;
        if (!$xoopsDB->query($sql)) {
            xoops_cp_header();
            echo "Could not delete category";
            xoops_cp_footer();
        } else {
            redirect_header("index.php?op=list",1,_XD_DBSUCCESS);
        }
        exit();
    } else {
        xoops_cp_header();
        xoops_confirm(array('op' => 'del', 'id' => $id, 'ok' => 1), 'index.php', _RQ_SUREDEL);
        xoops_cp_footer();
        exit();
    }
}

?>