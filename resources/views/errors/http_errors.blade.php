
<html>
    <head>
<link rel="stylesheet" type="text/css"
href="{{ URL::asset('assets/bower_components/bootstrap/css/bootstrap.min.css') }}">
<script type="text/javascript" src="{{ URL::asset('assets/bower_components/bootstrap/js/bootstrap.min.js') }}">
</script>
<script type="text/javascript" src="{{ URL::asset('assets/bower_components/jquery/js/jquery.min.js') }}"></script>
<!------ Include the above in your HEAD tag ---------->
    </head>
    <body>
        <div class="page-wrap d-flex flex-row align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center">
                        <span class="display-1 d-block">{{env('APP_NAME')}}</span>
                        <div class="mb-4 lead">{{$message}}</div>
                        <a href="/" class="btn btn-link">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
