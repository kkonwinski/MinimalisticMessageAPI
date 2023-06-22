# Minimalistic Message API

Minimalistic Message API to prosty i minimalistyczny projekt API oparty na Symfony 6.3, który służy do zarządzania wiadomościami.

## Funkcjonalności

- Dodawanie nowych wiadomości
- Pobieranie wszystkich wiadomości
- Pobieranie wiadomości na podstawie UUID
- Pobieranie wiadomości na podstawie UUID i daty utworzenia

## Endpointy

- POST /api/message/add: Dodaje nową wiadomość. Oczekuje pola "message" w ciele żądania.
- GET /api/messages: Zwraca wszystkie wiadomości.
- GET /api/message/list/{uuid}: Zwraca wiadomość o danym UUID.
- GET /api/message/list/{uuid}/{createdAt}: Zwraca wiadomości o danym UUID i dacie utworzenia.

## Wymagania

- PHP 8.0+
- Docker 24.0.0+
- Docker Compose 2.18.0+

## Uruchomienie

1. Sklonuj repozytorium do lokalnej maszyny.
2. Uruchom `docker-compose build && docker-compose up -d` w głównym katalogu projektu.
3. API jest dostępne na porcie 8080 (localhost:8080).

## Struktura kontenerów Docker

- `minimalistic_message_api_nginx` (nginx:stable-alpine): Serwer webowy, dostępny na porcie 8080.
- `minimalistic_message_api_php` (minimalisticmessageapi-php): Kontener z PHP, dostępny na porcie 81.
- `minimalistic_message_api_phpmyadmin` (phpmyadmin/phpmyadmin): PHPMyAdmin dla zarządzania bazą danych, dostępny na porcie 8081.
- `minimalistic_message_api_database` (mariadb:10): Baza danych MariaDB, dostępna na porcie 8083.

## Baza danych

Informacje dotyczące bazy danych można uzyskać logując się do PHPMyAdmin za pomocą kontenera `minimalistic_message_api_phpmyadmin` na porcie 8081.

## Licencja

Ten projekt jest dostępny na licencji MIT.
