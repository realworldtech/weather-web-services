#!/bin/bash

kill_run_rm_containers() {
docker ps -a | grep weatherws | grep _run | grep Exited | awk '{print $1}' | xargs docker rm -f
}

docker-compose build
docker-compose up -d
docker-compose run --rm command ./manage.py syncdb --noinput

docker-compose run --rm command ./manage.py collectstatic --noinput

docker-compose run --rm command ./manage.py createsuperuser

docker-compose restart
