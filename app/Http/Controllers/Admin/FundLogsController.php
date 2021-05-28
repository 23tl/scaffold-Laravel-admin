<?php


namespace App\Http\Controllers\Admin;


use App\Facades\Json\Json;
use App\Http\Resources\Admin\Fund\FundCollection;
use App\Logic\FundLogsLogic;

class FundLogsController extends AdminController
{
    public function index(FundLogsLogic $logic)
    {
        if ($this->request->ajax()) {
            $keywords = Json::decode($this->request->input('searchParams', Json::encode([])));
            $logs = $logic->getFundLogsList(
                $this->request->input('page', 1),
                $this->request->input('limit', 15),
                $keywords,
                [
                    'id',
                    'userId',
                    'currency',
                    'type',
                    'group',
                    'amount',
                    'createdTime',
                    'releaseTime',
                ]
            );

            return $this->success(FundCollection::collection($logs));
        }

        return view('admin.fund.index');
    }
}