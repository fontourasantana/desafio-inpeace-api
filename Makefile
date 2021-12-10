GID = $(shell id -g)
UID = $(shell id -u)

default: prepare-env build-api up migrate
prepare-env:
	@echo "\033[1;32mPreparando arquivo .env\033[0m"
	@cp .env.example .env
build-api:
	@echo "\033[1;32mBuildando API\033[0m"
	@docker build . -t desafio-inpeace-api --build-arg GID=$(GID)
up:
	@echo "\033[1;32mIniciando aplicação completa\033[0m"
	@docker-compose up -d
up-dev:
	@echo "\033[1;32mIniciando aplicação completa (modo desenvolvimento)\033[0m"
	@docker-compose -f docker-compose.dev.yml up -d
migrate:
	@echo "\033[1;32mRodando migrations\033[0m"
	@docker-compose exec api php artisan migrate