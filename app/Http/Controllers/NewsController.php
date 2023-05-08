<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsStoreRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::query()
            ->where('status', '=', 1)
            ->with('user')
            ->paginate(5);

        return view('news.index', ['news' => $news]);
    }

    public function admin_news()
    {

        $news = News::query()
            ->with('user')
            ->paginate(10);

        return view('admin.news.index', ['news' => $news]);
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(NewsStoreRequest $request)
    {
        $news = new News;
        $news->title = $request->title;
        $news->text = $request->text;
        $news->user_id = request()->user()->id;

        $news->save();
        session(['alert' => __('Новость успешно создана!'), 'a_status' => 'success']);

        return redirect()->route('admin.index');
    }

    public function edit(string $id)
    {
        $news = News::query()->find($id);
        if (!$news) {
            session(['alert' => __('Новость не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.news');
        }
        return view('admin.news.edit', ['news' => $news]);
    }

    public function update(NewsUpdateRequest $request, string $id)
    {
        $news = News::query()->find($id);
        if (!$news) {
            session(['alert' => __('Новость не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.news');
        }
        $news->update([
            'title' => $request->title,
            'text' => $request->text,
            'status' => $request->status,
        ]);
        session(['alert' => __('Новость успешно изменена!'), 'a_status' => 'success']);

        return redirect()->route('admin.news');
    }

    public function destroy(string $id)
    {
        $news = News::query()->find($id);

        if(!$news){
            session(['alert' => __('Новость не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.news');
        }

        $news->delete();

        session(['alert' => __('Новость успешно удалена!'), 'a_status' => 'success']);

        return redirect()->route('admin.news');
    }
}
