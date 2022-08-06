@component('mail::message')
# visitors message

some visitors left a message.
<br>
Firstname: {{$fname}}
<br>
Lastname: {{$lname}}
<br>

Email: {{$email}}
<br>

Subject: {{$subject}}
<br>
{{$message}}
@component('mail::button', ['url' => ''])
View message
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
