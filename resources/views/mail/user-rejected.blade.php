@component('mail::message')
# User Request Rejected

Sorry,
Your user verification has been rejected.

**Reason:**

> {{ $reason }}

Try again after resolving the issue above.

__Thanks,__<br>
{{ config('app.name') }}
@endcomponent
