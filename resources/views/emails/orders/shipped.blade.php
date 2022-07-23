@component('mail::message')
# Introduction
Your Order Fom Company Name Has Shipped!
@component('mail::button', ['url' => ''])
Button Text
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
