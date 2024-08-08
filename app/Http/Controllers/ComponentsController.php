<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ComponentsController extends Controller
{
    public function index()
    {
        $componentFiles = File::files(resource_path('views/components'));
        $components = [];

        foreach ($componentFiles as $file) {
            $name = $file->getFilenameWithoutExtension();
            $components[$name] = File::get($file->getPathname());
        }

        return view('components.components-showcase', compact('components'));
    }
}