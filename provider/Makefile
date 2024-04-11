pwd := $(shell dirname $(realpath $(firstword $(MAKEFILE_LIST))))

dc := docker-compose -f .docker/local/docker-compose.yml -p provider --env-file $(pwd)/.env.local
dexec := $(dc) exec provider-app

cli:
	$(dexec) bash

build:
	$(dc) build

up:
	$(dc) up -d

up-show:
	$(dc) up

down:
	$(dc) down --remove-orphans

rebuild: down build up
restart: down up

setup:
	@cp -n .env.local.example .env.local || true  # copy only if .env does not exists
	make build
	make up
	$(dexec) composer install --no-interaction --prefer-dist --no-progress

pu:
	$(dexec) php vendor/bin/phpunit
