<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('sendResponse')) {
    function sendResponse($result, $message, $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $result,
            'message' => $message,
        ], $statusCode);
    }
}

if (!function_exists('sendError')) {

    function sendError($error, $errorDetails = [], $statusCode = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $error,
            'errors' => $errorDetails,
        ], $statusCode);
    }
}

function displayRole($roleName){
    return ucwords(str_replace('-', ' ', strtolower($roleName)));
}
function displayPermission($permissionName){
    return strtolower(str_replace('_', ' ', $permissionName));
}

function hasPermission($permissionName, $guardName = 'admin')
{
    return Auth::guard($guardName)->user()->hasAnyPermission($permissionName) ? true : false;
}

function hasAllPermissions($permissionName, $guardName = 'admin')
{
    return Auth::guard($guardName)->user()->hasAllPermissions($permissionName) ? true : false;
}
