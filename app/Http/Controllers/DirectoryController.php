<?php

namespace App\Http\Controllers;

use App\Directory;
use Spatie\MediaLibrary\Models\Media;

class DirectoryController extends Controller
{
    /**
     * Create a new directory
     * @param  Directory|null $directory The parent directory
     * @return Response
     */
    public function create(Directory $directory = null)
    {

        $input = request()->validate([
            'name' => 'required|regex:/^[\w\-\s]+$/|max:50',
            'cd' => 'boolean',
        ]);

        if ($directory) {
            $newDirectory = $directory->subDirectories()->create($input);
        } else {
            $newDirectory = auth()->user()->ownedDirectories()->create($input);
        }

        if (isset($input['cd'])) {
            return response()->json([
                'result' => true,
                'url' => route('directory.browse', $newDirectory),
            ]);
        }

        return response()->json([
            'result' => true,
        ]);
    }

    /**
     * Uploa files in the directory
     * @param  Directory|null $directory The directory to put files to
     * @return Response
     */
    public function put(Directory $directory = null)
    {
        foreach (request()->file('file') as $file) {
            $directory->addMedia($file)->toMediaCollection();
        }

        return response()->json([
            'result' => true,
        ]);
    }

    /**
     * View contents of the directory
     * @param  Directory|null $directory The directory to browse to
     * @return View
     */
    public function viewContents(Directory $directory = null)
    {
        $subDirectories = $directory ? $directory->subDirectories : auth()->user()->ownedDirectories;
        $items = $directory ? $directory->getMedia() : [];

        return view('explorer', [
            'currentDirectory' => $directory,
            'subDirectories' => $subDirectories,
            'items' => $items,
        ]);
    }

    public function downloadSingle(Media $mediaItem)
    {
        return $mediaItem;
    }
}
