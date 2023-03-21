up: docker-up
down: docker-down
restart: docker-down docker-up
build: docker-build
init: docker-down docker-pull docker-build docker-up

#-----------------------------------------------------

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

# client-request-emitter
emitter-composer-install:
	docker-compose run --rm client-request-emitter composer install

emitter-composer-require:
	docker-compose run --rm client-request-emitter composer require ${name}

emitter-run:
	docker-compose run --rm client-request-emitter php cli/index.php ${count}

# client-request-processor
processor-composer-install:
	docker-compose run --rm client-request-processor composer install

processor-composer-require:
	docker-compose run --rm client-request-processor composer require ${name}

processor-run:
	docker-compose run --rm client-request-processor php cli/index.php