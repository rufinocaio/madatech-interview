FROM php:8.2-apache

# Instalar dependências
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Instalar extensões PHP necessárias
RUN docker-php-ext-install \
    intl \
    mysqli \
    pdo_mysql \
    zip

# Habilitar mod_rewrite para URLs amigáveis
RUN a2enmod rewrite

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar a configuração do Apache
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# Configurar permissões
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Expor porta 80
EXPOSE 80