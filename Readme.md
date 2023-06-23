# Minimalistic Message API

Minimalistic Message API to prosty i minimalistyczny projekt API oparty na Symfony 6.3, który służy do zarządzania wiadomościami. Jest to backend dla aplikacji webowej, która umożliwia użytkownikom wysyłanie i odbieranie wiadomości.

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

## Aplikacja frontendowa

Aplikacja frontendowa została napisana w Vue.js 3 i korzysta z Minimalistic Message API do wykonywania wszystkich operacji na wiadomościach. Aplikacja umożliwia użytkownikom wysyłanie nowych wiadomości oraz odczytywanie wszystkich wiadomości.

### Routing w aplikacji frontendowej

Aplikacja korzysta z Vue Router do zarządzania nawigacją. Istnieją dwa główne widoki: "MessageList" i "SendMessage". Użytkownik może przechodzić między tymi widokami, korzystając z poniższych ścieżek:

- /message-list: Wyświetla listę wszystkich wiadomości. Użytkownik ma możliwość sortowania wiadomości na podstawie UUID lub daty utworzenia. Możliwe jest również otworzenie pełnej wiadomości w modalu.
- /send-message: Formularz umożliwiający wysyłanie nowych wiadomości. Po wysłaniu wiadomości, użytkownik otrzymuje powiadomienie o statusie operacji.

### Uruchomienie aplikacji frontendowej

1. Sklonuj repozytorium do lokalnej maszyny.
2. Przejdź do katalogu `frontend` i uruchom `npm install` aby zainstalować wszystkie zależności.
3. Uruchom `npm run dev` aby uruchomić serwer deweloperski. Aplikacja będzie dostępna na `localhost:8082`.

## Wymagania

- PHP 8.1+
- Docker 24.0.0+
- Docker Compose 2.18.0+
- Node.js 18.16.0+
- NPM 9.5.0+

## Uruchomienie

1. Sklonuj repozytorium do lokalnej maszyny.
2. Uruchom `docker-compose build && docker-compose up -d` w głównym katalogu projektu.
3. API jest dostępne na porcie 8080 (`localhost:8080`).

## Struktura kontenerów Docker

- `minimalistic_message_api_php` (php:8.1-fpm-alpine): Kontener PHP, gdzie uruchamiany jest backend.
- `minimalistic_message_api_nginx` (nginx:1.21-alpine): Kontener Nginx, który jest używany jako serwer sieci Web i jest dostępny na porcie 8080.
- `minimalistic_message_api_phpmyadmin` (phpmyadmin/phpmyadmin): PHPMyAdmin dla zarządzania bazą danych, dostępny na porcie 8081.
- `minimalistic_message_api_database` (mariadb:10): Baza danych MariaDB, dostępna na porcie 8083.

## Baza danych

Informacje dotyczące bazy danych można uzyskać logując się do PHPMyAdmin za pomocą kontenera `minimalistic_message_api_phpmyadmin` na porcie 8081.

## Licencja

Ten projekt jest dostępny na licencji MIT.
