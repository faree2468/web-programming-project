<?php
/**
 * @OA\Info(
 *     title="Bill Tracker API",
 *     version="1.0.0",
 *     description="FlightPHP-based REST API for managing users, bills, payments, categories, and payment methods.",
 *     @OA\Contact(
 *         email="faris.kadric@stu.ibu.edu.ba",
 *         name="Bill Tracker"
 *     )
 * )
 *
 * @OA\Server(
 *     url=LOCALSERVER,
 *     description="Local Development Server"
 * )
 *
 * @OA\Server(
 *     url=PRODSERVER,
 *     description="Production Server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="ApiKey",
 *     type="apiKey",
 *     in="header",
 *     name="Authentication"
 * )
 */
