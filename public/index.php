<?php

use App\Pages\Index;
use App\Pages\LastImages;
use App\Pages\Submit;

require_once 'server_ini.php';
require_once __DIR__ . '/../vendor/autoload.php';

$result = '';

switch (uri()) {
    case '/submit':
        $result = Submit::handle();
        break;

    case '/last':
        $result = LastImages::handle();
        break;

    default:
        $result = Index::handle();
        break;
}

echo $result;
