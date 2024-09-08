# container
build:
	docker compose build --no-cache
ps:
	docker compose ps
up:
	docker compose up -d
stop:
	docker compose stop
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