GID = $(shell id -g)
UID = $(shell id -u)

default: prepare-env build-api up
prepare-env:
	@echo "\033[1;32mPreparando arquivo .env\033[0m"
	@cp .env.example .env
build-api:
	@echo "\033[1;32mBuildando API\033[0m"
	@docker build . -t desafio-inpeace-api --build-arg GID=$(GID) --build-arg UID=$(UID)
up:
	@echo "\033[1;32mIniciando aplicação completa\033[0m"
	@docker-compose up -d
run-migrates:
	@echo "\033[1;32mRodando migrations\033[0m"
	@docker-compose exec api php artisan migrate
run-seeders:
	@echo "\033[1;32mRodando seeders\033[0m"
	@docker-compose exec api php artisan db:seed --class=UsersTableSeeder
prepare-dev:
	@echo "\033[1;32mInstalando dependências do projeto\033[0m"
	@npm ci --silent
	@composer install --optimize-autoloader -q
up-dev:
	@echo "\033[1;32mIniciando aplicação completa (modo desenvolvimento)\033[0m"
	@docker-compose -f docker-compose.dev.yml up -d
