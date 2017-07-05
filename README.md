# Simple PHP API

Simple REST Api Framework for PHP's backend projects

## Getting Started

Go to Installing and Running the test sections.

### Prerequisites

* PHP >= v5.5
* Composer (optional)

### Installing

* php composer.phar install (or composer install)
* Set the parameters in config /app/Config.php if ($database_config['name'] is empty, doesn't load database)
* Configure path in .htaccess RewriteBase /
* Enjoy the API

## Running the tests

For test change [YOUR_API_URL] with the url where is located the api:

* http://[YOUR_API_URL]/ -> Api entrypoint
* http://[YOUR_API_URL]/blog -> For simple path example
* http://[YOUR_API_URL]/controlador -> For simple path example using controller
* http://[YOUR_API_URL]/data/{id}-> Sample for var id (change {id} with you test var)

## Built With

* [PHP](https://www.php.net) - PHP >= v5.5
* [Apache](https://www.apache.org/) - Dependency Management

## Authors

[kid_goth](https://www.twitter.com/_kid_goth) - Brandon Sanchez

## License - MIT

Copyright 2017 Brandon Sanchez

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
