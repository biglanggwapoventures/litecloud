<?php

namespace App\Http\Controllers;

use App\FileObject;
use Auth;
use Illuminate\Http\Request;
use Session;
use Storage;

class BrowserController extends Controller
{
    protected $directory;
    protected $request;
    protected $model;
    protected $user;

    public function __construct(Request $request, FileObject $model)
    {
        $this->request = $request;
        $this->model = $model;

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function __invoke($parameters = '')
    {
        $currentPath = trim(preg_replace('/(\/+)/', '/', $parameters), '/');

        $relativePath = trim(sprintf('%s/%s', "{$this->user->email}", $currentPath), '/');

        $files = $this->model->with('subObjects')->wherePath($relativePath)->first();

        return view('files', [
            'files' => $files,
            'path' => $currentPath,
        ]);
    }

    public function createNewFolder($parameters = '')
    {
        $this->request->validate(['name' => 'required|regex:/^[\pL\s\-]+$/u|max:200']);

        $currentPath = trim(preg_replace('/(\/+)/', '/', $parameters), '/');
        $relativePath = trim(sprintf('%s/%s', "{$this->user->email}", $currentPath), '/');
        $fullPath = trim(sprintf('%s/%s', $relativePath, $this->request->name), '/');

        $parent = $this->model->wherePath($relativePath)->first();

        Storage::makeDirectory($fullPath, 0755, true);

        $this->model->create([
            'filename' => $this->request->name,
            'path' => $fullPath,
            'object_type' => 'folder',
            'object_parent' => $parent->id,
        ]);

        return response()->json([
            'result' => true,
        ]);
    }

    public function uploadFiles($parameters = '')
    {
        $currentPath = trim(preg_replace('/(\/+)/', '/', "{$this->user->email}/{$parameters}"), '/');
        $parent = $this->model->wherePath($currentPath)->first();

        $files = [];

        foreach ($this->request->file('file') as $file) {
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $file->storeAs($currentPath, $filename);

            $files[] = [
                'filename' => $filename,
                'path' => "{$currentPath}/{$filename}",
                'object_type' => 'file',
                'object_parent' => $parent->id,
            ];
        }

        $this->user->files()->createMany($files);

        Session::flash('uploadSuccess', sprintf('%d files have been uploaded successfully!', count($files)));

        return response()->json([
            'result' => true,
        ]);
    }
}
