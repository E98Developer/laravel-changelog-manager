# Laravel changelog  mananager 



This is a package that give a very simple changelog and release version solution.

## How to install
1. Run `composer require e98developer/laravel-changelog-manager`
2. Run `php artisan migrate`

## How to use

### Initialize  new release   
* First run `php artisan changelog:init`
* Set version number (like use SemVer)
* If you want, give a description of the edition
* **Notice** Next question "Do you want set released?" not working background, so please select no

#### Add new changelog
* First run `php artisan changelog:add`
* If you have many not released version, please choice which one you want to write a logo for.
* Choice changelog type ['ADD','FIX','MOD','DEL']
* Add changelog description

#### Release version
* First run `php artisan changelog:release`
* If you have many not released version, please choice which one you want to release.

### Get actual version
* use `LaravelChangeLogManager::getVersion()`

### Look released versions and changelog list on werb
* visit `{baseUrl}/changelog-manager/release` 



