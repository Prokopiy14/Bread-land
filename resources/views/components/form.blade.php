@props(['method' => 'GET'])
@php($_method = in_array($method, ['GET', 'POST']))
<form {{ $attributes }} method="{{ $_method ? $method : 'POST' }}" >
    @if($_method)
    @else
        @method($method)
    @endif
    @csrf
    {{ $slot }}
</form>
