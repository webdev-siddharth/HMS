FROM php:8.2-cli

# 🛠️ Install mysqli extension for PHP
RUN docker-php-ext-install mysqli

WORKDIR /app
COPY . .

EXPOSE 10000

CMD ["php", "-S", "0.0.0.0:10000"]
