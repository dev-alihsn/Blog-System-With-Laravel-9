@props(['type' => 'text','name','placeholder'])
<input  autocomplete="of" value="{{old($name)}}" type="text" id="{{$name}}" name="{{$name}}" class="form-control" placeholder="{{$placeholder}}">
<small class="error text-danger {{$name}}"></small>
@error($name)
    <p class="text-danger">{{$message}}</p>
@enderror
