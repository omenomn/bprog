<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Mini chat - BPROG</title>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <link href="{{ mix('css/app.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
      <div id="app">
      </div>
      <input 
        type="hidden" 
        id="recaptcha-sitekey-input" 
        value="{{ config('captcha.sitekey') }}">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script src="{{ mix('js/app.js') }}"></script>      
    </body>
</html>