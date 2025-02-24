FROM php:5.5-apache

# Apache 설정 복사
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# 필요한 PHP 확장 설치
RUN docker-php-ext-install mysqli && a2enmod rewrite

# Mcrypt 설치를 위한 리포지토리 추가
RUN sed -i '/jessie-updates/d' /etc/apt/sources.list && sed -i 's/httpredir.debian.org/archive.debian.org/g' /etc/apt/sources.list && sed -i '/security.debian.org/d' /etc/apt/sources.list && echo 'Acquire::Check-Valid-Until "false";' > /etc/apt/apt.conf.d/99no-check-valid-until && apt-get update && apt-get install -y --allow-unauthenticated libmcrypt-dev && docker-php-ext-install mcrypt



# Mcrypt 설치
RUN apt-get update && apt-get install -y libmcrypt-dev && docker-php-ext-install mcrypt

# 프로젝트 복사
COPY ./public_html /var/www/html/public_html
COPY ./application /var/www/html/application
COPY ./system /var/www/html/system
COPY ./system /var/www/html/sync_script
COPY ./php.ini /usr/local/etc/php/php.ini

# 권한 설정
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

