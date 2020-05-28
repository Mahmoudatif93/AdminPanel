@component('mail::message')
# Introduction
wellcome {{$data['data']->name}}
<br>
The body of your message.

@component('mail::button', ['url' => aurl('reset/password/'.$data['token'])])
Click hir to reset password
@endcomponent
or copy
<a href="{{aurl('reset/password/'.$data['token'])}}">{{aurl('reset/password/'.$data['token'])}}</a>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
