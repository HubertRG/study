@@@@@ Projekt zaliczeniowy z laboratorium "Programowanie aplikacji internetowych"
@@@@@ Tematyka projektu: Piekarnio-cukiernia
@@@@@ Autor: Hubert Gosik

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