all: init bash

uid = $$(id -u)
pwd = $$(pwd)

# tries to determine the IP of the host - won't work on mac?
host = $$(ip addr show docker0 | grep " inet " | awk '{ print $$2}' | cut -d "/" -f1)

init:
	docker build -t ssml ./resources/docker

docker:
	docker run -it --rm -e LOCAL_USER_ID=`id -u` -e XDEBUG_CONFIG="remote_host=dockerhost" -e PHP_IDE_CONFIG="serverName=ssml" --name ssml --add-host dockerhost:$(host) -v $(pwd):/usr/src -w /usr/src ssml $(args)

bash:
	make docker args=bash

test:
	rm -rf ./resources/test-results
	make docker args="./vendor/bin/phpunit --coverage-html ./resources/test-results"

fix:
	make docker args="php-cs-fixer fix ./src --rules=@PSR2 --using-cache=no"
	make docker args="php-cs-fixer fix ./tests --rules=@PSR2 --using-cache=no"