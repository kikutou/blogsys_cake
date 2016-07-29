<?php
class User extends AppModel
{

    public $validate =array(

        'name' => array(
            //名前の長さをチェックする。
            array(
                'rule' => array('between',1,30),
                'allowEmpty' => false,
                'message'=>'１−３０文字以内で入力してください。'
            ),
            //この名前はすでに登録されたかどうかをチェックする。
            array(
                'rule' => array('check_name'),
                'message' => 'この名前はすでに登録されました。'
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
            ),
        ),

        'sex' => array(
            array(
                'rule' => 'notBlank',
                'message' => '性別を選択してください。'
            )
        )
    );

    /**
     * @param $data 名前のフィールドの値
     * @return bool　チェックの結果
     *
     * まず入力された名前をDBにあるかどうかをチェックする。
     */
    public function check_name($data)
    {
        $user = $this->find(
            'first',
            array(
                'conditions' => array(
                    'User.name' => $data['name']
                )
            )
        );
//        if($user){
//            return false;
//        }else{
//            return true;
//        }
    }


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

    /**
     * @param $data
     * @return bool
     *
     * ログイン機能
     */
    public function login($data)
    {
        //入力領域が空の場合、ログイン失敗
        if(!$data['User']['name'] || !$data['User']['password']){
            return false;
        }

        $user = $this->find(
            'first',
            array(
                'conditions' => array(
                    'User.name' => $data['User']['name'],
                    'User.password' => $data['User']['password']
                )
            )
        );

        return $user;

    }

}
?>
