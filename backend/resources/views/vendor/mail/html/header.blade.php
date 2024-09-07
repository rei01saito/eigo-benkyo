<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<p class="text-4xl font-bold font-body text-center">Katask</p>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
