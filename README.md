## How to install on Windows

1. Install WAMP https://soft98.ir/script/3381-wampserver.html
2. Make a DataBase in wamp. (Write down its name)
3. download or clone this project and put it at wamp's root. (I guess it was at c:/www/?) not sure
4. install composer (https://getcomposer.org/Composer-Setup.exe)
5. Open this project (which you have put at wamp's root) in an IDE or Editor.
6. Edit its .env file 

```env
DB_DATABASE=taxi
DB_USERNAME=root
DB_PASSWORD=root
```
change DB_DATABASE to the name you picked on step 2. eg:

```env
DB_DATABASE=whatever
DB_USERNAME=root
DB_PASSWORD=
```

Also put `DB_PASSWORD=` I guess wamp database had no password.

7. run this commands in your terminal (IDE's terminal or cmd at wamp's root) : 

```bash
composer install
php artisan migrate
```

## How to use

### List all the commands

```bash
php artisan list taxi
```

#### Example of how to run a listed command

```bash
php artisan taxi:cab:add
```

## Dependencies

Here's the chain of dependencies : 

```
trip -> shift -> driver -> cab -> car_model
```

It means trip needs at least a shift, shift needs at least a driver and ...

So start via : `taxi:car_model:add` then `taxi:cab:add` and ...


## Some explaining about trip add

When you use trip add, it will check the current time of your computer and then searches the shifts and finds all the assigned driver's at this shift and shows a list of these drivers for you to select.


## Folder Structure

1. Table generating files : database/migrations
2. Database Models : app/Models
3. Command line commands : app/Console/Commands

## Database Structure

![](./screenshot/Screen%20Shot%201401-03-21%20at%2012.58.19.png)
![](./screenshot/Screen%20Shot%201401-03-21%20at%2012.58.27.png)
