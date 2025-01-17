# Use uma imagem base do PHP com Apache
FROM php:7.4-apache

# Copiar os arquivos da aplicação para o diretório web do Apache
COPY . /var/www/html

# Instalar extensões necessárias
RUN docker-php-ext-install pdo_mysql

# Expor a porta 80 do contêiner
EXPOSE 80
