<?php

class Essay extends AppModel
 {
    public $validate =array(

        'title' => array(
            //文章のtitleが入力したかどうかをチェックする。
            array(
                'rule' => array('between',1,20),
                'allowEmpty' => false,
                'message' => '１−20文字以内で入力してください。'
            ),
        ),
        'content' => array(
            array(
                'rule' => 'notBlank',
                'message' => '1-21845文字以内を入力してください。'
            )
        )
    );

//    public $hasMany = array(
//        "Comment" => array(
//            'className' => "Comment",
//            'foreignKey' => 'essay_id',
//        )
//    );




    public $belongsTo = array(
        "User" => array(
            "className" => "User",
            "foreignKey" => "user_id",
        )
    );



}



?>
