<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Assuming PHP already setup in your device.
Requirment: `^php 8.1`, `node ^16.12.2`

## Start Docker
   `docker-compose up`

## Steps to setup database
Login to CLI of database - CLI `(>_)` can be access through Docker Dashboard under your container name = mysql57

## Create database
`mysql -h localhost -u root -p -e "CREATE DATABASE devices";`

### Grand previleges database
`mysql -h localhost -u root -p -e "GRANT ALL PRIVILEGES ON devices.* TO 'user'@'%'";`

## ENV setup
   `cp .env.example .env`

## Database and tables setup
### Run migration using below command
   `php artisan  migrate`
## Optional, Import data using `devices.csv` file in root folder OR
## Use `devices_2022_08_29.sql.gz sql` file in root folder

## PHPUnit test
`php artisan test --filter DeviceTest`

###There are 2 test 
1. Add assertion for a required model and brand. Testing were model and brand has `null` value
2. Add assertion for a valid release_date format (YYYY/MM), release_date is in `Y/d/m` format

### The above 2 test will failed
