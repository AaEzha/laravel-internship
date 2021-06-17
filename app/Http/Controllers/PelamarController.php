<?php

namespace App\Http\Controllers;

use App\Internship;
use App\Skill;
use App\WorkLink;
use Illuminate\Http\Request;
use GroceryCrud\Core\GroceryCrud;

class PelamarController extends Controller
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

    public function lamaranku()
    {
        $title = "Lamaranku";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('internships');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Lamaranku', 'Lamaranku');
        $crud->where(['user_id' => auth()->user()->id]);
        $crud->fieldType('status', 'dropdown_search', [
            '0' => 'Pending',
            '1' => 'Terima',
            '2' => 'Tolak'
        ]);
        $crud->displayAs([
            'job_id' => 'Pekerjaan - Wilayah'
        ]);
        $crud->unsetColumns(['user_id','created_at', 'updated_at']);
        $crud->setRelation('job_id', 'jobs', '{jenis} - {wilayah}');
        $crud->unsetAdd()->unsetEdit();
        $crud->unsetSearchColumns(['job_id', 'status']);
        $crud->callbackAfterUpdate(function ($s) {
            $data = Internship::find($s->primaryKeyValue);
            $data->touch();
            return $s;
        });
        $crud->setActionButton('Detail', 'fa fa-info', function ($row) {
            $i = Internship::find($row->id);
            return route('dashboard.detail_pekerjaan', $i->job->id);
        }, false);
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }

    public function skills()
    {
        $title = "Skills";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('skills');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Skill', 'Skills');
        $crud->where(['user_id' => auth()->user()->id]);
        $crud->columns(['item']);
        $crud->fields(['item']);
        $crud->callbackBeforeInsert(function ($s) {
            $s->data['created_at'] = now();
            $s->data['updated_at'] = now();
            $s->data['user_id'] = auth()->user()->id;
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $data = Skill::find($s->primaryKeyValue);
            $data->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }

    public function links()
    {
        $title = "Links";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('work_links');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Link', 'Links');
        $crud->where(['user_id' => auth()->user()->id]);
        $crud->columns(['item']);
        $crud->fields(['item']);
        $crud->fieldType('item', 'url');
        $crud->callbackBeforeInsert(function ($s) {
            $s->data['created_at'] = now();
            $s->data['updated_at'] = now();
            $s->data['user_id'] = auth()->user()->id;
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $data = WorkLink::find($s->primaryKeyValue);
            $data->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }
}
