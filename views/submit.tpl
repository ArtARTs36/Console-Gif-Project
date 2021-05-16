<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ukrainskiy Artem">

    <title>{{ lang_result }}</title>

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/offcanvas.css" rel="stylesheet">
</head>

<body class="bg-light">

{{ include('layout/nav') }}

<main role="main" class="container">
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">{{ lang_result }} {{ include('layout/langs') }}</h6>

        <div class="form-group">
            <input type="text" class="form-control"
                   value="http://console-gif.ukrainsky.su{{ image }}"
                   onclick="this.focus();this.select()"
            />
        </div>

        <div style="width: 100%">
            <img src="{{ image }}" style="max-width: 100%"/>
        </div>
    </div>
</main>

{{ include('layout/scripts') }}

</body>
</html>
