<?php

class Router
{
    private static $routes = [];
    private static $routed = false;
    private static $basePath = '';
    
    /**
     * Set the base path for the application (if it's in a subdirectory)
     */
    public static function setBasePath($basePath)
    {
        self::$basePath = '/' . trim($basePath, '/');
    }
    
    /**
     * Adds a new route to the router.
     */
    public static function add($route, $controller, $method = 'index')
    {
        // Convert route patterns (e.g., 'user/{id}') into regex for matching
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9-_]+)', $route);
        self::$routes["/^" . str_replace('/', '\/', $pattern) . "$/"] = [
            'controller' => $controller,
            'method' => $method
        ];
    }
    
    public static function route($url)
    {
        if (self::$routed) return;
        self::$routed = true;
        
        $parsedUrl = parse_url($url);
        $path = trim($parsedUrl['path'] ?? '/', '/');
        
        // Remove base path if set
        if (!empty(self::$basePath)) {
            $basePath = trim(self::$basePath, '/');
            if (strpos($path, $basePath) === 0) {
                $path = substr($path, strlen($basePath));
            }
        }
        
        $path = trim($path, '/');
        
        // Handle empty path
        if (empty($path)) {
            $path = '';
        }
        
        foreach (self::$routes as $pattern => $route)
        {
            if (preg_match($pattern, $path, $matches))
            {
                array_shift($matches); // Remove the full match
                $controller = $route['controller'];
                $method = $route['method'];
                $controllerFile = "controllers/" . $controller . ".php";
                
                if (file_exists($controllerFile))
                {
                    require_once $controllerFile;
                    if (class_exists($controller))
                    {
                        $instance = new $controller();
                        if (method_exists($instance, $method))
                        {
                            $instance->$method(...$matches); // Pass extracted parameters
                            return;
                        }
                        else
                        {
                            echo "Error: Method '$method' not found in $controller.";
                        }
                    }
                    else
                    {
                        echo "Error: Class '$controller' not found.";
                    }
                }
                else
                {
                    echo "Error: Controller file '$controllerFile' not found.";
                }
                http_response_code(404);
                return;
            }
        }
        
        http_response_code(404);
        echo "404 - Not Found";
    }
}


// Define custom routes
Router::add('', 'HomeController', 'index'); // Default homepage

Router::add('signin', 'SigninController', 'index');
Router::add('signup', 'SignupController', 'index');
Router::add('signout', 'SignoutController', 'index');


Router::add('course', 'CourseController', 'index');
Router::add('about',  'AboutController',  'index');
Router::add('blog', 'BlogController', 'index');
Router::add('blog-list', 'BlogListController', 'index');


Router::add('admin-signin', 'AdminSignInController', 'index');
Router::add('admin-dashboard', 'AdminDashboardController', 'index');
Router::add('admin-create-blog', 'AdminCreateBlogController', 'index');

// Routes with dynamic parameters
//Router::add('user/{id}', 'UserController', 'profile');
//Router::add('post/{id}/view', 'PostController', 'view');
//Router::add('order/{id}/status', 'OrderController', 'status');

// Invoke the router with the current request URL
Router::route($_SERVER['REQUEST_URI']);
