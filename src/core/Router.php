<?php
class Router {
    private static $routes = [];
    private static $routed = false; // Flag to prevent double routing
   
    // Method to define routes manually
    public static function add($route, $controller, $method = 'index') {
        self::$routes[$route] = ['controller' => $controller, 'method' => $method];
    }
   
    // Handles the routing logic
    public static function route($url) {
        // Prevent double routing
        if (self::$routed) {
            return;
        }
        self::$routed = true;
        
        // Parse URL to get just the path without query string
        $parsedUrl = parse_url($url);
        $path = $parsedUrl['path'] ?? '/';
        
        // Clean and standardize the URL
        $path = trim($path, '/');
        
        // Debug output (remove in production)
        // echo "<!-- DEBUG: Routing path: '$path' -->\n";
        
        if (isset(self::$routes[$path])) {
            $controller = self::$routes[$path]['controller'];
            $method = self::$routes[$path]['method'];
        } else {
            $parts = explode('/', $path);
            $controller = !empty($parts[0]) ? ucfirst($parts[0]) . 'Controller' : 'HomeController';
            $method = $parts[1] ?? 'index';
        }
       
        $controllerFile = "controllers/" . $controller . ".php";
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($controller)) {
                $instance = new $controller();
                if (method_exists($instance, $method)) {
                    $instance->$method();
                    return;
                } else {
                    echo "Error: Method '$method' not found in $controller.";
                }
            } else {
                echo "Error: Class '$controller' not found.";
            }
        } else {
            echo "Error: Controller file '$controllerFile' not found.";
        }
       
        http_response_code(404);
        echo "404 - Not Found";
    }
}

// Define custom routes
Router::add('', 'HomeController', 'index'); // Default homepage
Router::add('signin', 'SigninController', 'index');
Router::add('signup', 'SignupController', 'index');

// You need to actually call the route method with current URL
Router::route($_SERVER['REQUEST_URI']);