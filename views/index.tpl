<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ukrainskiy Artem">

    <title>Console Simulation of Gif Animation</title>

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/offcanvas.css" rel="stylesheet">
</head>

<body class="bg-light">

{{ include('layout/nav') }}

<main role="main" class="container">
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">Enter data</h6>

        <br/>

        <form method="POST" action="/submit">
            <div class="form-group">
                <label for="submit-form-width">Width</label>
                <input type="text"
                       class="form-control"
                       id="submit-form-width"
                       name="width"
                       value="450" />
            </div>

            <div class="form-group">
                <label for="submit-form-width">Height</label>
                <input type="text"
                       class="form-control"
                       id="submit-form-width"
                       name="height"
                       value="450" />
            </div>

            <div class="form-group">
                <label for="submit-form-user">User</label>
                <input type="text"
                       class="form-control"
                       id="submit-form-user"
                       name="user"
                       placeholder="artem@MacBook-Pro-Artem console-gif-project % " />
            </div>

            <div id="submit-form-strings">
                <div class="form-group">
                    <label for="submit-form-user">String 1</label>
                    <input type="text"
                           class="form-control"
                           id="submit-form-user"
                           placeholder="git clone https://github.com/ArtARTs36/GitHandler"
                           name="strings[1]"
                    />
                </div>
            </div>

            <button type="submit" class="btn btn-secondary">Submit</button>
            <button type="button" class="btn btn-info" onclick="addString()">Add String</button>

        </form>
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
