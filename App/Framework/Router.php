<?php
namespace Framework;

use App\controllers\ErrorController;

class Router {
    protected $routes = [];

    /**
     * Register a new route.
     * @param string $method
     * @param string $uri
     * @param string $action
     * @return void
     */
    public function registerRoute($method, $uri, $action) {
        list($controller, $controllerMethod) = explode('@', $action);
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
        ];
    }

    /**
     * Add a POST route.
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function post($uri, $controller) {
        $this->registerRoute('POST', $uri, $controller);
    }

    /**
     * Add a GET route.
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function get($uri, $controller) {
        $this->registerRoute('GET', $uri, $controller);
    }

    /**
     * Add a PUT route.
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function put($uri, $controller) {
        $this->registerRoute('PUT', $uri, $controller);
    }

    /**
     * Add a DELETE route.
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function delete($uri, $controller) {
        $this->registerRoute('DELETE', $uri, $controller);
    }

    /**
     * Route the request
     * @param string $uri
     * @return void
     */
    public function route($uri) {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Check for _method input
        if($requestMethod === 'POST' && isset($_POST['_method'])){
            // Override the request method with the value of _method
            $requestMethod = strtoupper($_POST['_method']);
        }
        
        foreach ($this->routes as $route) {
            // Split the current URI into segments (listings/1 => [listings, 1])
            $uriSegments = explode('/', trim($uri, '/'));
            $routeSegments = explode('/', trim($route['uri'], '/'));
            
            // Check if number of segments matches and HTTP method matches
            if (count($uriSegments) === count($routeSegments) && 
                strtoupper($route['method']) === $requestMethod) {
                
                $params = [];
                $match = true;
                
                for ($i = 0; $i < count($uriSegments); $i++) {
                    // If the segments don't match and there's no parameter placeholder
                    if ($routeSegments[$i] !== $uriSegments[$i] && 
                        !preg_match('/\{(.+?)\}/', $routeSegments[$i])) {
                        $match = false;
                        break;
                    }
                    
                    // Check for parameter placeholders
                    if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                        $params[$matches[1]] = $uriSegments[$i];
                    }
                }
                
                if ($match) {
                    // Found a matching route - instantiate controller and call method
                    $controller = 'App\\controllers\\' . $route['controller'];
                    $controllerMethod = $route['controllerMethod'];
                    
                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod($params);
                    return;
                }
            }
        }
        
        // No route matched - show 404
        ErrorController::notFound();
    }
}