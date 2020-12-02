<?php

namespace Modules\Member\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use GroceryCrud\Core\GroceryCrud;

class MemberController extends Controller
{
    private function _getDatabaseConnection() {
        $databaseConnection = config('database.default');
        $databaseConfig = config('database.connections.' . $databaseConnection);


        return [
            'adapter' => [
                'driver' => 'Pdo_Mysql',
                'database' => $databaseConfig['database'],
                'username' => $databaseConfig['username'],
                'password' => $databaseConfig['password'],
                'charset' => 'utf8'
            ]
        ];
    }

    private function _getGroceryCrudEnterprise() {
        $database = $this->_getDatabaseConnection();
        $config = config('grocerycrud');

        $crud = new GroceryCrud($config, $database);

        return $crud;
    }

    private function _show_output($output) {
        if ($output->isJSONResponse) {
            return response($output->output, 200)
                  ->header('Content-Type', 'application/json')
                  ->header('charset', 'utf-8');
        }

        $css_files = $output->css_files;
        $js_files = $output->js_files;
        $output = $output->output;

        return view('grocery', [
            'output' => $output,
            'css_files' => $css_files,
            'js_files' => $js_files
        ]);
    }

    public function index()
    {
        $crud = $this->_getGroceryCrudEnterprise();

        $crud->setTable('users');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('User', 'Users');
        $crud->columns(['name', 'last_name', 'role_id', 'email', 'updated_at']);
        $crud->addFields(['name', 'last_name', 'role_id', 'email', 'password']);
        $crud->editFields(['name', 'last_name', 'role_id', 'email']);
        $crud->setRelation('role_id', 'roles', 'name');
        $crud->displayAs([
            'role_id' => 'Role'
        ]);

        $output = $crud->render();

        return $this->_show_output($output);
    }
}
