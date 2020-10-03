<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Configuration;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('config_access'), 403);

        $config = Configuration::all();

        return view('admin.config.index', compact('config'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('config_create'), 403);

        return view('admin.config.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'    => 'required|unique:configurations',
            'is_file' => 'required',
        ]);

        if( $request->is_file == Configuration::File ) {
            if($file = $request->hasFile('files')) {
                $file = $request->file('files') ;
                $name = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/images/config/', $name);
                $request->merge(['value' => serialize($name)]);
            }
            Configuration::create($request->all());
        } else {
            Configuration::create($request->all());
        }
        
        return \redirect()->route('admin.configuration.index')->with('success',\trans('notif.notification.save_data.success'));
    }

    public function edit($id)
    {
        abort_unless(\Gate::allows('config_create'), 403);
        $config = Configuration::find($id);

        return view('admin.config.edit',compact('config'));
    }

    public function update(Request $request, $id)
    {
        if( $request->is_file == Configuration::File ) {
            if($file = $request->hasFile('files')) {
                $file = $request->file('files') ;
                $name = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/images/config/', $name);
                $request->merge(['value' => serialize($name)]);
            }
            $conf = Configuration::find($id);
            $conf->update($request->all());
        } else {
            $conf = Configuration::find($id);
            $conf->update($request->all());
        }
        
        return \redirect()->route('admin.configuration.index')->with('success',\trans('notif.notification.update_data.success'));
    }
}
