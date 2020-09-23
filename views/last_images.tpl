<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ukrainskiy Artem">

    <title>Last Images</title>

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/offcanvas.css" rel="stylesheet">
</head>

<body class="bg-light">

{{ include('layout/nav') }}

<main role="main" class="container">
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">Last Images</h6>

        <br/>  <br/>

        <a href="{{ images_0 }}" target="_blank"><img src="{{ images_0 }}" width="250" height="250"/></a>
        <a href="{{ images_1 }}" target="_blank"><img src="{{ images_1 }}" width="250" height="250"/></a>
        <a href="{{ images_2 }}" target="_blank"><img src="{{ images_2 }}" width="250" height="250"/></a>

        <br/>  <br/>

        <a href="{{ images_3 }}" target="_blank"><img src="{{ images_3 }}" width="250" height="250"/></a>
        <a href="{{ images_4 }}" target="_blank"><img src="{{ images_4 }}" width="250" height="250"/></a>
        <a href="{{ images_5 }}" target="_blank"><img src="{{ images_5 }}" width="250" height="250"/></a>

        <br/>  <br/>

        <a href="{{ images_6 }}" target="_blank"><img src="{{ images_6 }}" width="250" height="250"/></a>
        <a href="{{ images_7 }}" target="_blank"><img src="{{ images_7 }}" width="250" height="250"/></a>
        <a href="{{ images_8 }}" target="_blank"><img src="{{ images_8 }}" width="250" height="250"/></a>

    </div>
</main>

{{ include('layout/scripts') }}
<script>
    let strings = 1;

    function addString()
    {
        $('#submit-form-strings').append('            <div id="submit-form-strings">\n' +
            '                <div class="form-group">\n' +
            '                    <label for="submit-form-user">String '+ ++strings +'</label>\n' +
            '                    <input type="text"\n' +
            '                           class="form-control"\n' +
            '                           id="submit-form-user"\n' +
            '                           placeholder="git clone https://github.com/ArtARTs36/GitHandler"\n' +
            '                           name="strings[' + strings + ']"\n' +
            '                    />\n' +
            '                </div>\n' +
            '            </div>');
    }
</script>

</body>
</html>
