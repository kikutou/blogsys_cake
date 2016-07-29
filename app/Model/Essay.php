<?php

class Essay extends AppModel
 {
    public $validate =array(

        'title' => array(
            //文章のtitleが入力したかどうかをチェックする。
            array(
                'rule' => array('between',1,20),
                'allowEmpty' => false,
                'message'=>'１−20文字以内で入力してください。'
            ),
        ),
    );


}



?>
