<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/20
 * Time: 10:15
 */

namespace App\Mailer;


class UserMailer extends Mailer {

    public function welcome($user) {
        $subject = 'welcome';
        $view = 'welcome';
        $data = ['%name%' => [$user->name],'%token%' => [str_random(40)]];
        $aaa = $this->sendTo($user, $subject, $view, $data);
        dd($aaa);
        
    }
}