<?php


namespace App\Logic;

use App\Services\NewsService;

class NewsLogic extends BaseLogic
{
    public function getNews(int $page = 1, int $limit = 15, array $keywords = [], $order = 'recent', array $columns = ['*'])
    {
        return NewsService::getInstance()->getNewsList($page, $limit, $keywords, $order, $columns);
    }
}