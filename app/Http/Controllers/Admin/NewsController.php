<?php


namespace App\Http\Controllers\Admin;


use App\Facades\Json\Json;
use App\Http\Requests\Admin\News\StorePost;
use App\Http\Requests\Admin\News\UpdatePost;
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
                ['id', 'name', 'description', 'cover', 'createdTime', 'categoryId']
            );

            return $this->success(NewsCollection::collection($news));
        }

        return view('admin.news.index');
    }

    /**
     * @param  CategoryLogic  $logic
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(CategoryLogic $logic)
    {
        $categories = $logic->getCategories(Category::TYPE_NEWS, '', ['id', 'parentId', 'name']);

        return view('admin.news.create', compact('categories'));
    }

    /**
     * @param  int  $id
     * @param  CategoryLogic  $logic
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id, CategoryLogic $logic)
    {
        $categories = $logic->getCategories(Category::TYPE_NEWS, '', ['id', 'parentId', 'name']);
        $news       = $this->logic->getNewsById($id);

        return view('admin.news.edit', compact('categories', 'news'));
    }

    /**
     * @param  StorePost  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePost $request)
    {
        $this->logic->storeNews(
            $request->input('categoryId'),
            $request->input('name'),
            $request->input('content'),
            $request->input('description'),
            $request->input('image')
        );

        return $this->success([]);
    }

    /**
     * @param  UpdatePost  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePost $request)
    {
        $this->logic->updateNews(
            $request->input('id'),
            $request->input('categoryId'),
            $request->input('name'),
            $request->input('content'),
            $request->input('description'),
            $request->input('image')
        );

        return $this->success([]);
    }

    /**
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy()
    {
        $this->logic->destroyNews($this->request->input('id'));

        return $this->success([]);
    }
}