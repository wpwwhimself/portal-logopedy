# Praca z kursami

Do pracy z kursami służy endpoint **POST** `/api/course`.
Za jego pomocą można tworzyć nowe kursy lub aktualizować istniejące, jeśli takie istnieją już w bazie.

## Parametry zapytania

Poprawne ciało zapytania posiada następującą strukturę:

```json
{
    "name": <string>,
    "category": <string>,
    "subcategory": <string?>,
    "description": <string?>,
    "thumbnail_path": <string?>,
    "link": <string?>,
    "trainer_name": <string>,
    "trainer_organization": <string?>,
    "location": <string?>,
    "dates": <datetime[]?>,
    "cost": <string?>,
    "final_document": <string?>,
    "industries": <string[]?>
}
```

## Rozpoznawanie trybu zapytania

Pola `name`, `category` oraz `trainer_organization` są wymagane i na ich podstawie wyszukiwany jest kurs w bazie danych.
- Jeśli taki istnieje, przekazane dane nadpiszą istniejące i zapytanie zwróci kod **200**.
- W przeciwnym przypadku powstanie nowy kurs i zapytanie zwróci kod **201**.

W obu przypadkach w odpowiedzi pojawi się również utworzony wpis.

## Uwagi do pól

- `dates` - array zawierający daty i godziny kursów
- `location` - miejsce kursu - pusta wartość oznacza kurs online
- `industries` - nazwy branż powiązanych z kursem. Portal doda do utworzonego/edytowanego kursu branże, jakie istnieją w jego bazie, na podstawie przekazanych nazw.
