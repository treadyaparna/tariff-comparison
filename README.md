# Electricity Tariff Comparison Platform

This platform allows users to compare electricity prices and estimate their annual costs based on their consumption.
The platform utilizes [an external provider of electricity tariffs](https://github.com/treadyaparna/vx-tariff-provider) to provide accurate pricing information.


**Tariff Provider**


The platform receives tariff data in the following format:

```json
[
   {
      "name":"Product A",
      "type":1,
      "baseCost":5,
      "additionalKwhCost":22
   },
   {
      "name":"Product B",
      "type":2,
      "includedKwh":4000,
      "baseCost":800,
      "additionalKwhCost":30
   },
   "..."
]

```

## Business Requirements

Develop a microservices that reads products from the tariff provider, performs the calculations, and returns the results based on user input (consumption in kWh/year).

**Input:**

```json
{
   "consumption":1000
}
```

**Output:**

```json
[
   {
      "tariffName":"Product A",
      "annualCost":270
   },
   {
      "tariffName":"Product B",
      "annualCost":800
   }
]
```

The list is sorted by costs in ascending order.

## Functional Requirements

- The service must fetch electricity tariff information from an external provider.
- The service should calculate annual costs based on user input consumption and tariff details.
- The service must compare tariffs and return results sorted by annual costs in ascending order.
- The service should validate user input to ensure it falls within acceptable ranges.
- The service must format the output of comparison results in a clear and readable manner.

## Sequence Diagram

The following sequence diagram illustrates the flow of the tariff comparison process:

<img src="Tariff.png" alt="Tariff Comparison Sequence diagram ">


## Technologies Used

The project is built using the following technologies:

- [PHP 8.2](https://www.php.net/releases/8.2/en.php)
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

**Step-1:** To set up the project:

- Clone the repository to your local machine.
- Navigate to the project's folder.
- Create a `.env` file for the Laravel environment based on the `.env.example` file located in the source (`src`)
  folder.
- Build Docker containers: `docker-compose build`
- Start Docker containers: `docker-compose up -d`


**Step-2:** Once the project container is ready, run these commands inside the `php` container:

Run command `docker exec -it php /bin/sh` to access the `php` container.

- Install dependencies: `composer install`
- Set directory permissions for the `storage` folder: `chmod -R 777 storage`
- Generate the application key if not already set: `php artisan key:generate`
- Generate the JWT secret key `php artisan jwt:secret`
- (Optional) Regenerate Composer autoload files: `composer dump-autoload`


**Alternatively**, you can install `make` and run the make commands mentioned in the `Makefile` to set up the project quickly.

```
make run-setup
```

## API Endpoints

As per functional requirements, the following API endpoints are available:

`POST /api/compare-tariffs`: Compare annual tariffs based on the given consumption.

## API Documentation

The API documentation is generated using Swagger. To access the API documentation, ensure that the project is running and that the Swagger API documentation has already been generated.

- Ensure the project is running.

- Verify if the Swagger API documentation is generated. If not, regenerate it by running the following command:

```
php artisan l5-swagger:generate
```

Alternatively, run `make run-docs` command.

By default, you can access the Swagger API documentation at the following URL: http://localhost:8001/api/documentation 

Simply open the URL in your web browser to explore the API documentation and interact with the endpoints.

![img.png](img.png)

## Running Tests

To validate the functionality and ensure code quality, execute the following command within the `php` container:

```
php artisan test
```

This command initiates the test suite, running all defined tests to verify that the application behaves as expected and meets quality standards.


## Contributors

**Aparna Saha** ([LinkedIn](https://www.linkedin.com/in/aparnasaha/))

## License

This project is licensed under the MIT License (see [LICENSE](LICENSE.md) file).