<?php

use App\Models\User;
use App\Models\Wealth;
use App\Models\WealthPersonal;
use App\Models\OperationPassholder;
use App\Models\OperationApp;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail; 

Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail): void {
    $trail->push('User List', route('users.index'));
});

Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail): void {
    $trail->push('Add New User Account', route('users.create'));
});
Breadcrumbs::for('users.show', function (BreadcrumbTrail $trail,): void {
    $trail->push('User List', route('users.show',['user']));
});
Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail): void {
    $trail->push('Edit User', route('users.edit',['user']));
});
Breadcrumbs::for('roles.index', function (BreadcrumbTrail $trail): void {
    $trail->push('User Roles', route('roles.index'));
});
Breadcrumbs::for('roles.create', function (BreadcrumbTrail $trail): void {
    $trail->push('Add New User Role', route('roles.create'));
});
Breadcrumbs::for('roles.show', function (BreadcrumbTrail $trail): void {
    $trail->push('User Roles', route('roles.show',['role']));
});
Breadcrumbs::for('roles.edit', function (BreadcrumbTrail $trail): void {
    $trail->push('Edit Role', route('roles.edit',['role']));
});
Breadcrumbs::for('wealth.index', function (BreadcrumbTrail $trail): void {
    $trail->push('View Applications', route('wealth.index'));
});
Breadcrumbs::for('wealth.dashboard', function (BreadcrumbTrail $trail): void {
    $trail->push('Dashboard', route('wealth.dashboard'));
});
Breadcrumbs::for('wealth.add', function (BreadcrumbTrail $trail): void {
    $trail->push('Add New Application', route('wealth.add'));
});
Breadcrumbs::for('wealth.show', function (BreadcrumbTrail $trail, Wealth $wealth,  $companyName) {  
    $trail->parent('wealth.index');  
    $trail->push( $wealth->id .' - '.$companyName, route('wealth.show',$wealth->id));  
 });
Breadcrumbs::for('wealth.edit', function (BreadcrumbTrail $trail): void {
    $trail->parent('wealth.index');
    $trail->push('Edit Applicaton', route('wealth.edit',['wealth']));
});
Breadcrumbs::for('education.dashboard', function (BreadcrumbTrail $trail): void {
    $trail->push('Dashboard', route('education.dashboard'));
});

Breadcrumbs::for('education.add', function (BreadcrumbTrail $trail): void {
    $trail->push('Add New Application', route('education.add'));
});
Breadcrumbs::for('education.index', function (BreadcrumbTrail $trail): void {
    $trail->push('View Applications', route('education.index'));
});
Breadcrumbs::for('sales', function (BreadcrumbTrail $trail): void {
    $trail->push('View Application', route('sales'));
});
Breadcrumbs::for('sales.dashboard', function (BreadcrumbTrail $trail): void {
    $trail->push('Dashboard', route('sales.dashboard'));
});
Breadcrumbs::for('sales.create', function (BreadcrumbTrail $trail): void {
    $trail->push('Add New Application', route('sales.create'));
});
Breadcrumbs::for('sales.save', function (BreadcrumbTrail $trail): void {
    $trail->push('Add New Application', route('sales.save'));
});
Breadcrumbs::for('sales.show', function (BreadcrumbTrail $trail): void {
    $trail->push('View Applications',  route('sales.show',['id']));
});
Breadcrumbs::for('sales.edit', function (BreadcrumbTrail $trail): void {
    $trail->push('View Applications',  route('sales.edit',['id']));
});
Breadcrumbs::for('operation.dashboard', function (BreadcrumbTrail $trail): void {
    $trail->push('Dashboard', route('operation.dashboard'));
});
Breadcrumbs::for('operation.index', function (BreadcrumbTrail $trail): void {
    $trail->push('View Applications', route('operation.index'));
});
Breadcrumbs::for('operation.create', function (BreadcrumbTrail $trail): void {
    $trail->push('Add New Application', route('operation.create'));
});
Breadcrumbs::for('operation.show', function (BreadcrumbTrail $trail, OperationApp $OperationApp, $PassName ) {  
    $trail->parent('operation.index');
    $trail->push($OperationApp->id .' - '.$PassName,  route('operation.show',$OperationApp->id));   
});
Breadcrumbs::for('operation.edit', function (BreadcrumbTrail $trail, OperationApp $OperationApp, $PassName) {  
    $trail->parent('operation.index');  
    $trail->push($OperationApp->id .' - '.$PassName,  route('operation.edit',$OperationApp->id));  
});
Breadcrumbs::for('finance.newapp', function (BreadcrumbTrail $trail): void {
    $trail->push('Add New Application', route('finance.newapp'));
});

