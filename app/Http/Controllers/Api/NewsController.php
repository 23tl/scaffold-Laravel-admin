<?php


namespace App\Http\Controllers\Api;


use App\Http\Resources\Api\News\NewsCollection;
use App\Logic\NewsLogic;
use Illuminate\Http\Request;

class NewsController extends ApiController
{
    protected $logic;

    public function __construct(Request $request, NewsLogic $logic)
    {
        parent::__construct($request);

        $this->logic = $logic;
    }

    public function index()
    {
        $page = $this->request->input('page', 1);
        $limit = $this->request->input('limit', 15);
        $keywords = $this->request->input('keywords', []);

        $news = $this->logic->getNews($page, $limit, $keywords, '', [
            'id', 'name', 'description', 'cover', 'createdTime', 'categoryId'
        ]);

        return [
            'news' => NewsCollection::collection($news),
        ];
    }

    public function show()
    {

    }
}