<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About FCC Validator

This is the Laravel API that the Wordpress plugin uses for it's data. It is still only setup for GMRS but can easily be extended for HAM etc.
<br>
This API requires a one time full database download and seed which I will add instructions for later, afterwards the API automatically downloads each newest day of licenses
to add into the API database keeping it up to date as early as the day before.
<br>
By all means fix and add as much stuff as possible, long time PHP coder with 2 years Laravel, first time writing a Laravel API.
<br>
You need to rename .env.example to .env
<br>
You need to composer install, then migrate to set up the database tables.
<br>
Then php artisan schedule:test and run first time full FCC DB download, this currently needs to be done on a Monday so scheduler takes over aferwards and you do not lose any updates. This probably needs more explaining so I will try to expand on this more later. This is at least until a control panel is built for the API or a smart function to auto 
download and seed all days up to current day after a full download.
