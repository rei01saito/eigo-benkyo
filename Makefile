# container
build:
	docker compose build --no-cache
	@make up
	docker compose exec app bash -c "cp .env.example .env"
	docker compose exec app bash -c "chmod -R 777 storage"
	docker compose exec app bash -c "composer install"
	docker compose exec app bash -c "php artisan key:generate"
	docker compose exec node bash -c "npm install"

ps:
	docker compose ps

up:
	docker compose up -d

stop:
	docker compose stop

restart:
	docker compose restart

destroy:
	docker compose down --rmi all --volumes --remove-orphans

# backend
back:
	docker compose exec app bash

# frontend
front:
	docker compose exec node bash

storybook:
	docker compose exec node bash -c "npm run storybook"

set:
	@make back \
		cp .env.example .env \
		&& chmod -R 777 storage \
		&& php artisan key:generate