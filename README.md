# sMVC
sMVC is an MVC (Model-View-Controller) application framework for PHP. 
It provides clear separation between the data (Model), the presentation (View), and the glue in between (Controller).
This framework was created to support a PHP course and is therefore not a production framework.<br>

So sMVC is not a complete framework that already contains all kinds of libraries and software components. 
Out-of-the-box it only offers an MVC structure with support for database operations via the PDO class 
The framework can be extended according to your own needs by own classes and functions or by third-party libraries (https://packagist.org/) that you can install through composer. 
This means the framework is the ideal basis to master programming in PHP.

## Composer

sMVC requires Composer to work. 

composer install
Installation guide for [Linux/Unix/OSX](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos) and [Windows](https://getcomposer.org/doc/00-intro.md#installation-windows).

## Requirements
* Composer
* PHP 7.4+
* webserver with legacy support for Apache with mod_rewrite
* PDO if using the Database

## Creating sMVC project
* git clone https://github.com/ssegers/sMVC.git<br>
* run composer install<br>
  Composer will fetch the required PHP classes and install them inside the vendor directory (including the autoload.php).
* copy .env.example to .env

more info you can find [here](https://github.com/ssegers/sMVC/wiki)
