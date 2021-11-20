.DEFAULT_GOAL := help
.SILENT:
.PHONY: vendor

## Colors
COLOR_RESET   = \033[0m
COLOR_INFO    = \033[32m
COLOR_COMMENT = \033[33m

## User
UID=$(id -u)
GID=$(id -g)
DOCKER_PHP_SERVICE=mowers_controller

## Help
help:
	printf "${COLOR_COMMENT}Usage:${COLOR_RESET}\n"
	printf " make [target]\n\n"
	printf "${COLOR_COMMENT}Available targets:${COLOR_RESET}\n"
	awk '/^[a-zA-Z\-\_0-9\.@]+:/ { \
		helpMessage = match(lastLine, /^## (.*)/); \
		if (helpMessage) { \
			helpCommand = substr($$1, 0, index($$1, ":")); \
			helpMessage = substr(lastLine, RSTART + 3, RLENGTH); \
			printf " ${COLOR_INFO}%-16s${COLOR_RESET} %s\n", helpCommand, helpMessage; \
		} \
	} \
	{ lastLine = $$0 }' $(MAKEFILE_LIST)

##################
# Useful targets #
##################

## Install all requirements and launch project.
install: env_run install_vendor

## Execute the program.
run: run_program

## Stop project.
stop:
	docker-compose stop

## Down project and remove volumes.
down:
	docker-compose down -v --remove-orphans

## Run all tests.
tests: test

###############
# Environment #
###############

## Launch docker environment.
env_run:
	docker-compose up -d

###########
# Install #
###########

## Install vendors.
install_vendor:
	docker-compose run --rm --user ${UID}:${GID} ${DOCKER_PHP_SERVICE} composer install --prefer-dist

###########
# Running #
###########

## Running project.
run_program:
	docker-compose run --rm --user ${UID}:${GID} ${DOCKER_PHP_SERVICE} php app/start.php mower:main

########
# Test #
########

## Run unit tests.
test: test_unit

## Run unit&integration tests.
test_unit:
	docker-compose exec --user ${UID}:${GID} ${DOCKER_PHP_SERVICE} vendor/bin/phpunit

## Run unit tests with coverage
test_unit_coverage:
	docker-compose exec --user ${UID}:${GID} ${DOCKER_PHP_SERVICE} vendor/bin/phpunit --coverage-text

#########|
# OTHERS #
#########|

## Open sh as normal user
sh:
	docker-compose run --user ${UID}:${GID} --rm ${DOCKER_PHP_SERVICE} sh

## Open sh as root
sh_root:
	docker-compose run --rm ${DOCKER_PHP_SERVICE} sh

## Clear Symfony Cache
symfony_cache_clear:
	docker-compose run --rm --user ${UID}:${GID} ${DOCKER_PHP_SERVICE} bin/console cache:clear
