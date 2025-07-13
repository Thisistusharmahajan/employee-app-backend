<?php

namespace App\Controllers;
use App\Models\EmployeeModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
class EmployeeController extends ResourceController
{
    protected $modelName = 'App\Models\EmployeeModel';
    protected $format = 'json';
public function index()
{    
    return view('employees/index.php');
} 
public function store()
{
    $model = new \App\Models\EmployeeModel();
    $data  = $this->request->getJSON(true);

    $model->save($data);
    return $this->respondCreated(['status'=>'created','data'=>$data]);
}
public function update($id=0)
{
    $newData = $this->request->getJSON(true);
    if(!$this->model->find($id))
    {
        return $this->failNotFound('Employee Not Found');
    }
    $this->model->update($id,$newData);
    return $this->respondUpdated('Record Updated');
}
public function delete($id=0)
{
    if(!$this->model->find($id))
    {
        return $this->failNotFound("Employee Not Found");
    }
    $this->model->delete($id);
    return $this->respondDeleted('Record Deleted');
}
public function getById($id=0)
{
    $data = $this->model->find($id);
    if(!$this->model->find($id))
    {
        return $this->failNotFound('Employee with id '.$id.' Not found');
    }
    return $this->respond($data);
}
function getAll()
{
    $data = $this->model->find();
    if(!$this->model->find())
    {
        return $this->failNotFound('Employees Not found');
    }
    return $this->respond($data);
}

}
