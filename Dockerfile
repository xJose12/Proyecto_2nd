FROM php:7.4-apache

RUN apt update
RUN docker-php-ext-install mysqli pdo pdo_mysql