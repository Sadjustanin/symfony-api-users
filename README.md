# REST API for CRUD operations on users

Simple symfony application for basic user management.

## Usage

To get started, make sure you have [PHP](https://www.php.net/downloads), [Composer](https://getcomposer.org/download/) and [PostgreSQL](https://www.postgresql.org/download/) installed on your system, and then clone this repository.

Next navigate in your terminal to the directory you cloned this, run migrations to create table by running `composer i && php bin/console doctrine:migrations:migrate` and run local web server by running `symfony server:start`.

**Note**: Copy .env.example and rename it to .env. The default postgresql database configuration is already there, but you can customize it as you need it.

## If you want to use docker

Three additional containers are included that handle Composer, PHP, Symfony commands *without* having to have these platforms installed on your local computer.
Use the following command examples from your project root, modifying them to fit your particular use case.

**Before deploying the application change the host `127.0.0.1` in DATABASE_URL inside .env to `database`.**

- To deploy the application `docker compose up`
- To stop the application `docker compose down`

## Documentation

127.0.0.1:8000 - local web host, use it to interact with the API

**Entity:**

```
        User:
                - id (uuid, auto-determined)
                - email (varchar, unique)
                - name (varchar, range: 1-1100)
                - age (int, range: 6 - 154)
                - sex (char: 'm' || 'M' || 'f' || 'F')
                - birthday (date, format: 1870-01-01, range: 1870-01-01 - 2018-01-01)
                - phone (varchar, unique, format: RU)
                - created_at (timestamp, auto-determined)
                - updated_at (timestamp, auto-determined)
```

**Routes:**

```
        /api/register [POST] - Create a new user with the specified data
                Body (json):
                        - email
                        - name
                        - age
                        - sex
                        - birthday
                        - phone
```

```
        /api/search [GET] - Get information about a user by their e-mail address
                Body (json):
                        - email
```

```
        /api/changeEmail [PUT] - Change the current e-mail address to the specified one
                Body (json):
                        - emailOld
                        - emailNew
```

```
        /api/delete [DELETE] - Delete a user by e-mail address
                Body (json):
                        - email
```