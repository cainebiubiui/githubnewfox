<?php

/**
* 
*/
class controller
{
	private $link;
	
	function __construct()
	{
		$address='localhost';
        $username='root';
        $passcode='caine';
        $database='test';

        $this->link=new mysqli($address,$username,$passcode,$database);
	}

    public function cquery($sql){
        $link = $this->link;

        $res = $link->query($sql);

        return $res;
    }

	 public function add($table,$values){
        $link=$this->link;

        $str='';
        foreach($values as $key=>$value){
            if($value=='now()'){
                $str .= "{$key}={$value},";
            }else{
                $str .= "{$key}='{$value}',";
            }
        }
        $str=rtrim($str,',');
        $sql="insert into $table set $str;";
        $link->query($sql);
        $e_row=$link->affected_rows;

        return $e_row;
    }

    public function get_specific_row($table,$index,$value){
        $link=$this->link;

        $sql="select * from $table where $index=$value;";
        $data=$link->query($sql);

        $arr=array();
        while($total_res=$data->fetch_array()){
            $single_res=array(
            	'status' => $total_res['orderStatus']
            	);
            $arr[count($arr)]=$single_res;
        };

        return $arr;
    }

    public function loginComfirm($name, $inputPasscode){
        $link = $this->link;

        $sql = "select * from fox_adminAccount where name = $name;";

        $res = $link->query($sql);

        // return count($res);
        // if ($res) {
            $info = $res->fetch_array();
            $passcode = $info['passcode'];
            if ($passcode == $inputPasscode) {
                return 1;
            }else{
                return 0;
            }
        // }else{
        //     return -1;
        // }
    }

    public function get_table_data($table){
        $link = $this->link;

        $sql = "select * from $table;";
        $data = $link->query($sql);

        return $data;
    }

    public function updateBalance($newBalance, $code){
        $link = $this->link;

        $sql = "update fox_productInfo set balance = $newBalance where code = $code;";
        $link->query($sql);
        $e_row=$link->affected_rows;

        return $e_row;
    }

}

?>