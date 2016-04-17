<table class="outer">
    <{foreachq item=citas from=$block}>
    <tr class="<{cycle values = " even, odd"}>">
        <td><em><{$citas.quote}></em>

            <p align="right"><strong><{$citas.author}></strong></p>
        </td>
    </tr>
    <{/foreach}>
</table>
