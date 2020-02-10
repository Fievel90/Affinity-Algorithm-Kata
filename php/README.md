# What's included

Here you can find a dockerfile based on `php:alpine`, including the latest version of php, xdebug and composer.

Configure xdebug through environment variable on docker-compose and run the container with:
```shell script
docker-compose run php sh
```

Useful composer dependencies installed are:
- **friendsofphp/php-cs-fixer**: use it to follow coding standard and make the code more readable and maintainable.

    Launch with:
    ```shell script
    composer cs-fix
    ```

- **phpstan/phpstan**: use it to run a static analysis of your project and make the code more robust;

    Launch with:
    ```shell script
    composer phpstan
    ```

- **phpunit/phpunit**: tests, tests, tests.. just write them and you will see the benefits!

    Launch with:
    ```shell script
    vendor/bin/phpunit -c phpunit.xml.dist tests/
    ```
