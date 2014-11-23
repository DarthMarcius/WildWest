<!doctype html>
<html class="no-js" lang="en">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wild West</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="wild west team">
    <link rel="shortcut icon" href="favicon.ico">
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Ruda:400,900,700' rel='stylesheet' type='text/css'>  
    
    <link rel="stylesheet" href="{{Request::root()}}/css/main.min.css" type="text/css">
  </head>
  <body>
      <script>
      var siteRoot = "{{Request::root()}}";
      </script>
      
      @yield('content')
  </body>

</html>