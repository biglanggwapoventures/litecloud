<?php

namespace App\Http\Controllers;

use App\FileObject;
use App\FileObject as Folder;
use Auth;
use Illuminate\Http\Request;

class _DirectoryController extends Controller
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

    public function __invoke(FileObject $folder = null)
    {
        $folders = $folder->subFolders ?? $this->user->rootFolders;
        // dd($folders->toArray());

        return view('my-files', [
            'folders' => $folders,
            'currentFolder' => $folder,
            'path' => '',
        ]);
    }

    public function uploadFiles(FileObject $folder = null)
    {
        foreach ($this->request->file('file') as $file) {
            $folder->addMedia($file)->toMediaCollection();
        }
    }
}
