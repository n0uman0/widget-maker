# Dockerfile
FROM php:8.3-apache

RUN a2enmod rewrite

COPY apache-configuration.conf /etc/apache2/sites-available/000-default.conf
