<?php
namespace App\Controllers;
use App\Models\EmployeeModel;

class Auth extends BaseController
{
    public function register()
    {
        $employeeModel = new EmployeeModel();
        $data = [
            'name'=> $this->request->getPost('name'),
            'email'=> $this->request->getPost('email'),
            'phone'=> $this->request->getPost('phone'),
            'role'=> $this->request->getPost('role'),
            'current_tech_stack'=> $this->request->getPost('stack'),
            'password'=> password_hash($this->request->getPost('password'),PASSWORD_DEFAULT)
        ];
        $employeeModel->save($data);
        return redirect()->to('/Login');
    }
    public function loginPost()
    {
        $employeeModel = new EmployeeModel();
        $email = $this->request->getPost('email');        
        $password = $this->request->getPost('password');        
        $employee = $employeeModel->where('email',$email)->first();

        if ($employee && password_verify($password, $employee['password'])) {
            session()->set([
                'id' => $employee['id'],
                'name' => $employee['name'],
                'email' => $employee['email'],
                'is_admin' => $employee['is_admin'],
                'logged_in' => true
            ]);
            return redirect()->back()->to($employee['is_admin'] ? '/adminDashbaord':'/employeeDashboard');
        }
        return redirect()->back()->with('error','Invalid  Credentials');
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/Login');
    }
}
?>