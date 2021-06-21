#!/bin/bash

COMPOSE_HTTP_TIMEOUT=600 docker-compose -f docker-compose.dev.yml -f docker-compose.yml up -d --force-recreate
