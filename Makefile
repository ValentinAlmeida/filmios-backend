# Constantes
SERVER=filmios-backend
DATABASE=db-filmios

.PHONY: help test start serve serve-front queue stop restart cache migration migrationf seed-generate

help:
	@echo "Available targets:"
	@echo "  make help           - Show this help message"
	@echo "  make test           - Run tests"
	@echo "  make serve          - Start the Laravel server using Docker"
	@echo "  make serve-front    - Start the frontend server using Docker"
	@echo "  make start          - Start both Laravel and frontend servers using Docker"
	@echo "  make start-back     - Start only the Laravel server using Docker"
	@echo "  make start-front    - Start only the frontend server using Docker"
	@echo "  make queue          - Start the Laravel queue listener"
	@echo "  make stop           - Stop all Docker containers"
	@echo "  make cache          - Clear and cache configuration, routes, and views"
	@echo "  make restart        - Restart all Docker containers"
	@echo "  make migration NAME=<table_name> - Create a migration for a new table"

test:
	@echo "Running tests..."
	@if [ ! -z "$(SERVER)" ]; then \
	    docker exec $(SERVER) bash -c "php artisan test"; \
	fi

fresh:
	@echo "Running freshing database..."
	@if [ ! -z "$(SERVER)" ]; then \
	    docker exec $(SERVER) bash -c "php artisan migrate:fresh"; \
	fi

migrate:
	@echo "Running migrations..."
	@if [ ! -z "$(SERVER)" ]; then \
	    docker exec $(SERVER) bash -c "php artisan migrate"; \
	fi


rollback:
	@echo "Running rollback migrations..."
	@if [ ! -z "$(SERVER)" ]; then \
	    docker exec $(SERVER) bash -c "php artisan migrate:rollback"; \
	fi

serve:
	@echo "Starting Laravel server..."
	@if [ ! -z "$(SERVER)" ]; then \
		docker exec -d $(SERVER) bash -c "php artisan serve --host 0.0.0.0"; \
		echo "Server started..."; \
	fi

seed:
	@echo "Seeding database"
	@if [ ! -z "$(SERVER)" ]; then \
		docker exec -d $(SERVER) bash -c "php artisan db:seed"; \
		echo "Database ready..."; \
	fi

serve-front:
	@echo "Starting frontend server..."
	@if [ ! -z "$(FRONT)" ]; then \
		docker exec -d $(FRONT) bash -c "npm run dev -- --host"; \
	fi

start-back:
	@echo "Starting backend server..."
	@if [ ! -z "$(SERVER)" ]; then \
		docker stop $(SERVER); \
		docker start $(DATABASE); \
		docker start $(SERVER); \
		make serve; \
	fi

start-front:
	@echo "Starting frontend server..."
	@if [ ! -z "$(FRONT)" ]; then \
		docker stop $(FRONT); \
		docker start $(FRONT); \
		make serve-front; \
	fi

start:
	@echo "Starting both servers..."
	@if [ ! -z "$(SERVER)" ]; then make start-back; fi
	@if [ ! -z "$(FRONT)" ]; then make start-front; fi

queue:
	@echo "Starting queue listener..."
	@if [ ! -z "$(SERVER)" ]; then \
		docker exec $(SERVER) bash -c "php artisan queue:listen"; \
	fi

key-generate:
	@echo "Create key jwt..."
	@if [ ! -z "$(SERVER)" ]; then \
		docker exec $(SERVER) bash -c "php artisan jwt:generate"; \
	fi

stop:
	@echo "Stopping all servers..."
	@if [ ! -z "$(SERVER)" ]; then docker stop $(SERVER); fi
	@if [ ! -z "$(DATABASE)" ]; then docker stop $(DATABASE); fi
	@if [ ! -z "$(FRONT)" ]; then docker stop $(FRONT); fi

cache:
	@echo "Clearing and caching configuration..."
	@if [ ! -z "$(SERVER)" ]; then \
		docker exec $(SERVER) bash -c "php artisan config:cache && php artisan route:cache && php artisan optimize && php artisan view:clear && composer dump-autoload"; \
	fi

migration:
ifndef n
	$(error You must specify a NAME for the table, e.g., make migration n=example)
endif
	@echo "Creating migration..."
	@if [ ! -z "$(SERVER)" ]; then \
		docker exec $(SERVER) bash -c "php artisan make:migration create_${n}_table --create=${n}"; \
	fi

migrationf:
ifndef n
	$(error You must specify a NAME for the table, e.g., make migrationf n=example)
endif
	@echo "Creating migration with fields..."
	@if [ ! -z "$(SERVER)" ]; then \
		docker exec $(SERVER) bash -c "php artisan make:migration add_fields_${n}_table --create=${n}"; \
	fi

create-users:
ifndef q
	$(error You must specify a QUANTITY of users, e.g., make createusers q=10)
endif
	@echo "Creating users..."
	@if [ ! -z "$(SERVER)" ]; then \
		docker exec $(SERVER) bash -c "php artisan factory:users $(q)"; \
	fi

seed-generate:
ifndef n
	$(error You must specify a NAME for the seeder, e.g., make seed n=example)
endif
	@echo "Generating seeder..."
	@if [ ! -z "$(SERVER)" ]; then \
		docker exec $(SERVER) bash -c "php artisan make:seeder ${n}Seeder"; \
	fi

restart: stop start
