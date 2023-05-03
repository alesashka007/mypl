@props(['method' => 'POST'])

<form {{$attributes}} method="{{$method}}">
    {{$slot}}
</form>
