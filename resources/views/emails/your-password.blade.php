@component('mail::message')
# Hi,

You can now access your dashboard.

Here's your password: {{ $this->password }}.

@component('mail::button', ['url' => url('/login')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
