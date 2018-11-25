# simple-todolist-php
A simple to do list made with PHP language.

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

```bash
$ cd myproject
$ php -S localhost:8080 -t public index.php
```