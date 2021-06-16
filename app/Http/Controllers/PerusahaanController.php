<?php

namespace App\Http\Controllers;

use App\Company;
use App\Internship;
use App\Job;
use Illuminate\Http\Request;
use GroceryCrud\Core\GroceryCrud;
use Illuminate\Support\Facades\Auth;

class PerusahaanController extends Controller
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

    public function pekerjaan()
    {
        $title = "Lowongan Pekerjaan";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('jobs');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Lowongan Pekerjaan', 'Lowongan Pekerjaan');
        $crud->unsetColumns(['company_id','created_at', 'updated_at']);
        $crud->unsetFields(['company_id','created_at', 'updated_at']);
        $crud->requiredFields(['jenis','wilayah','spesialisasi','closed_at','gaji','gaji_satuan','detail','image']);
        $crud->setTexteditor(['detail']);
        $crud->setFieldUpload('image', 'storage', '../storage');
        $crud->where(['company_id' => auth()->user()->company->id]);
        $crud->callbackBeforeInsert(function ($s) {
            $s->data['company_id'] = auth()->user()->company->id;
            $s->data['created_at'] = now();
            $s->data['updated_at'] = now();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $data = Job::find($s->primaryKeyValue);
            $data->touch();
            return $s;
        });
        $crud->setActionButton('Pelamar', 'fa fa-users', function ($row) {
            return route('perusahaan.pelamar', $row->id);
        }, false);
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }

    public function profil()
    {
        $title = "Edit Profil Perusahaan";
        $data = Company::firstWhere('user_id', Auth::id());

        return view('perusahaan.profil', compact('data','title'));
    }

    public function profil_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'detail' => 'required',
        ]);

        Company::updateOrInsert(
            ['user_id' => Auth::id()],
            ['name' => $request->name, 'email' => $request->email, 'address' => $request->address, 'phone' => $request->phone, 'detail' => $request->detail, ]
        );

        return redirect()->route('perusahaan.profil')->with('success', 'Profile berhasil diupdate');
    }

    public function pelamar(Job $job)
    {
        $title = "Daftar Pelamar";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('internships');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Daftar Pelamar', 'Daftar Pelamar');
        $crud->unsetColumns(['created_at', 'updated_at']);
        $crud->where(['job_id' => $job->id]);
        $crud->unsetAdd();
        $crud->setRelation('user_id', 'users', '{name} {last_name}', ['role_id' => 2])
             ->setRelation('job_id', 'jobs', '{jenis} - {wilayah}')
            ;
        $crud->fieldType('status', 'dropdown_search', [
            '0' => 'Pending',
            '1' => 'Terima',
            '2' => 'Tolak'
        ]);
        $crud->unsetFields(['created_at', 'updated_at']);
        $crud->requiredFields(['user_id','job_id','status']);
        $crud->displayAs([
            'user_id' => 'Nama Pelamar',
            'job_id' => 'Pekerjaan - Wilayah'
        ]);
        // $crud->setTexteditor(['detail']);
        // $crud->setFieldUpload('image', 'storage', '../storage');
        // $crud->where(['company_id' => auth()->user()->company->id]);
        // $crud->callbackBeforeInsert(function ($s) {
        //     $s->data['company_id'] = auth()->user()->company->id;
        //     $s->data['created_at'] = now();
        //     $s->data['updated_at'] = now();
        //     return $s;
        // });
        $crud->callbackAfterUpdate(function ($s) {
            $data = Internship::find($s->primaryKeyValue);
            $data->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }
}
