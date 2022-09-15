<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            background: #444444;
            font-family: 'Nunito', sans-serif;
            color: #fff;
            margin-top: 60px;
        }

        #maind {
            margin: auto;
            width: 50%;
            border: 3px solid #fff;
            border-radius: 20px;
            padding: 10px;

            text-align: center;
        }
    </style>
</head>

<body>
    <div id="maind">
        <h1>Tested Recruits</h1>
        <h1>{{ env('APP_NAME') }}</h1>
        <h2>LARAVEL TASK</h2>
    </div>

</body>
<script>
    setInterval(function() {
        window.location.href = "{{ route('tasks.index') }}";
    }, 3000);
</script>

</html>
