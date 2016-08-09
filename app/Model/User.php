<?php
class User extends AppModel
{
    public function beforeSave($options = null)
    {
        $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        return true;
    }

    public $validate =array(

        'name' => array(
            //名前の長さをチェックする。
            array(
                'rule' => array('between',1,20),
                'allowEmpty' => false,
                'message'=>'1−20文字以内で入力してください。'
            ),
            //この名前はすでに登録されたかどうかをチェックする。
            array(
                'rule' => 'isUnique',
                'message' => 'この名前はすでに登録されました。'
            )
        ),

        'nation' => array(
            //民族のチェックする。
            array(
                'rule' => array('between',1,20),
                'allowEmpty' => true,
                'message'=>'1−20文字以内で入力してください。'
            )
        ),

        'blood' => array(
            //血液型のチェックする。
            array(
                'rule' => 'notBlank',
                'message' => '血液型を選択してください。'
            )
        ),

        'gender' => array(
            array(
                'rule' => 'notBlank',
                'message' => '性別を選択してください。'
            )
        ),

        'hobby' => array(
            array(
                'rule' => array('between',1,45),
                'allowEmpty' => true,
                'message'=>'1−45文字以内で入力してください。'
            )
        ),



        'password' => array(
            array(
                'rule'=>array('between',1,6),
                'allowEmpty' => false,
                'message'=>'１−6文字以内で入力してください。'
            ),
        ),


        'passconfirm' => array(
            array(
                'rule'=>array('passwordCheck'),
                'message' =>'パスワード確認とパスワードが一致していません。'
            )
        ),


        'birthday' => array(
            array(
                'rule' => array('date','ymd'),
                'message' => '生年月日を選択してください。'
            )
        )
    );



    /**
     * @param $data passconfirm
     * @return bool
     *
     * パスワードとパスワード確認の入力値が相等かどうかをチェックする。
     */
    public function passwordCheck($data)
    {
        return $this->data['User']['password'] == $data['passconfirm'];
    }


//    public $hasMany = array(
//        "Essay" => array(
//            "className" => "Essay",
//            "foreignKey" => "user_id",
//        )
//    );


}
?>
