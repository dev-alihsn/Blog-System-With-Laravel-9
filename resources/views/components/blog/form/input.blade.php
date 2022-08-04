@props(['type' => 'text','name','placeholder'])
<input required autocomplete="of" type="text" id="{{$name}}" name="{{$name}}" class="form-control" placeholder="{{$placeholder}}">
@error($name)
    <p class="text-danger">{{$message}}</p>
@enderror
