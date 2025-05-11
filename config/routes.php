<?php
class Router {
    private $routes = [
        ''          
            => ['controller' => 'DashboardController', 'action' => 'index'],
        'login'             
            => ['controller' => 'AuthController', 'action' => 'loginPage'],
        'register'          
            => ['controller' => 'AuthController', 'action' => 'registerPage'],
        'logout'            
            => ['controller' => 'AuthController', 'action' => 'logout'],
        'dashboard'             
            => ['controller' => 'DashboardController', 'action' => 'index'],
        'realm/create'          
            => ['controller' => 'RealmController', 'action' => 'createPage'],
        'realm/view'            
            => ['controller' => 'RealmController', 'action' => 'viewRealm'],
        'realm/update'            
            => ['controller' => 'RealmController', 'action' => 'updateRealm'],
        'energy/manage'             
            => ['controller' => 'EnergyController', 'action' => 'managePage'],
        'profile'           
            => ['controller' => 'UserController', 'action' => 'profilePage'],
        'settings'          
            => ['controller' => 'UserController', 'action' => 'settingsPage'],
        // Add more routes as needed
    ];

    public function route($url) {
        // Default page
        $page = $url[0] == '' ? '' : $url[0];
        
        // Check if route exists
        if(array_key_exists($page, $this->routes)) {
            $controller = $this->routes[$page]['controller'];
            $action = $this->routes[$page]['action'];
            
            require_once 'controllers/' . $controller . '.php';
            $controller = new $controller();
            $controller->$action();
        } else {
            // Check for deeper routes
            $deepRoute = $page . '/' . (isset($url[1]) ? $url[1] : '');
            
            if(array_key_exists($deepRoute, $this->routes)) {
                $controller = $this->routes[$deepRoute]['controller'];
                $action = $this->routes[$deepRoute]['action'];
                
                require_once 'controllers/' . $controller . '.php';
                $controller = new $controller();
                $controller->$action();
            } else {
                // Route not found
                header("HTTP/1.0 404 Not Found");
                require_once 'templates/404.php';
            }
        }
    }
}
?>