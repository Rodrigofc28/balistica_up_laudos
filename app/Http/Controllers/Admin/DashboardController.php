<?php

/*
 * Developed by Milena Mognon
 */

namespace app\Http\Controllers\Admin;
use App\Models\MongoDb\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /*
        $post = new Post();
        $post->title = 'Rodrigo de Freitas';
        $post->content = 'Testando a conexão mongodb';
        $post->save(); // Salva no MongoDB
        */
        return view('dashboard');
    }
}
