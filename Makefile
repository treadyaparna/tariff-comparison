run-setup:
	cp ./src/.env.example ./src/.env
	docker compose build
	docker compose up -d
	docker exec php /bin/sh -c "composer install && chmod -R 777 storage && php artisan key:generate && php artisan jwt:secret && php artisan l5-swagger:generate"

run-docs:
	docker exec php /bin/sh -c "php artisan l5-swagger:generate"

run-app:
	docker compose build
	docker compose up -d

kill-app:
	docker compose down
	docker system prune
