<?php
class Router
{
    private static $routes = [];
    
    public static function add($route, $controller, $method = 'index')
    {
        // Store routes in a simple format
        self::$routes[$route] = [
            'controller' => $controller,
            'method' => $method
        ];
    }
    
    public static function route($url)
    {
        // Extract the path from the URL
        $parsedUrl = parse_url($url);
        $path = trim($parsedUrl['path'] ?? '/', '/');
        
        // Handle subdirectory if your site is in one
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $scriptDir = dirname($scriptName);
        if ($scriptDir != '/' && $scriptDir != '\\') {
            $scriptDir = trim($scriptDir, '/');
            $path = preg_replace('/^' . preg_quote($scriptDir, '/') . '/', '', $path);
        }
        
        $path = trim($path, '/');
        
        // Check if we have a direct match in our routes
        if (isset(self::$routes[$path])) {
            $controller = self::$routes[$path]['controller'];
            $method = self::$routes[$path]['method'];
            
            // Load the controller file
            $controllerFile = "controllers/{$controller}.php";
            
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                $instance = new $controller();
                $instance->$method();
                return;
            }
        }
        
        // No route found
        header("HTTP/1.0 404 Not Found");
        echo "404 - Page Not Found";
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
