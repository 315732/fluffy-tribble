<?php
/**
 * Class Router
 * 
 * A simple PHP router that maps URLs to controllers and methods.
 */
class Router {
    /**
     * @var array Stores the route definitions (path => controller & method).
     */
    private static $routes = [];
    
    /**
     * @var bool Flag to prevent multiple route executions.
     */
    private static $routed = false;
   
    /**
     * Adds a new route to the router.
     * 
     * @param string $route The URL path (e.g., 'home', 'signin').
     * @param string $controller The controller class name.
     * @param string $method The method to be called in the controller (default: 'index').
     */
    public static function add($route, $controller, $method = 'index') {
        self::$routes[$route] = ['controller' => $controller, 'method' => $method];
    }
   
    /**
     * Processes the given URL and routes it to the corresponding controller and method.
     * 
     * @param string $url The requested URL (usually from $_SERVER['REQUEST_URI']).
     */
    public static function route($url) {
        // Prevent double execution of routing logic
        if (self::$routed) {
            return;
        }
        self::$routed = true;
        
        // Parse URL to extract the path (ignore query parameters)
        $parsedUrl = parse_url($url);
        $path = $parsedUrl['path'] ?? '/';
        
        // Trim and standardize the URL path
        $path = trim($path, '/');
        
        // Check if the path exists in predefined routes
        if (isset(self::$routes[$path])) {
            $controller = self::$routes[$path]['controller'];
            $method = self::$routes[$path]['method'];
        } else {
            // Default routing: Convert URL segments into controller and method
            $parts = explode('/', $path);
            $controller = !empty($parts[0]) ? ucfirst($parts[0]) . 'Controller' : 'HomeController';
            $method = $parts[1] ?? 'index';
        }
       
        // Construct the expected controller file path
        $controllerFile = "controllers/" . $controller . ".php";
        
        // Check if the controller file exists
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            
            // Check if the class exists
            if (class_exists($controller)) {
                $instance = new $controller();
                
                // Check if the method exists and call it
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
       
        // If no valid route is found, return a 404 error
        http_response_code(404);
        echo "404 - Not Found";
    }
}

// Define custom routes
Router::add('', 'HomeController', 'index'); // Default homepage
Router::add('signin', 'SigninController', 'index');
Router::add('signup', 'SignupController', 'index');

// Invoke the router with the current request URL
Router::route($_SERVER['REQUEST_URI']);
