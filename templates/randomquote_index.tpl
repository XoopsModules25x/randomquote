<{include file="db:randomquote_header.tpl" breadcrumb = $breadcrumb}>
<{* <link rel="stylesheet" href="assets/css/table.css" type="text/css"> *}>
<{*
<div class="outer">
    <div class="center"><{$smarty.const._MA_RANDOMQUOTE_TITLE}></div>
    <br>
</div>
*}>
<{* $bodyTxt *}>

<{if !empty($sets)}>
<div class="head border marg10">
    <div class="outer">
<{*        <div class="breadcrumb"><{$breadcrumb}></div> *}>
        <div class="width80 floatleft center bold big"><{$smarty.const._MA_RANDOMQUOTE_QUOTES_QUOTE}></div>
        <div class="center bold big"><{$smarty.const._MA_RANDOMQUOTE_QUOTES_AUTHOR}></div>
        <div class="clear"></div>
    </div>
<{  foreach item=set from=$sets}>
    <div class="<{cycle values='odd,even'}> border">
        <div class="width80 floatleft"><{$set.quote}></div>
        <div class="floatright right"><{$set.author}></div>
        <div class="clear"></div>
    </div>
<{  /foreach}>
    <{* $pagenav *}>
</div>
<{else}>
<div class='txtcenter bold italic marg3'><{$smarty.const._MA_RANDOMQUOTE_NO_QUOTES}></div>
<{/if}>

<{include file="db:randomquote_footer.tpl"}>
