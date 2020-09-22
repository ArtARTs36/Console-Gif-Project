<?php

function linked_anim()
{
    @symlink(__DIR__ . '/var/anim',__DIR__ . '/public/anim');
}

function composer()
{
    if (file_exists('composer.phar')) {
        @unlink('composer-setup.php');
    } else {
        copy('https://getcomposer.org/installer', 'composer-setup.php');

        include 'composer-setup.php';

        unlink('composer-setup.php');
    }

    shell_exec('composer install');
}

composer();
linked_anim();
