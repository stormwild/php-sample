php-sample
==========

A sample application which lists users.

The goal of the application is to also be able to list a user's connections on a network similar to your facebook friend's list.

A user's connection is stored in a connection table that contains a reference to the userId and the friendId both of which are references to the user table id column.

The problem would be how to query the connections for each user.

## Pre-requisite

- PHP >= 5.6
- MySQL
- PHPUnit

## Setup

```
composer install
```

### Cloud 9

#### Setup database

```
mysql-ctl cli
```

Within the mysql monitor

```
mysql> use c9;
mysql> source /home/ubuntu/workspace/sample.sql
```

Modify `public/config.php` to provide database info

```
...
'host' => getenv('IP'),
            'username' => getenv('C9_USER'),
            'password' => '',
            'database' => 'sample',
...            
```

## Run

```
php -S $IP:$PORT -t public/
```

## Status

Still a work-in-progress

[php-sample on Cloud9](https://ide.c9.io/stormwild/php-sample)


## Security

Todo: Move `public/config.php` out of public folder.

Todo: Use .env file for config and add to .gitignore

## References:

- [MySQL - Create Database Statement with Unicode Support](https://gist.github.com/stormwild/ca7badceef5ebbbf6448)
- [Setting Up MySQL](https://community.c9.io/t/setting-up-mysql/1718)