<?php

namespace App\Http\Controllers;


use App\Http\Requests\UploadBalanceFileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class FileSystemController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('FileSystem/Create')->with([
            'flash.success' => session('success'),
            'flash.error' => session('error')
        ]);
    }

    public function store(UploadBalanceFileRequest $request): bool|RedirectResponse
    {
        try {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $files = Storage::files('public/excel');
            Storage::delete($files);
            Storage::putFileAs('public/excel', $file, $filename);

            return redirect()->back()->with('success','Archivo cargado correctamente');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Ocurrio un error al subir el archivo');
        }
    }
}
