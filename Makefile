# Service names
FRONTEND_SERVICE = minimalistic_message_api_frontend
PHP_SERVICE = minimalistic_message_api_php

# Commands
REBUILD_CMD = docker-compose down && docker-compose build && docker-compose up -d
START_CMD = docker-compose up -d
STOP_CMD = docker-compose down

.PHONY: help frontend php rebuild start stop

# Help command
help:
	@echo "Available commands:"
	@echo "  frontend - Connects to the frontend container"
	@echo "  php - Connects to the PHP container"
	@echo "  rebuild - Rebuilds all containers"
	@echo "  start - Starts all containers"
	@echo "  stop - Stops all containers"

# Connect to frontend container
frontend:
	docker exec -it $(FRONTEND_SERVICE) sh

# Connect to PHP container
php:
	docker exec -it $(PHP_SERVICE) bash

# Rebuild all containers
rebuild:
	$(REBUILD_CMD)

# Start all containers
start:
	$(START_CMD)

# Stop all containers
stop:
	$(STOP_CMD)
