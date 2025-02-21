# Podstawy pracy z API

Komunikacja z Portalem przy pomocy API odbywa się za pomocą tokena.
Przed wykonaniem zapytań, trzeba ten token wygenerować.

Do generowania tokena służy endpoint **POST** `/api/token` z danymi użytkownika:
- `email`,
- `password`.

W przypadku udanego zalogowania zwrócony zostanie komunikat o sukcesie, a w nim token.
Ten token należy przekazywać w kolejnych zapytaniach jako **Bearer token**.
