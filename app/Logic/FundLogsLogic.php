<?php


namespace App\Logic;


use App\Services\FundLogsServices;

class FundLogsLogic extends BaseLogic
{
    public function getFundLogsList(int $page = 1, int $limit = 15, array $keywords = [], array $columns = ['*'])
    {
        return FundLogsServices::getInstance()->getFundLogsList($page, $limit, $keywords, $columns);
    }
}
