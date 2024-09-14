FROM php:8.3-fpm-bullseye AS base

# timezone environment
ENV TZ=UTC \
  LANG=en_US.UTF-8 \
  LANGUAGE=en_US:en \
  LC_ALL=en_US.UTF-8 \
  COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

WORKDIR /workspace

# Composer のコピー
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# root権限で依存パッケージをインストール
RUN apt-get update && apt-get -y install --no-install-recommends \
    locales \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    default-mysql-client \
    && locale-gen en_US.UTF-8 \
    && localedef -f UTF-8 -i en_US en_US.UTF-8 \
    && docker-php-ext-install intl pdo_mysql zip bcmath \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ホストマシンのユーザーIDを引数で受け取り、そのユーザーを作成
ARG USER_ID
RUN useradd -u ${USER_ID} -m myuser

# Node.jsのセットアップ
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ユーザーをホストマシンと同じに切り替える
USER myuser

# development 環境用の設定
FROM base AS development

# PHPの開発環境用設定
COPY ./infra/docker/php/php.development.ini /usr/local/etc/php/php.ini

# xdebugのセットアップ
FROM development AS development-xdebug

RUN pecl install xdebug && docker-php-ext-enable xdebug

COPY ./infra/docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# deploy環境用の設定
FROM base AS deploy

COPY ./infra/docker/php/php.deploy.ini /usr/local/etc/php/php.ini
COPY ./src /workspace

# Composer install と権限設定（root権限が必要な作業はユーザー切り替え前に）
RUN composer install -q -n --no-ansi --no-dev --no-scripts --no-progress --prefer-dist \
    && chmod -R 777 storage bootstrap/cache \
    && php artisan optimize:clear \
    && php artisan optimize
