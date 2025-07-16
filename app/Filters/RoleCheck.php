<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleCheck implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $role = session()->get('is_admin');

        if (!session()->get('logged_in')) {
            return redirect()->to('/Login');
        }

        if ($arguments && !in_array($role, $arguments)) {
            return redirect()->to('/Login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}

?>