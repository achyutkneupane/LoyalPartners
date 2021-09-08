@component('mail::message')
# User Request Accepted

Congratulations, your user request has been accepted

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
