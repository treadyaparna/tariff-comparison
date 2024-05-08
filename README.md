# Tariff Comparison

...

## Business Requirements

...

## Functional Requirements

...

#### User's sequence diagram 
...


## Tech-Stack

- [PHP 8.1](https://www.php.net/releases/8.2/en.php)
- [Laravel 10](https://laravel.com/)
- [MySQL](https://www.mysql.com/)
- [Docker](https://www.docker.com/), [Docker Compose](https://docs.docker.com/compose/), [Alpine Docker Image](https://hub.docker.com/_/alpine)
- [Nginx](https://www.nginx.com)
- [Composer](https://getcomposer.org/)
- [Swagger](https://swagger.io/)
- [PHPUnit 10](https://phpunit.de/)
- [Makefile](https://www.gnu.org/software/make/)


## Configuration

Adjust the configuration in the `.env.example` file to suit your requirements before initiate the project setup.

## Set Up Instructions

Before you start, ensure you've [Docker](https://www.docker.com/products/docker-desktop/), `docker-compose` installed and running on your system.

To set up the project:

- Clone the repository to your local machine.
- Navigate to the project's folder.
- Create a `.env` file for the Laravel environment based on the `.env.example` file located in the source (`src`)
  folder.
- Build Docker containers: `docker-compose build`
- Start Docker containers: `docker-compose up -d`


Once the project container is ready, run these commands inside the `php` container:

- Enter the `php` container: `docker exec -it php /bin/sh`
- Install dependencies: `composer install`
- Set directory permissions for the `storage` folder: `chmod -R 777 storage`
- Generate the application key if not already set: `php artisan key:generate`
- Generate the JWT secret key `php artisan jwt:secret`
- (Optional) Regenerate Composer autoload files: `composer dump-autoload`

Once project dependencies are installed, it's time to set up the database:

- To generate the database schema: `php artisan migrate`
- Seed the database with test data: `php artisan db:seed`


Alternatively, you can install `make` and run the make commands mentioned in the `Makefile` to set up the project quickly.

```
make run-app-with-setup-db
```

## API Endpoints

As per functional requirements, the following API endpoints are available:

...

## API Documentation

The API documentation is generated using Swagger. To access the API documentation, ensure that the project is running and that the Swagger API documentation has already been generated.

- Ensure the project is running.

- Verify if the Swagger API documentation is generated. If not, regenerate it by running the following command:

```shell
php artisan l5-swagger:generate
```

- By default, you can access the Swagger API documentation at the following URL: http://localhost:8001/api/documentation 

    Simply open the URL in your web browser to explore the API documentation and interact with the endpoints.

... (Screenshot of the Swagger API documentation)

## Running Tests

To validate the functionality and ensure code quality, execute the following command within the `php` container:

```shell
php artisan test
```

This command initiates the test suite, running all defined tests to verify that the application behaves as expected and meets quality standards.

... (screenshots of the test results)

## License

This project is licensed under the MIT License (see LICENSE file).