## Sales Taxes

### Installing

You can use docker-compose to build a container network with all requirements:
```
$ docker-compose up -d
```

IMPORTANT: Docker will use ports 8080. Make sure it's available before building the container.

### Input and output
The application entry point is bin/fixture.php, which instantiates some input Carts, runs the application logic and produces an output.

This file is run by an acceptance test which validates the produced output against a Golden Master, which represents the output contract to be respected.

The acceptance test and the Golden Master are located in tests/Acceptance.

### Running the test suite

To run automated tests simply run from the project root inside the container:
```
$ vendor/bin/phpunit
```

### Tech choices
The application was designed to be a domain-pure proof-of-concept.

There are no application or infrastructure concerns, except for the fixture file and tests.

### Disclaimer
This is a case study, thus it is not suitable for a production environment.

### Built With
* PHP 7.4

### Authors
* **Davide Carbone** - *Initial work* - [Davide Carbone](https://github.com/davidecarbone)

### License
This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
