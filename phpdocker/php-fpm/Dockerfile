FROM php:7.0-fpm
WORKDIR /application

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive


RUN mkdir /application/storage
RUN chown -R www-data:www-data /application/storage
RUN chmod -R 775 /application/storage
RUN ls -l