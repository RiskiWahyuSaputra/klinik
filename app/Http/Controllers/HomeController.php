<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->take(6)->get();
        $doctors = Doctor::with('user')->where('is_available', true)->take(4)->get();
        $articles = Article::published()->latest('published_at')->take(3)->get();
        return view('public.homepage', compact('services', 'doctors', 'articles'));
    }

    public function services()
    {
        $services = Service::where('is_active', true)->paginate(9);
        return view('public.services', compact('services'));
    }

    public function doctors()
    {
        $doctors = Doctor::with('user', 'services', 'schedules')
            ->where('is_available', true)
            ->paginate(6);
        return view('public.doctors', compact('doctors'));
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function articles()
    {
        $articles = Article::published()->latest('published_at')->paginate(9);
        return view('public.articles', compact('articles'));
    }

    public function articleDetail(Article $article)
    {
        if (!$article->is_published) {
            abort(404);
        }
        $article->load('author');
        return view('public.article-detail', compact('article'));
    }
}
