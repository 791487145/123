<?php


namespace App\Services;

use App\Contracts\SmsContract;

class SmsService implements SmsContract
{

    public $mobile;

    public $template = [];

    public $templateData = [];

    public $content;

    
    public function send($mobile)
    {
        $sms = \PhpSms::make()->to($mobile)->template($this->template)
            ->data($this->templateData)->content($this->content);

        return $sms->send();
    }

    
    public function sendVoice($code)
    {
        return \PhpSms::voice($code)->to($this->mobile)->send();
    }

    
    public function setMobile($mobile)
    {
        return $this->mobile = $mobile;
    }

    
    public function setTemplate(array $template)
    {
        return $this->template = $template;
    }

    
    public function setTemplateData(array $templateData)
    {
        return $this->templateData = $templateData;
    }

    
    public function setContent($content)
    {
        return $this->content = $content;
    }

    
    public function init(array $template, array $templateData, $content = null)
    {
        $this->setTemplate($template);

        $this->setTemplateData($templateData);

        $this->setContent($content);

        return $this;
    }


}