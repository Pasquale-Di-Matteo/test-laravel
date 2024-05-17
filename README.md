# Configurazione del file .env per Laravel

Il file `.env` contiene le variabili di configurazione per il progetto Laravel. Di seguito è riportata una spiegazione di ciascuna variabile.

## Variabili di Configurazione

### APP_KEY

-   **Descrizione:** Chiave dell'applicazione utilizzata per la crittografia.
-   **Esempio:** `APP_KEY=base64:QW1lRW5jcnlwdGVkS2V5RXhhbXBsZQ==`
-   **Comando:** `php artisan key:gen`

### DB_CONNECTION

-   **Descrizione:** Tipo di connessione al database.
-   **Valori possibili:** `mysql`, `pgsql`, `sqlite`, `sqlsrv`
-   **Esempio:** `DB_CONNECTION=mysql`

### DB_HOST

-   **Descrizione:** Indirizzo host del database.
-   **Esempio:** `DB_HOST=127.0.0.1`

### DB_PORT

-   **Descrizione:** Porta di connessione del database.
-   **Esempio:** `DB_PORT=3306`

### DB_DATABASE

-   **Descrizione:** Nome del database.
-   **Esempio:** `DB_DATABASE=laravel`

### DB_USERNAME

-   **Descrizione:** Nome utente per la connessione al database.
-   **Esempio:** `DB_USERNAME=root`

### DB_PASSWORD

-   **Descrizione:** Password per la connessione al database.
-   **Esempio:** `DB_PASSWORD=`

### Comandi da eseguire

-   `npm i`
-   `composer i`
-   `php artisan migrate`
-   `php artisan db:seed DatabaseSeeder`
-   `npm run test`
-   `php artisan serve`

Questa configurazione ti permette di iniziare rapidamente lo sviluppo in un ambiente MAMP tradizionale. Ho cercato di creare un ambiente anche con Docker, ma è la prima volta che lo uso a questi livelli.
