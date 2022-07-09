@component('mail::message')
# Introduction

Atenção, não compartilhe este E-mail com ninguém.

@component('mail::button', ['url' => ''])
Redefinir Senha
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
