# Define a imagem base
FROM php:8.2-alpine

# Instala dependências necessárias
RUN apk --no-cache update \
	&& apk --no-cache upgrade \
	&& apk add --no-cache --virtual \
	openssl \
	nodejs \
	npm \
	supervisor \
	# Cleanup
	&& rm -rf /var/lib/apt/lists/*

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions \
	&& install-php-extensions pcntl

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia as confs do supervisor
COPY supervisord.conf /etc/supervisord.conf

# Copia os arquivos do projeto para o contêiner
COPY . .

# Define as permissões adequadas
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 777 /var/www/html/resources

# Expõe a porta 9000 para o servidor web
EXPOSE 9000 8080 5173