<?php


namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\Banner\StorePost;
use App\Http\Requests\Admin\Banner\UpdatePost;
use App\Http\Resources\Admin\Banner\BannerCollection;
use App\Logic\BannerLogic;
use Illuminate\Http\Request;

class BannerController extends AdminController
{
    protected $logic;

    public function __construct(Request $request, BannerLogic $logic)
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
            $banner = $this->logic->getBannerList(
                $this->request->input('page', 1),
                $this->request->input('limit', 15),
                [
                    'id',
                    'name',
                    'url',
                    'type',
                    'createdTime',
                    'image',
                    'urlType'
                ]
            );
            return $this->success(BannerCollection::collection($banner));
        }

        return view('admin.banner.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $banner = $this->logic->getBannerById($id);

        return view('admin.banner.edit', compact('banner'));
    }

    /**
     * @param  StorePost  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePost $request)
    {
        $this->logic->storeBanner(
            $request->input('name'),
            $request->input('url'),
            $request->input('type'),
            $request->input('urlType'),
            $request->input('image'),
            $request->input('sort', 0)
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
        $this->logic->updateBanner(
            $request->input('id'),
            $request->input('name'),
            $request->input('url'),
            $request->input('type'),
            $request->input('urlType'),
            $request->input('image'),
            $request->input('sort', 0)
        );

        return $this->success([]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy()
    {
        $this->logic->destroyBanner($this->request->input('id'));

        return $this->success([]);
    }
}