<?php

namespace App\Modules\Task\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class TaskPaySectionModel extends Model
{
    protected $table = 'task_pay_section';
    public  $timestamps = false;  
    public $fillable = ['id','task_id','uid','name','price','status','work_id','verify_status','created_at','updated_at','case_status','desc','percent','sort','pay_at'];

    
    static function getPaySectionHtml($data,$price)
    {
        $html = '<table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">交付阶段</th>
                            <th class="center">付款比例</th>
                            <th class="center">付款金额</th>
                            <th class="center">备注</th>
                        </tr>
                        </thead>
                        <tbody>';
        if(is_array($data)) {
            foreach ($data as $k => $v) {
                $html .= '<tr>';
                $html .= '<td class="center">';
                $html .= '第' . ($k + 1) . '阶段';
                $html .= '<input class="form-control" type="hidden" name="sort[]" value="' . ($k + 1) . '"/>';
                $html .= '</td>';
                $html .= '<td class="center">';
                $html .= $v . '%';
                $html .= '<input class="form-control" type="hidden" name="percent[]" value="' . $v . '"/>';
                $html .= '</td>';
                $html .= '<td class="center">';
                $html .= $price * $v / 100;
                $html .= '<input class="form-control" type="hidden" name="price[]" value="' . ($price * $v / 100) . '"/>';
                $html .= '</td>';
                $html .= '<td class="center">';
                $html .= '<input class="form-control" type="text" name="desc[]" value=""/>';
                $html .= '</td>';
                $html .= '</tr>';

            }
        }
        $html .= '</tbody></table>';
        return $html;
    }
}
