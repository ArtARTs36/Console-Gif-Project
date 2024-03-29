<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ukrainskiy Artem">

    <title>{{ lang_site_title }}</title>

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/offcanvas.css" rel="stylesheet">
</head>

<body class="bg-light">

{{ include('layout/nav') }}

<main role="main" class="container">
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">
            {{ lang_enter_data }}

            {{ include('layout/langs') }}
        </h6>

        <br/>

        <form method="POST" action="/submit">
            <div class="form-group">
                <label for="submit-form-width">{{ lang_width }}</label>
                <input type="text"
                       class="form-control"
                       id="submit-form-width"
                       name="width"
                       value="450" />
            </div>

            <div class="form-group">
                <label for="submit-form-width">{{ lang_height }}</label>
                <input type="text"
                       class="form-control"
                       id="submit-form-width"
                       name="height"
                       value="450" />
            </div>

            <div class="form-group">
                <label for="submit-form-user">{{ lang_user_static_left }}</label>
                <input type="text"
                       class="form-control"
                       id="submit-form-user"
                       name="user"
                       placeholder="artem@MacBook-Pro-Artem console-gif-project % " />
            </div>

            <div id="submit-form-strings">
                <div class="form-group">
                    <label for="submit-form-user">{{ lang_string }} 1</label>
                    <input type="text"
                           class="form-control"
                           id="submit-form-user"
                           placeholder="git clone https://github.com/ArtARTs36/GitHandler"
                           name="strings[1]"
                    />
                </div>
            </div>

            <button type="submit" class="btn btn-success">{{ lang_submit }}</button>
            <button type="button" class="btn btn-info" onclick="addString()">{{ lang_add_string }}</button>
            <button type="button" class="btn btn-primary" onclick="repeatLastString()">{{ lang_repeat_last_string }}</button>
            <button type="button" class="btn btn-danger" onclick="deleteLastString()">{{ lang_delete_last_string }}</button>

        </form>
    </div>
</main>

{{ include('layout/scripts') }}
<script>
    function repeatLastString()
    {
        addString($('#submit-form-strings div:eq(' + getLastStringIndex() +') input').val());
    }

    function deleteLastString()
    {
        $('#submit-form-strings div:eq(' + getLastStringIndex() +')').remove();
    }

    function addString(value)
    {
        value = value ? value : '';

        let id = getStringsCount() + 1;

        $('#submit-form-strings').append('' +
            '                <div class="form-group">\n' +
            '                    <label for="submit-form-user">{{ lang_string }} '+ id +'</label>\n' +
            '                    <input type="text"\n' +
            '                           class="form-control"\n' +
            '                           id="submit-form-user"\n' +
            '                           placeholder="git clone https://github.com/ArtARTs36/GitHandler"\n' +
            '                           name="strings[' + id + ']"\n' +
            '                           value="'+ value +'"              ' +
            '                    />\n' +
            '                </div>\n');
    }

    function getStringsCount()
    {
        return $('#submit-form-strings input').length;
    }

    function getLastStringIndex()
    {
        return getStringsCount() - 1;
    }
</script>

</body>
</html>
