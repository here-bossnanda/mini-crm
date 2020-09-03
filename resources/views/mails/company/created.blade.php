@component('mail::message')
# Halo, {{ $companies->name }}

@lang('dashboard.mail-body') {{ config('app.name') }}.

@component('mail::button', ['url' => ''])
@lang('dashboard.mail-greeting')
@endcomponent

@lang('dashboard.mail-thanks'),<br>
{{ config('app.name') }}
@endcomponent
