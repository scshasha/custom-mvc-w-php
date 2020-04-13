# Custom PHP MVC Application
![PHP Composer](https://github.com/scshasha/custom-mvc-w-php/workflows/PHP%20Composer/badge.svg)

## Basic Requirements

* [PHP WebServer](https://serverguy.com/servers/php-servers/) (Running PHP ^7.x and MySQL)
* [Composer](http://getcomposer.org/)

## Getting started

The following step assumes that you have completed your environmet setup.

#### Cloning
Clone the repository by executing on you terminal OR download the zip file and extract to your working directory.

```
git clone https://github.com/scshasha/custom-mvc-w-php.git
```

#### Autoloader / Bootstraping
On your root directory, where there is the `composer.json` file. Run:

```
composer install
```

Followed by: 
```
composer dump-autoload OR composer dumpautoload
```
#### Database Setup
Update `./src/conf.php` with your values:
```
"DATABASE_HOST" => 'localhost',
"DATABASE_NAME" => 'db_name',
"DATABASE_USERNAME" => "db_username",
"DATABASE_PASSWORD" => "db_password",
```

Import `./install/structure.sql` and `./install/constraints.sql`

Setup complete!!
___

## Optional Extra!!!
* Create a V-Host to access the application i.e http://mylocaldomain.dev works better, rather than accessing the application like http://localhost/my-project-root-folder/public

___
## [NOTE]: Running with Docker:

There is currently an issue when running this application with Docker (Docker Toolbox). * Encounters the Too many redirects error.

---

## License

This project is licensed under the MIT open source license.
