<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use GroceryCrud\Core\GroceryCrud;

class AdminController extends Controller
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

    private function _show_output($output, $title = '') {
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
            'js_files' => $js_files,
            'title' => $title
        ]);
    }

    public function perusahaan()
    {
        $title = "Perusahaan";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('companies');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Perusahaan', 'Perusahaan');
        $crud->unsetColumns(['detail','address','phone','created_at', 'updated_at']);
        $crud->unsetFields(['created_at', 'updated_at']);
        $crud->requiredFields(['name','email','detail','address','phone','image']);
        $crud->unsetEditFields(['user_id','created_at', 'updated_at']);
        $crud->fieldType('email','email');
        $crud->setRelation('user_id', 'users', '{name} {last_name}', ['role_id' => 3]);
        $crud->setTexteditor(['detail']);
        $crud->setFieldUpload('image', 'storage', '../storage');
        $crud->displayAs([
            'user_id' => 'Pemilik'
        ]);
        $crud->callbackAfterInsert(function ($s) {
            $perusahaan = Company::find($s->insertId);
            $user_id = $perusahaan->user_id;

            // cek lebih dari 1 atau tidak
            $cek = Company::where('user_id', $user_id)->count();
            if($cek > 1) {
                $perusahaan->delete();
            }
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }
}
