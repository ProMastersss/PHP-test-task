include .env.local
export
.env.local:
	sed "s/DOCKER_UID=1000/DOCKER_UID=$(shell id -u)/g" .env.template > .env.local
init:
	#clean all staff
	make down
	if which docker-sync > /dev/null; then \
		docker-sync clean; \
	fi
	rm -rf .docker-sync
	rm -rf vendor
	make up
	make i
i:
	./bin/composer install
install: i
up:
	if which docker-sync > /dev/null; then \
		docker-sync start; \
		docker-compose -f docker-compose.yml -f docker-compose-sync.yml up -d --build; \
	else \
		docker-compose -f docker-compose.yml up -d --build; \
	fi
down:
	if which docker-sync > /dev/null; then \
		docker-compose -f docker-compose.yml -f docker-compose-sync.yml down || true; \
		docker-sync stop; \
	else \
		docker-compose -f docker-compose.yml down || true; \
	fi
unit:
	./bin/phpunit
