<?php

namespace E98Developer\LaravelChangelogManagerPackage\Enums;

enum ChangelogTypeEnum: string
{
    case ADD = 'ADD';
    case FIX = 'FIX';
    case MOD = 'MOD';
    case DEL = 'DEL';
}
