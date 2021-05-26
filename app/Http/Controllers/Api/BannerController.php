<?php


namespace App\Http\Controllers\Api;


use App\Http\Resources\Api\Banner\BannerCollection;
use App\Logic\BannerLogic;
use Illuminate\Http\Request;

class BannerController extends ApiController
{
    protected $logic;

    public function __construct(Request $request, BannerLogic $logic)
    {
        parent::__construct($request);

        $this->logic = $logic;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $keywords = $this->request->input('keywords', []);
        $page     = $this->request->input('page', 1) ?? 1;
        $limit    = $this->request->input('limit', 15) ?? 15;
        $banner   = $this->logic->getBannerList($page, $limit, ['id', 'name', 'url'], $keywords);

        return BannerCollection::collection($banner);
    }
}