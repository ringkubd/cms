@component('mail::message')
Hello <b>{{$mail->name}}</b> ,

{!! $mail->message !!}

Regards,<br>
<b>{{ config('app.name') }}</b> <br>
IDB Bhaban (4th Floor) <br>
E/8-A, Rokeya Sharani, Sher-e-Bangla Nagar. <br>
Dhaka-1207, Bangladesh <br>
Phone: +880 2 9183006 <br>
Email: idbb@isdb-bisew.org <br>

@component('mail::button', ['url' => 'https://www.isdb-bisew.org', 'title' => 'https://www.isdb-bisew.org'])
Visit Our Website
@endcomponent

@endcomponent