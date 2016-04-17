<{include file="db:randomquote_header.tpl"}>
<{*<link rel="stylesheet" href="assets/css/table.css" type="text/css"/>*}>
<div class="outer">
    <div class="center">RANDOMQUOTE</div>
</div>
<div class="outer">
    <div class="center">Randomquote</div>
    <br/>
</div>

<!--
<div class="head border">
    <div class="outer">
        <div class="width80 floatleft center"><{$smarty.const._MA_RANDOMQUOTE_QUOTES_QUOTE}></div>
        <div class="width10 floatleft center"><{$smarty.const._MA_RANDOMQUOTE_QUOTES_AUTHOR}></div>
        <div class="clear"></div>
    </div>
    <{foreach item=set from=$sets}>
    <div class="<{cycle values='even,odd'}> border">
        <div class="width80 floatleft center"><{$set.set_id}></div>
        <div class="width10 floatleft center"><{$set.name}></div>
        </div>
        <div class="clear"></div>
    </div>
    <{/foreach}>
    <{$pagenav}>
</div>
-->

<{include file="db:randomquote_footer.tpl"}>
