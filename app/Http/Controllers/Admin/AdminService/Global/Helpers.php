<?php
/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * This file is managed by Admiko and is not recommended to be modified.
 * Any custom code should be added elsewhere to avoid losing changes during updates.
 * However, in case your code is overwritten, you can always restore it from a backup folder.
 */

if (!function_exists('getBackButtonParameters')) {
    /**
     * Generate the route parameters for a "back" button by excluding the last parameter.
     *
     * @param string $routeName The name of the route.
     * @return array
     */
    function getRouteParameters($routeName) {
        // Get the current route parameters
        $parameters = request()->route()->parameters();

        // Get the route object using the route name
        $route = Route::getRoutes()->getByName($routeName);

        if (!$route) {
            return [];
        }

        // Get the parameter names for the route
        $parameterNames = $route->parameterNames();

        // Prepare the parameters, excluding the last one
        $parametersForUrl = [];
        foreach ($parameterNames as $parameterName) {
            // Check if the parameter exists in the current parameters
            if (isset($parameters[$parameterName])) {
                // Add it to the parameters array for the URL
                $parametersForUrl[$parameterName] = $parameters[$parameterName];
            }
        }

        return $parametersForUrl;
    }
}
