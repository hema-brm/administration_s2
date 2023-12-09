build:
	docker compose build --no-cache --pull

dependencies:
	docker compose exec php composer install \
	&& docker compose exec php npm install

run:
	docker compose up -d \
	&& docker compose exec php npm run watch

down:
	docker compose down --remove-orphans

npm:
	docker compose exec php npm $(filter-out $@,$(MAKECMDGOALS))

composer:
	docker compose exec php composer $(filter-out $@,$(MAKECMDGOALS))

symfony:
	docker compose exec php php bin/console $(filter-out $@,$(MAKECMDGOALS))

database-drop:
	docker compose exec php php bin/console doctrine:database:drop --force

database-create:
	docker compose exec php php bin/console doctrine:database:create

database-migrate:
	docker compose exec php php bin/console doctrine:migrations:migrate --no-interaction

database-generate-migration:
	docker compose exec php php bin/console make:migration