# simple-todolist-php
A simple to do list made with PHP language.
It already for running on server and testing.

## Usage

1. You need to turn on Mysql server on your computer.
2. Run command

```bash
$ vendor\bin\phinx migrate
$ vendor\bin\phinx seed:run
```

3. Dump file autoload with command

```bash
$ composer dumpautoload -o
```

4. You may quickly test this using the built-in PHP server:
At root folder of it run this command

```bash
$ php -S localhost:8080 -t public index.php
```

## Testing

Run this command for testing. Make sure you have data on database.
Some case can not run by testing because I have updated method, controller and more function.
In the future I will to do that.

```bash
$ composer run test
```
