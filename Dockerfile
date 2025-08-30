FROM php:8.2-apache

# Instalar extensões necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitar mod_rewrite do Apache
RUN a2enmod rewrite

# Copiar projeto para o container
COPY . /var/www/html/

# Dar permissões
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80