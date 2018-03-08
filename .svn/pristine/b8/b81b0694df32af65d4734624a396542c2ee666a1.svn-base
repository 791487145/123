jQuery(function($) {

    //根据广告位不同限制广告图片大小
    var target_position = $('.target_id option:selected').attr('data-values');
    var html = getAdPicHtml(target_position);
    if(html){
        $('.ad_type').siblings('label').html(html);
    }
    $('.target_id').change(function(){
        var target_id = $(this).val();
        var target_position = $('.target_id option:selected').attr('data-values');
        var html = getAdPicHtml(target_position);
        if(html){
            $('.ad_type').siblings('label').html(html);
        }

    });

    function getAdPicHtml(target_position){
        switch(target_position){
            case 'HOME_TOP_SLIDE':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于首页banner图，图片尺寸建议大小为1200px*435px</span>';
                break;
            case 'HOME_BOTTOM':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于首页底部广告位，图片尺寸建议大小为1200px*100px</span>';
                break;
            case 'TASKLIST_BOTTOM':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于任务大厅底部广告位，图片尺寸建议大小为1200px*100px</span>';
                break;
            case 'TASKLIST_RIGHT_TOP':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于任务大厅右上方广告位，图片尺寸建议大小为245px*260px</span>';
                break;
            case 'TASKINFO_RIGHT':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于任务详情右上方广告位，图片尺寸建议大小为245px*260px</span>';
                break;
            case 'LOGIN_LEFT':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于注册登录左侧广告，图片尺寸建议大小为615px*420px</span>';
                break;
            case 'SELLERLIST_BOTTOM':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于服务商底部广告位，图片尺寸建议大小为1200px*100px</span>';
                break;
            case 'SELLERLIST_RIGHT_TOP':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于服务商_右上方广告，图片尺寸建议大小为245px*260px</span>';
                break;
            case 'CASELIST_BOTTOM':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于成功案例底部广告位，图片尺寸建议大小为1200px*100px</span>';
                break;
            case 'CASEINFO_BOTTOM':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于成功案例详情底部广告，图片尺寸建议大小为1200px*100px</span>';
                break;
            case 'CASEINFO_RIGHT_TOP':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于成功案例详情_右上方广告，图片尺寸建议大小为245px*260px</span>';
                break;
            case 'NEWSLIST_RIGHT_TOP':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于资讯中心右上方广告位，图片尺寸建议大小为245px*260px</span>';
                break;
            case 'NEWSLIST_TOP':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于资讯中心顶部广告位，图片尺寸建议大小为900px*80px</span>';
                break;
            case 'TASKDELIVERY_RIGHT_BUTTOM':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于任务竞标投稿_右下方广告，图片尺寸建议大小为285px*400px</span>';
                break;
            case 'NEWSINFO_RIGHT_TOP':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于资讯中心详情右上方广告位，图片尺寸建议大小为245px*260px</span>';
                break;
            case 'NEWSINFO_TOP':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于资讯中心详情顶部广告位，图片尺寸建议大小为1200px*100px</span>';
                break;
			case 'QUESTIONLIST_TOP':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于问答中心顶部广告位，图片尺寸建议大小为1200px*300px</span>';
                break;
			case 'ANSWERLIST_RIGHT_TOP':
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '位于回答列表右上方广告位，图片尺寸建议大小为245px*260px</span>';
                break;
            default:
                var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
                    '请注意上传图片尺寸大小</span>';
        }
        return html;
    }

   });
