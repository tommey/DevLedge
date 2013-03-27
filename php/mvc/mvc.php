<?php

/**
 * Model–view–controller (MVC) is a software architecture pattern which 
 * separates the representation of information from the user's interaction 
 * with it. 
 * 
 * @see http://en.wikipedia.org/wiki/Model–view–controller
 *
 * The concept:
 * - The client request is routed to a Controller's action.
 * - The Controller modifies the Model and/or gets data from it for the View.
 * - The Model modifies and queries resources with business logic.
 * - The View gets data to be displayed for the client, it generates response.
 * 
 * This file routes the request to the Controller's appropriate action.
 * 
 * Comments:
 * - You should always have a class loader, which knows where to search
 *   for your custom classes by name or namespace, but this part does
 *   not deal with this feature, just assumes it exists and works.
 */

// Try to process the request.
try {
    // Get request parameters to route.
    $controllerName = empty($_GET['controller']) ? 'index' : $_GET['controller'];
	$action         = empty($_GET['action']) ? 'index' : $_GET['action'];
    // Check if the params are invalid formally.
	if (!preg_match('/^[a-z]$/i', $controllerName) 
        || !preg_match('/^[a-z]$/i', $action)
    ) {
        throw new Exception('Bad request');
    }
    // The "routing" parameters seem valid, let's try to use them.
    // We have CamelCaseController classes.
	$controllerClass = ucfirst($controllerName) . 'Controller';
    // Check if it exists.
	if (!class_exists($controllerClass)) {
		throw new Exception('Controller not found with name: ' 
            . $controllerClass);
	}
    // Create the controller object.
	$controller = new $controllerClass();
    // Define the action's real method name.
	$methodName = 'do' . ucfirst($action);
    // Check for it.
	if (!method_exists($controller, $methodName)) {
		throw new Exception('Action not found with name: ' . $methodName 
            . ' in controller with name: ' . $controllerClass);
	}
    // Call the action on the controller - it takes care from everything.
	$controller->{$methodName}();
}
catch (Exception $e) {
    // Yes, this could be a nice error page. :)
	echo 'Error: ' . $e->getMessage();
}
