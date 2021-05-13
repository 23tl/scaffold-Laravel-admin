<?php


namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\Category\StorePost;
use App\Http\Requests\Admin\Category\UpdatePost;
use App\Http\Resources\Admin\Category\CategoryCollection;
use App\Logic\CategoryLogic;
use App\Models\Category;
use App\Properties\Parameter\Category\Store;
use App\Properties\Parameter\Category\Update;
use Illuminate\Http\Request;

class CategoryController extends AdminController
{
    protected $logic;

    public function __construct(Request $request, CategoryLogic $logic)
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
            $categories = $this->logic->getCategories(
                $this->request->input('type'),
                'recent',
                ['id', 'name', 'parentId', 'image', 'url', 'sort', 'type']
            );

            return $this->success(CategoryCollection::collection($categories));
        }

        return view('admin.category.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = $this->logic->getCategories(
            $this->request->input('type'),
            'recent',
            ['id', 'name']
        );

        return view('admin.category.create', compact('categories'));
    }

    /**
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $categories = $this->logic->getCategories(
            $this->request->input('type'),
            'recent',
            ['id', 'name']
        );

        $category = $this->logic->getCategoryById($id);

        return view('admin.category.edit', compact('category', 'categories'));
    }

    /**
     * @param  StorePost  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePost $request)
    {
        $this->logic->storeCategory(
            new Store(
                $request->input('name'),
                $request->input('type'),
                $request->input('sort', 0),
                $request->input('url'),
                $request->input('image'),
                $request->input('parentId') ?? 0
            )
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
        $this->logic->updateCategory(
            $request->input('id'),
            new Update(
                $request->input('id'),
                $request->input('name'),
                $request->input('type'),
                $request->input('sort', 0),
                $request->input('url'),
                $request->input('image'),
                $request->input('parentId') ?? 0
            )
        );

        return $this->success([]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\Admin\Category\CategoryDeleteException
     */
    public function destroy()
    {
        $this->logic->destroyCategory($this->request->input('id'));

        return $this->success([]);
    }
}