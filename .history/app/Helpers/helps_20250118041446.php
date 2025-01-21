<?php

use Illuminate\Support\Facades\Auth;

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
