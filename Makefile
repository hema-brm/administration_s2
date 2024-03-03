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
	docker compose exec php php bin/console doctrine:database:drop --if-exists --force

database-create:
	docker compose exec php php bin/console doctrine:database:create

database-migrate:
	docker compose exec php php bin/console doctrine:migrations:migrate --no-interaction

database-generate-migration:
	docker compose exec php php bin/console make:migration

database-reset:
	docker compose exec php php bin/console doctrine:database:drop --if-exists --force \
	&& docker compose exec php php bin/console doctrine:database:create \
	&& docker compose exec php php bin/console doctrine:migrations:migrate --no-interaction \
	&& docker compose exec php php bin/console doctrine:fixtures:load --no-interaction

clean-migration:
	rm -rf migrations/*.php \
	&& docker compose exec php php bin/console doctrine:database:drop --if-exists --force \
	&& docker compose exec php php bin/console doctrine:database:create \
	&& docker compose exec php php bin/console make:migration \
	&& docker compose exec php php bin/console doctrine:migrations:migrate --no-interaction \
	&& docker compose exec php php bin/console doctrine:fixtures:load --no-interaction

fixtures:
	docker compose exec php php bin/console doctrine:fixtures:load --no-interaction

ensure-permissions:
	sudo chown -R $(USER):$(USER) . \
	&& sudo chmod -R 777 .