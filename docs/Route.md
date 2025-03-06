# Router Class Documentation

## Overview

The `Router` class provides a simple routing mechanism for PHP applications following the MVC (Model-View-Controller) pattern. It allows you to define custom routes or use convention-based routing to direct HTTP requests to the appropriate controller and method.

## Features

- Manual route definition with custom controller and method mapping
- Convention-based routing as fallback (e.g., `/product/view` routes to `ProductController->view()`)
- Prevention of double routing within the same request
- URL parsing to handle query parameters properly
- Simple error handling for missing controllers, classes, or methods

## Usage

### Basic Setup

```php
// Include the Router class
require_once 'path/to/Router.php';

// Define custom routes
Router::add('', 'HomeController', 'index');                // Homepage
Router::add('signin', 'SigninController', 'index');        // Sign in page
Router::add('signup', 'SignupController', 'index');        // Sign up page
Router::add('products', 'ProductController', 'list');      // Products list
Router::add('about-us', 'PageController', 'about');        // About page

// Process the current request
Router::route($_SERVER['REQUEST_URI']);
```

### Directory Structure

The Router expects controllers to be in a `controllers/` directory in the following structure:

```
/
├── controllers/
│   ├── HomeController.php
│   ├── SigninController.php
│   ├── SignupController.php
│   └── ...
└── index.php (or other entry point)
```

### Controller Format

Controllers should follow this format:

```php
<?php
// controllers/HomeController.php
class HomeController {
    public function index() {
        // Code to display the homepage
        include 'views/home.php';
    }
    
    public function about() {
        // Code to display the about page
        include 'views/about.php';
    }
}
```

## Method Reference

### Router::add($route, $controller, $method)

Defines a custom route mapping.

| Parameter | Type | Description |
|-----------|------|-------------|
| $route | string | The URL path (without leading/trailing slashes) |
| $controller | string | The controller class name |
| $method | string | The method to call (defaults to 'index') |

Example:
```php
Router::add('user/profile', 'UserController', 'profile');
```

### Router::route($url)

Processes a URL and routes it to the appropriate controller and method.

| Parameter | Type | Description |
|-----------|------|-------------|
| $url | string | The URL to route (typically $_SERVER['REQUEST_URI']) |

Example:
```php
Router::route($_SERVER['REQUEST_URI']);
```

## Routing Logic

1. **Custom Routes**: First, the router checks if the requested path matches any custom-defined routes.
2. **Convention-based Routing**: If no custom route is found, the router splits the path by slashes:
   - The first segment becomes the controller name (e.g., 'product' → 'ProductController')
   - The second segment becomes the method name (e.g., 'view' → 'view()')
   - If either segment is missing, defaults are used (HomeController and index method)
3. **Error Handling**: If the controller file, class, or method doesn't exist, an appropriate error message is displayed.

## Error Handling

The router provides basic error messages for:
- Missing controller files
- Non-existent controller classes
- Undefined controller methods

If no appropriate controller/method can be found, a 404 response is sent.

## Notes and Best Practices

1. **Single Entry Point**: Use a single entry point (e.g., index.php) with URL rewriting to route all requests through the router.
2. **URL Format**: URLs should be in the format `/controller/method` or match a custom defined route.
3. **Controller Naming**: Controllers should be named with PascalCase followed by "Controller" (e.g., `ProductController`).
4. **Method Naming**: Methods should be named using camelCase (e.g., `viewDetails`).
5. **Double Routing Protection**: The router prevents processing the same request twice which helps avoid duplicate content issues.

## .htaccess Configuration

For Apache servers, you can use the following .htaccess configuration to route all requests through index.php:

```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```