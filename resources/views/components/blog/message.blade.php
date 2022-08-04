@props(['status'])

@if(session()->has($status) && session($status) == 'success')
<div class="alert alert-success">
    {{session($status)}}
</div>
@elseif(session()->has($status))
<div class="alert alert-danger">
    {{session($status)}}
</div>
@endif