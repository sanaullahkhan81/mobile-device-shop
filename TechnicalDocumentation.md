# Technical Documents #

## Table structure is declared in file 
`app/database/migration/2022_08_26_222805_create_devices_table.php`

## Changed ID to UUID on Laravel applications
1. Added `app/Traits/Uuids.php` Traits file to set Uuid instead of ID
2. Using Triat in the Model `app/Models/Device` will override ID to Uuids

## Changing default name of laravel `CREATED_AT` and UPDATED_AT Column names 
   Adding Consts as below in the model `app/Models/Device`

```` 
   const CREATED_AT = 'created_datetime';
   const UPDATED_AT = 'update_datetime';
````
