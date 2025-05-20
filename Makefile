.DEFAULT_GOAL := init

%:
	@:

init:
	echo "Specify an Action"

up:
	docker-compose -f .docker/docker-compose.yml up  --build --force-recreate -d &&  ./bin/docker-setup.sh

down:
	docker-compose -f .docker/docker-compose.yml  down


dev-js:
	npm run start

build-production-js:
	npm run preuglify && npm run uglify

build-production-docs:
	npm run docs:build

dev-docs:
	npm run docs:dev

wp-format:
	npm run format

i18n-pot:
	composer run makepot

zip:
	rm rave-payment-forms.zip && npm run plugin-zip

inspection:
	./vendor/bin/phpcs -p . --standard=PHPCompatibilityWP

build:
	npm run build

release: build