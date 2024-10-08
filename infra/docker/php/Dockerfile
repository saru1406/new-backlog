FROM php:8.3-fpm-bullseye AS base

WORKDIR /workspace

# timezone environment
ENV TZ=UTC \
  # locale
  LANG=en_US.UTF-8 \
  LANGUAGE=en_US:en \
  LC_ALL=en_US.UTF-8 \
  # composer environment
  COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

RUN <<EOF
  apt-get update
  apt-get -y install --no-install-recommends \
    locales \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libonig-dev
  locale-gen en_US.UTF-8
  localedef -f UTF-8 -i en_US en_US.UTF-8
  docker-php-ext-install \
    intl \
    pdo_mysql \
    zip \
    bcmath
  composer config -g process-timeout 3600
  composer config -g repos.packagist composer https://packagist.org
EOF

# ホストのUIDとGIDを引数として受け取る
ARG UID
ARG GID

# ホストのUIDとGIDに基づいたユーザーを作成
RUN groupadd -g $GID user && useradd -m -u $UID -g $GID user

RUN chown -R user:user /composer

FROM base AS development

RUN apt-get update && apt-get -y install --no-install-recommends \
    default-mysql-client && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# 作成したユーザーに切り替え
USER user

COPY ./infra/docker/php/php.development.ini /usr/local/etc/php/php.ini

FROM development AS development-xdebug

RUN pecl install xdebug && docker-php-ext-enable xdebug

COPY ./infra/docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

FROM base AS deploy

COPY ./infra/docker/php/php.deploy.ini /usr/local/etc/php/php.ini
COPY ./src /workspace

RUN <<EOF
  composer install -q -n --no-ansi --no-dev --no-scripts --no-progress --prefer-dist
  chmod -R 777 storage bootstrap/cache
  php artisan optimize:clear
  php artisan optimize
  apt-get clean
  rm -rf /var/lib/apt/lists/*
EOF
