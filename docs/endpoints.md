# Documentation de l'API

| Endpoint | HTTP request method | Data to send | Description |
|--|--|--|--|
| `/categories` | GET | - | Return data of all the categories |
| `/categories` | POST | name, status | Add a new category. Return the category created |
| `/categories/[id]` | GET | - | Return all data of a specific category |
| `/categories/[id]` | PUT | name, status | Update all data of a specific category |
| `/categories/[id]` | PATCH | name AND/OR status | Update partial data of a specific category |
| `/categories/[id]` | DELETE | - | Delete a specific category |
| `/tasks` | GET | - | Return data of all the tasks |
| `/tasks` | POST  | title, category_id (or category id, but we have to choose), completion, status | Add a new task |
| `/tasks/[id]` | GET | - | Return all data of a specific task |
| `/tasks/[id]` | PUT | title, categoryId, completion, status | Update all data of a specific task |
| `/tasks/[id]` | PATCH | title and/or categoryId and/or completion and/or status | Update partial data of a specific task |
| `/tasks/[id]` | DELETE | - | Delete a specific task |
