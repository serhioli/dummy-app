.PHONY: up down build build! exec

up:
	docker compose up -d

down:
	docker compose down --remove-orphans

build: down
	docker compose build

build!: down
	docker compose build --no-cache

exec: up
	docker compose exec app bash
