<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Cors implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        header('Access-Control-Allow-Origin: http://localhost:8080'); // ✅ Allow your frontend origin
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');

        // Handle preflight (OPTIONS) request
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header('HTTP/1.1 200 OK');
            exit;
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return $response;
    }
}
