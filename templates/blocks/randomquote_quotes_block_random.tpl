<{foreachq item=citas from=$block name=lp}>
<{if $smarty.foreach.lp.first}>
<ul style="list-style-type: none;"><{/if}>
    <li style="padding-left: 2em; text-indent: -2em;"><em><{$citas.quote}></em></li>
    <li style="padding-left: 2em; text-indent: -2em;" class="right bold"><{$citas.author}></li>
    <{if $smarty.foreach.lp.last}></ul><{/if}>
<{if false }>
    <{if $smarty.foreach.lp.first}><table class='outer'><{/if}>
    <tr class='<{cycle values = "odd,even"}>'>
        <td><em><{$citas.quote}></em>
            <p class='right bold'><{$citas.author}></p>
        </td>
    </tr>
    <{if $smarty.foreach.lp.last}></table><{/if}>
<{/if}>
<{/foreach}>
