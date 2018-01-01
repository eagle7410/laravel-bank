**Міграції для таблиць:**
**__profiles__**

| Columns | Type |
| ------------- |----- |  
| id | integer() |   
| user_id | integer() |  
| name | varchar(100) |  
| middle_name | varchar(100) |  
| surname | varchar(150) |  
| man | boolean() |  
| birthday | date() |  
| age | smollint() |
| created_at | date() |
| created_by | integer() |
| updated_at | date() |
| updated_by | integer() |

**__deposits__**

| Columns | Type |
| ------------- |----- |
| id | integer() |
| user_id | integer() |
| sum | float(2) |
| percent | float(2) |
| start_at | date() |
| status_id | boolean() |
| created_at | date() |
| created_by | integer() |
| updated_at | date() |
| updated_by | integer() |

**__deposit_statuses__**

| Columns | Type |
| ------------- |----- |
| id | integer() |
| name | string() |
| desc | text() |

**__deposit_actions__**

| Columns | Type |
| ------------- |----- |
| id | integer() |
| name | string() |
| desc | text() |

**__deposit_history__**

| Columns | Type |
| ------------- |----- |
| id | integer() |
| deposit_id | integer() |
| deposit_action_id | integer() |
| sum_before | float(2) |
| sum_after | float(2) |
| created_at | date() |
| created_by | integer() |
| comment | text() |
