#Array Comparator

This librairy can validate array in recursive. If one or more fields not match, there is an exception

In some cases the need for more advanced matching arises.
All custom functions is used in place of the string value they are validating

- `<date>`
  - Regex `^[0-9]{4}-[0-9]{2}-[0-9]{2}$`
  - Ex: `2022-06-01`
- `<dateTime>`
  - regex `^[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}:[0-9]{2}\+[0-9]{2}:[0-9]{2}$`
  - Ex: `2021-09-22T14:45:59+02:00`
- `<int>`
  - Match only if value is an integer
  - Ex: `3`
- `<string>`
  - Match only if value is a string
  - Ex: `"Foo"`
