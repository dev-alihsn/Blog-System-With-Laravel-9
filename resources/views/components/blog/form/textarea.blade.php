@props(['type' => 'textarea','name','placeholder'])
<textarea name="{{$name}}" id="{{$name}}" cols="30" rows="10" class="form-control" placeholder="{{$placeholder}}">{{old($name)}}</textarea>
<small class="error text-danger {{$name}}"></small>
@error($name)
    <p class="text-danger">{{$message}}</p>
@enderror
