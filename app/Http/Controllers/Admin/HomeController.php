<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    protected $redirectTo = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    public function upload(Request $request)
    {

        $path = $request->headers->get('Path');

        if($request->hasFile('files')){
            $input = $request->file('files')->store($path, 'uploads');
            return response()->json($input);
        }
    }

    public function download(Request $request)
    {

        return Storage::download($request->path);

    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('admin.home');
    }

}
