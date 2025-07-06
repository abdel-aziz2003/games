<x-email-template>
    <p style="line-height: 24px; margin-bottom:15px;">

        Hi Admin

    </p>
    <p style="line-height: 24px;margin-bottom:15px;">
        Someone filled your contact form on {{ env('APP_NAME') }}. Kindly check below for the details:
    </p>
    
    <p><strong>NAME: </strong>{{ $request->input('name') }}<br />
        <strong>EMAIL: </strong>{{ $request->input('email') }}<br />
        <strong>SUBJECT: </strong>{{ $request->input('subject') }}<br />
        <strong>MESSAGE: </strong><br />{{ $request->input('message') }}<br />
    </p><br /><br />
 
</x-email-template>