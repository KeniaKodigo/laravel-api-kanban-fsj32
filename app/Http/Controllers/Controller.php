<?php

namespace App\Http\Controllers;
use OpenApi\Attributes as OA;

#[OA\Info(
    title: "Laravel V13 Kanban Task Management API - Bootcamp FSJ32",
    version: "1.0.0",
    description: "API documentation for the Kanban task management system. Laravel 13."
)]
#[OA\Server(
    url: "/api/v1",
    description: "API V1 Base URL"
)]
#[OA\SecurityScheme(
    securityScheme: "bearerAuth",
    type: "http",
    scheme: "bearer",
    bearerFormat: "JWT",
    description: "Enter the Bearer token (JWT) returned at login.",
    name: "Authorization",
    in: "header"
)]
abstract class Controller
{
    //
}
