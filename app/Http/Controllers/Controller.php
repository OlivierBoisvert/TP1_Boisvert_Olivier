<?php

namespace App\Http\Controllers;
use OpenApi\Attributes as OA;

define("SERVER_ERROR", 500);
define("NOT_FOUND", 404);
define("CREATED", 201);
define("NO_CONTENT", 204);
define("OK", 200);
define("INVALID_DATA", 422);

define("PAGINATE_NUMBER", 20);

#[OA\Info(title: "API TP1_Boisvert_Olivier", version: "1.0")]


abstract class Controller
{
    //
}
