@props(['status'])

@if(session()->has($status))
<div class="alert alert-{{$status == 'success' ? 'success' : 'danger'}} global-message">
    {{session($status)}}
</div>
@endif