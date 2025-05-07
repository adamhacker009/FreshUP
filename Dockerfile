FROM php:8.1.0-apache
WORKDIR /var/www/html

RUN a2enmod rewrite

RUN apt-get update -y && apt-get install -y \
        libicu-dev \
        libmariadb-dev \
        unzip zip \
        zlib1g-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        python3 \
        python3-pip \
        libhdf5-dev \
        libnetcdf-dev

RUN pip3 install --no-cache-dir \
    numpy \
    netCDF4 \
    pandas \
    xarray \
    h5py \
    requests


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install gettext intl pdo_mysql gd

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd


COPY . .
EXPOSE 80