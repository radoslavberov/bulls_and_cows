## Bulls and Cows game requirements:

1. It should be user-friendly.

2. User should be able to enter 4 unique digits

3. User should find out randomly generated 4 unique digit number

4. The digits in use should have the following limitation:

-  digits 1 and 8 should be right next to each other

-  digits 4 and 5 shouldn't be on even index / position

5. List top 10 best results (high score)
### Pre-requirements
- Laravel 8 is used (php version 7.4)

### Installation steps

- Clone the repository
- Rename .env.example to .env
- Change the DB_CONNECTION in .env to sqlite
- Add the absolute path to the sqlite database in .env DB_DATABASE
- Run composer install
- Run npm install
- Make nuvei.sqlite file in the root of database folder
- run php artisan migrate:seed
