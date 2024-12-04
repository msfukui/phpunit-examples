all: clean build

clean:
	-@docker compose down
build:
	-@docker compose up -d --build --remove-orphans
up:
	-@docker compose up -d
down:
	-@docker compose down

update:
	-@docker compose exec dev composer update

ci: lint test

lint:
	-@docker compose exec dev vendor/bin/php-cs-fixer fix --dry-run --diff

fix:
	-@docker compose exec dev vendor/bin/php-cs-fixer fix

tests: test

test:
	-@docker compose exec dev vendor/bin/phpunit
