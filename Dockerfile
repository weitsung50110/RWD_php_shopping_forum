FROM php:8.0-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y

#Fatal error: Uncaught Error: Class "mysqli" not found in /var/www/html/index.php:14 Stack trace: #0 {main} thrown in /var/www/html/index.php on line 14