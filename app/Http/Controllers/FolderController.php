<?php

namespace App\Http\Controllers;

use App\FileObject as Folder;
use Auth;
use Illuminate\Http\Request;

class FolderController extends Controller
{

    protected $user;
    protected $request;
    protected $model;

    public function __construct(Request $request, Folder $model)
    {
        $this->request = $request;
        $this->model = $model;

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $input = $this->request->validate([
            'folder_name' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:100',
            'object_parent' => 'nullable',
        ], [
            'folder_name.regex' => 'The :attribute can only contain letters, numbers and spaces.',
        ]);

        if (isset($input['object_parent'])) {
            $this->user->createFolder($input['folder_name'], ['object_parent' => $input['object_parent']]);
        } else {
            $this->user->createFolder($input['folder_name']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
