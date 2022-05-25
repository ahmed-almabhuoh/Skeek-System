@component('mail::message')
# Greedings, {{$admin->name}}

Welcome to sheek management system.

@component('mail::button', ['url' => 'http://localhost:8000/auth/admin/login'])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
