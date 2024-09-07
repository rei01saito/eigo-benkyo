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
shell:
	docker compose exec app bash