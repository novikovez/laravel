SHELL := /bin/bash

include .env
export

ALL: up

up:
	@docker compose up -d
ps:
	@docker compose ps
build:
	@docker compose build
down:
	@docker compose down
php:
	@docker comnpose exec -u root php bash
