#!/usr/bin/env bash

docker-compose up --force-recreate -d && \
cp ./docker/site/.env.dist ./site/.env && \
cp ./docker/weather_history/.env.dist ./weather_history/.env && \
docker-compose exec -T site composer install && \
docker-compose exec -T site php yii app/setup
docker-compose exec -T weather_history composer install && \
docker-compose exec -T weather_history php yii app/setup

echo ""
echo "Complete!"
echo "Visit: http://localhost:8888"