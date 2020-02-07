install:
	docker run --rm -v $(shell pwd):/app -w /app composer/composer install; \
	docker run --rm -v $(shell pwd):/app -w /app mhart/alpine-node:10 yarn; \
	docker-compose build; \

setup_laravel:
	docker-compose exec app php artisan key:generate; \
	docker-compose exec app php artisan optimize

up:
	docker-compose up