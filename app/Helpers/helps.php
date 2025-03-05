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

function displayGuard($guardName){
    if(app()->getLocale() == 'ar'){
        switch ($guardName) {
            case 'admin':
                return 'أدمن';
                break;
            case 'head':
                return 'رئيس قسم';
                break;
            case 'doctor':
                return 'دكتور جامعي';
                break;
            case 'web':
                return 'طالب';
                break;
            default:
                return $guardName;
        }
    }else{
        switch ($guardName) {
            case 'admin':
                return 'Admin';
                break;
            case 'head':
                return 'Head Of Department';
                break;
            case 'doctor':
                return 'Doctor';
                break;
            case 'web':
                return 'Student';
                break;
            default:
                return $guardName;
        }
    }
    return $guardName;
}
function displayRole($roleName){
    $role = ucwords(str_replace('-', ' ', strtolower($roleName)));
    if(app()->getLocale() == 'ar'){
        switch ($role) {
            case 'Admin':
                return 'أدمن';
                break;
            case 'Super Admin':
                return 'سوبر أدمن';
                break;
            case 'Head Of Department':
                return 'رئيس قسم';
                break;
            case 'Doctor':
                return 'دكتور جامعي';
                break;
            case 'Student':
                return 'طالب';
                break;
            default:
                return $role;
        }
    }
    return $role;
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
