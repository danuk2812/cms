<?php

$routes = [
    [
        'method' => "GET",
        'path' => "/",
        'className' => \Shop\Controller\Home::class
    ],
    [
        'method' => "GET",
        'path' => "/admin",
        'className' => \Shop\Controller\AdminLogin::class
    ],
    [
        'method' => "POST",
        'path' => "/admin-login",
        'className' => \Shop\Controller\AdminLoginPost::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/dashboard",
        'className' => \Shop\Controller\Admin\Dashboard::class
    ],
    [
        'method' => "GET",
        'path' => "/logout",
        'className' => \Shop\Controller\Logout::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/category/add",
        'className' => \Shop\Controller\Admin\Category\AddAction::class
    ],
    [
        'method' => "POST",
        'path' => "/admin/category/save",
        'className' => \Shop\Controller\Admin\Category\Save::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/category/edit/id/[i:id]",
        'className' => \Shop\Controller\Admin\Category\Edit::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/category/delete/id/[i:id]",
        'className' => \Shop\Controller\Admin\Category\Delete::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/post/add",
        'className' => \Shop\Controller\Admin\Post\AddAction::class
    ],
    [
        'method' => "POST",
        'path' => "/admin/post/save",
        'className' => \Shop\Controller\Admin\Post\Save::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/post/edit/id/[i:id]",
        'className' => \Shop\Controller\Admin\Post\Edit::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/post/delete/id/[i:id]",
        'className' => \Shop\Controller\Admin\Post\Delete::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/admin/add",
        'className' => \Shop\Controller\Admin\Admin\AddAction::class
    ],
    [
        'method' => "POST",
        'path' => "/admin/admin/save",
        'className' => \Shop\Controller\Admin\Admin\Save::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/admin/edit/id/[i:id]",
        'className' => \Shop\Controller\Admin\Admin\Edit::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/admin/delete/id/[i:id]",
        'className' => \Shop\Controller\Admin\Admin\Delete::class
    ],
    [
        'method' => "GET",
        'path' => "/create/account",
        'className' => \Shop\Controller\AdminNew\AddAction::class
    ],
    [
        'method' => "POST",
        'path' => "/admin/create/save",
        'className' => \Shop\Controller\AdminNew\Save::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/page/add",
        'className' => \Shop\Controller\Admin\Page\AddAction::class
    ],
    [
        'method' => "POST",
        'path' => "/admin/page/save",
        'className' => \Shop\Controller\Admin\Page\Save::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/page/edit/id/[i:id]",
        'className' => \Shop\Controller\Admin\Page\Edit::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/page/delete/id/[i:id]",
        'className' => \Shop\Controller\Admin\Page\Delete::class
    ],
    [
        'method' => "GET",
        'path' => "/page/view/id/[i:id]",
        'className' => \Shop\Controller\Admin\Page\View::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/admin",
        'className' => \Shop\Controller\Admin\Admin\Dashboard::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/category",
        'className' => \Shop\Controller\Admin\Category\Dashboard::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/page",
        'className' => \Shop\Controller\Admin\Page\Dashboard::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/post",
        'className' => \Shop\Controller\Admin\Post\Dashboard::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/post/view/id/[i:id]",
        'className' => \Shop\Controller\Admin\Post\View::class
    ],
    [
        'method' => "GET",
        'path' => "/message/new/clear/id/[i:id]",
        'className' => \Shop\Controller\Admin\Message\Clear::class
    ],
];
