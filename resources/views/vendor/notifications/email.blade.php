@component('mail::message')

{{-- 
    to edit subject. 
    You need to go in config/mail.php
    chage name in from.
    'from' => [
        'name' => env('MAIL_FROM_NAME', '*** EDIT HERE ****'),
    ],
    
    --}}

{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hello!')
@endif
@endif

{{-- Intro Lines --}}
@lang("คุณได้รีบอีเมลในการเปลี่ยนรหัสผ่าน")

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@lang("ให้คุณ Reset Password เพื่อที่จะสามารถเข้าสู่ระบบได้\n\n")

{{-- Salutation --}}
@lang("ขอแสดงความนับถือ \n")

{{-- @lang('Regards'),<br> --}}
{{ config('app.name') }}

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "คลิกที่ปุ่ม \":actionText\" หรือคลิกที่ลิงก์นี้เพื่อเปลี่ยนรหัสผ่าน: "
    ,
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
