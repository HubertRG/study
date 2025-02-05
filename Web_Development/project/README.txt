@@@@@ Tematyka projektu: Piekarnio-cukiernia

@@@@@ Funkcjonalności:
- zakładanie kont oraz logowanie,
- uwierzytelnianie,
- wyświetlanie menu produktów,
- składanie zamówień dla zalogowanych użytkowników,
- przeglądanie, edycja oraz usuwanie zamówień,
- edycja danych konta, zmiana hasła,
- zadawanie pytań bez potrzeby logowania,
- panel administratora: usuwanie kont, edycja i usuwanie zamówień, usuwanie pytań.

@@@@@ Wymagania:
- XAMPP (MySQL Database, APACHE Web Server)
- PHP 7.3.x

@@@@@ Uruchomienie:
- Folder "project" z folderu GosikProjekt umieścić w "XAMPP\htdocs"
- Włączyć XAMPP MySQL Database oraz Apache Web Server
- Otworzyć panel zarządzania bazą danych phpMyAdmin wpisując w przeglądarkę adres "localhost/phpmyadmin"
- Z menu w górnej części strony wybrać opcję import
- Wybranie pliku project.sql z katalogu GosikProjekt, wybranie zestawu znaków utf-8, następnie wciśnięcie przycisku import
- W przypadku braku powodzenia importu, należy manualnie utworzyć bazę danych oraz potrzebne tabele kopiując polecenia z pliku project.sql
- Po poprawnym imporcie bazy danych, uruchomić aplikację wpisując w przeglądarkę adres "localhost/project/views/index.php"

@@@@@ Założone konta ze złożonymi zamówieniami:
-
    login: jkowalski
    hasło: Haslo123!
-
    login: anowak
    hasło: Haslo123!
-
    login: admin
    hasło: Admin123!

-----------------------------------------------------------------------------------------------------------------------------------------------------------------
@@@@@ Project theme: Bakery and pastry shop

@@@@@ Functionality:
- account creation and login,
- authentication,
- product menu display,
- placing orders for logged-in users,
- viewing, editing and deleting orders,
- edit account details, change password,
- asking questions without logging in,
- admin panel: deleting accounts, editing and deleting orders, deleting questions.

@@@@@ Requirements:
- XAMPP (MySQL Database, APACHE Web Server)
- PHP 7.3.x

@@@@@ Startup:
- Place the ‘project’ folder from the GosikProject folder in ‘XAMPP\htdocs’.
- Switch on XAMPP MySQL Database and Apache Web Server
- Open the phpMyAdmin database management panel by typing ‘localhost/phpmyadmin’ into your browser
- Select import from the menu at the top of the page
- Select the project.sql file from the GosikProjekt directory, select the utf-8 character set, then press the import button
- If the import is unsuccessful, manually create the database and the necessary tables by copying the commands from the project.sql file
- Once the database has been imported correctly, start the application by typing ‘localhost/project/views/index.php’ into the browser

@@@@@ Accounts created with orders placed:
-
    login: jkowalski
    password: Haslo123!
-
    login: anowak
    password: Haslo123!
-
    login: admin
    password: admin123!

