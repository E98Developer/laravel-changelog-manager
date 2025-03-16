<?php

namespace E98Developer\LaravelChangelogManagerPackage\Helpers;

class LaravelChangeLogManager
{

    public static function getVersion(): string
    {
        //TODO: can use service
        if(\Storage::exists('version')){
            return \Storage::get('version');
        }
        return 'No version available';
    }
}
