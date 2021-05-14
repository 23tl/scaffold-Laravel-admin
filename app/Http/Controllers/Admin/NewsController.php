<?php


namespace App\Http\Controllers\Admin;


use App\Facades\Json\Json;
use App\Http\Resources\Admin\News\NewsCollection;
use App\Logic\CategoryLogic;
use App\Logic\NewsLogic;
use App\Models\Category;
use Illuminate\Http\Request;

class NewsController extends AdminController
{
    protected $logic;

    public function __construct(Request $request, NewsLogic $logic)
    {
        parent::__construct($request);
        $this->logic = $logic;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if ($this->request->ajax()) {
            $keywords = Json::decode($this->request->input('searchParams', Json::encode([])));
            $news     = $this->logic->getNews(
                $this->request->input('page', 1),
                $this->request->input('limit', 15),
                $keywords,
                'recent',
                ['id', 'description', 'cover', 'createdTime', 'categoryId']
            );

            return $this->success(NewsCollection::collection($news));
        }

        return view('admin.news.index');
    }

    public function create(CategoryLogic $logic)
    {
        $categories = $logic->getCategories(Category::TYPE_NEWS, '', ['id', 'parentId', 'name']);

        return view('admin.news.create', compact('categories'));
    }

    public function edit(int $id)
    {
        return view('admin.news.edit');
    }

    public function store()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}