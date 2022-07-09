<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'MyRecipes')
<img src="https://i.ibb.co/0Yvsbfj/laranja.png" style="width: 100%" class="logo" alt="MyRecipes">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
