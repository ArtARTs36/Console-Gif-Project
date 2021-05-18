<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ukrainskiy Artem">

    <title>{{ lang_page_about_title }}</title>

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/offcanvas.css" rel="stylesheet">
</head>

<body class="bg-light">

{{ include('layout/nav') }}

<main role="main" class="container">
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">
            {{ lang_page_about_title }}

            {{ include('layout/langs') }}
        </h6>

        <br>

        <img src="https://github.com/ArtARTs36/Console-Gif-Project/workflows/Deploy/badge.svg?branch=master">

        <img src="https://img.shields.io/badge/License-MIT-yellow.svg">

        <a href="https://github.com/ArtARTs36/Console-Gif-Project">
            <img src="https://img.shields.io/badge/Code-GitHub-brightgreen">
        </a>

        <img src="https://img.shields.io/github/stars/artarts36/Console-Gif-Project?style=social">

        <a href="https://github.com/ArtARTs36/Console-Gif-Project/blob/master/docs/openapi.yml">
            <img src="https://img.shields.io/badge/OpenApi-3.0.0-brightgreen">
        </a>

        <hr>

        {{ lang_page_about_message }}

        <hr>

        {{ lang_author }}: <a href="http://ukrainsky.su">{{ lang_author_name }} ({{ lang_author_position }})</a>
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
