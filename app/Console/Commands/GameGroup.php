<?php

namespace App\Console\Commands;

use App\Modules\Employ\Models\EmployModel;
use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\UserActiveModel;
use App\Modules\Manage\Model\UserActiveTeamModel;
use App\Modules\Manage\Model\UserGameGroupModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GameGroup extends Command
{
    
    protected $signature = 'Game:group';

    
    protected $description = '游戏分组';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        $single_count = UserActiveModel::wherePid(0)->where('cantain',UserActiveModel::ACTIVE_CANTAIN_ONE)->where('active_type',UserActiveModel::ACTIVE_TYPE_WX)->count();
        $couple_count = UserActiveTeamModel::where('report_status',UserActiveTeamModel::TEAM_REPORT_STATUS_SUCCESS)->where('match_result',UserActiveTeamModel::MATCH_RESULT_NOT_BEGIN)->count();
        $number = max($single_count,$couple_count);

        $sorts = intval(floor($number/4));
        $param = [$sorts,$sorts,$sorts,$sorts];
        $remainder = $number%4;
        if($remainder){
            for($i = 1;$i<=$remainder;$i++){
                $param[$i-1] = $sorts + 1;
            }
        }

        UserGameGroupModel::createOne($param);
    }
}
