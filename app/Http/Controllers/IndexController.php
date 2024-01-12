<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Category_multiple;
use App\Models\Chapter;
use App\Models\Comic;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
        $category = Category::orderBy('id', 'DESC')->get();

        $comicHot = Comic::orderBy('view', 'DESC')->limit('16')->get();
        $comicLastest = Comic::with('categories')->orderBy('created_at', 'DESC')->limit('10')->get();

        $comicBest = Comic::limit('16')->get();

        $book = Book::limit('16')->get();

        return view('pages.home', compact('category', 'comicHot', 'comicLastest', 'comicBest', 'book'));
    }

    public function view_comic($slug)
    {
        $comic = Comic::with('categories')->where('slug', $slug)->first();
        $chapter = Chapter::orderBy('id', 'ASC')->where('comic_id', $comic->id)->get();

        $category = Category::orderBy('id', 'DESC')->get();

        // lấy truyện khác
        $comicCate = Comic::inRandomOrder()->limit(6)->get();

        $comicNew = Comic::with('categories')->orderBy('created_at', 'DESC')->limit(10)->get();
        $comicHot = Comic::with('categories')->orderBy('view', 'DESC')->limit(10)->get();
        $comicRandom = Comic::with('categories')->inRandomOrder()->limit(10)->get();

        return view('pages.comic', compact('comic', 'chapter', 'category', 'comicCate', 'comicNew', 'comicHot', 'comicRandom'));
    }

    public function category($slug)
    {
        $category = Category::orderBy('id', 'DESC')->get();

        $categoryDetail = Category::where('slug', $slug)->first();

        $comicId = Category_multiple::where('category_id', $categoryDetail->id)->get();
        $comicIdArr = [];
        foreach ($comicId as $key => $id) {
            $comicIdArr[] = $id->id;
        }

        if (!empty($comicIdArr)) {
            $comicCate = Comic::orderBy('comic.created_at', 'DESC')
                ->join('category_multiple', 'category_multiple.comic_id', '=', 'comic.id')
                ->whereIn('category_multiple.id', $comicIdArr)
                ->get();
        } else {
            $comicCate = null;
        }

        return view('pages.category', compact('category', 'categoryDetail', 'comicCate'));
    }

    public function read_comic($slug)
    {
        $category = Category::orderBy('id', 'DESC')->get();

        $chapter = Chapter::with('comic')->where('slug', $slug)->first();

        $allChapter = Chapter::orderBy('id', 'ASC')->where('comic_id', $chapter->comic->id)->get();

        // chuong tiep
        $next_chapter = Chapter::orderBy('id', 'ASC')->where('id', '>', $chapter->id)->first();
        $pre_chapter = Chapter::orderBy('id', 'DESC')->where('id', '<', $chapter->id)->first();
        $max_id = Chapter::orderBy('id', 'DESC')->where('comic_id', $chapter->comic->id)->first();
        $min_id = Chapter::orderBy('id', 'ASC')->where('comic_id', $chapter->comic->id)->first();

        // lấy truyện mới
        $comicLatest = Comic::orderBy('created_at', 'DESC')->limit(16)->get();

        return view('pages.chapter', compact('category', 'chapter', 'allChapter', 'next_chapter', 'pre_chapter', 'max_id', 'min_id', 'comicLatest'));
    }

    public function search(Request $request)
    {
        $category = Category::orderBy('id', 'DESC')->get();

        $keyword = $request->keyword;

        $result = Comic::orderBy('id', 'DESC')
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->orwhere('author', 'LIKE', '%' . $keyword . '%')
            ->orwhere('description', 'LIKE', '%' . $keyword . '%')
            ->get();

        return view('pages.search', compact('result', 'category', 'keyword'));
    }

    public function search_ajax(Request $request)
    {
        $data = $request->all();

        if ($data['keywords']) {

            $comic = Comic::where('status', 1)->where('title', 'LIKE', '%' . $data['keywords'] . '%')->get();

            $output = '<ul class="dropdown-menu" style="display: block; width: 200px">';

            foreach ($comic as $key => $value) {
                $output .= '<li class="li_search_ajax" style="padding:4px 15px"><a href="#" style="text-decoration:none; color:#000">' . $value->title . '</a></li>';
            }

            $output .= '</ul>';

            echo $output;
        }
    }

    public function tag($tag)
    {
        $title = 'Tìm kiếm tag';

        // SEO
        // $meta_desc = 'Tìm kiếm tags';
        // $meta_keywords = "Tìm kiếm tags";
        // $url_canonical = \URL::current();

        // end seo

        $category = Category::orderBy('id', 'DESC')->get();

        $tags = explode('-', $tag);
        $result = Comic::where(function ($query) use ($tags) {
            for ($i = 0; $i < count($tags); $i++) {
                $query->orWhere('seo', 'like', '%' . $tags[$i] . '%');
            }
        })->paginate(12);

        return view('pages.tag', compact('result', 'tag', 'title', 'category'));
    }

    public function view_book()
    {
        $category = Category::orderBy('id', 'DESC')->get();
        $list = Book::orderBy('id', 'DESC')->get();
        return view('pages.book', compact('list', 'category'));
    }

    public function fast_view(Request $request)
    {
        $book_id = $request->book_id;
        $book = Book::find($book_id);

        $output['book_title'] = $book->title;
        $output['book_content'] = $book->content;

        echo json_encode($output);
    }
}
