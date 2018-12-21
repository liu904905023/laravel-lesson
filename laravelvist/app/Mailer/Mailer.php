<?php
namespace App\Mailer;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/20
 * Time: 10:12
 */
class Mailer {

    protected $url = 'http://api.sendcloud.net/apiv2/mail/sendtemplate';

    public function sendTo($user,$subject,$view,$data=[]) {

        $vars = json_encode(['to' => [$user->email], 'sub' => $data]);
        $param = [
            'apiUser'            => env('SEND_CLOUD_USER'), # 使用api_user和api_key进行验证
            'apiKey'             => env('SEND_CLOUD_KEY'),
            'from'               => config('mail')['from']['address'], # 发信人，用正确邮件地址替代
            'fromName'           => config('mail')['from']['name'],
            'xsmtpapi'           => $vars,
            'subject'            => $subject,
            'templateInvokeName' => $view,
            'respEmailId'        => 'true'
        ];
        $sendData = http_build_query($param);
        $options = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $sendData
            ]];
        $context = stream_context_create($options);

        return file_get_contents($this->url, FILE_TEXT, $context);
    }
}