install:
	docker run --rm -v $(pwd):/app composer/composer install
	docker run --rm -v $(pwd):/app -w /app mhart/alpine-node:10 yarn

up:
	docker-compose up