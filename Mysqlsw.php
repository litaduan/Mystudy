<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mysqlsw extends CI_Controller {
    
    function __construct() {
        parent::__construct();       
    }
	public function mysqlsw(){
		$dbhost = '';  // mysql服务器主机地址
		$dbuser = '';            // mysql用户名
		$dbpass = '';          // mysql用户名密码
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
		if(! $conn )
		{
		    die('连接失败: ' . mysqli_error($conn));
		}
		// 设置编码，防止中文乱码
		mysqli_query($conn, "set names utf8");
		mysqli_select_db( $conn, 'RUNOOB' );
		mysqli_query($conn, "SET AUTOCOMMIT=0"); // 设置为不自动提交，因为MYSQL默认立即执行
		mysqli_begin_transaction($conn);            // 开始事务定义
		 
		if(!mysqli_query($conn, "insert into dlt_user_t(name,bmid) values('胡7',1);"))
		{
		    mysqli_query($conn, "ROLLBACK");     // 判断当执行失败时回滚
		}
		 
		if(!mysqli_query($conn, "insert into dlt_user_t(name,bmid) values('胡8',2);"))
		{
		    mysqli_query($conn, "ROLLBACK");      // 判断执行失败时回滚
		}
		mysqli_commit($conn);            //执行事务
		mysqli_close($conn);
	}
	/*
		生成唯一订单
	 */
	private function build_order_no(){
		return date('ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
	}
	public function qg(){

		$dbhost = '192.168.1.109';  // mysql服务器主机地址
		$dbuser = 'management_lhtz';            // mysql用户名
		$dbpass = 's1hg3kA!(';          // mysql用户名密码
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
		if(! $conn )
		{
		    die('连接失败: ' . mysqli_error($conn));
		}
		// 设置编码，防止中文乱码
		mysqli_query($conn, "set names utf8");
		mysqli_select_db( $conn, 'management_lhtz' );
		mysqli_query($conn, "SET AUTOCOMMIT=0"); // 设置为不自动提交
		mysqli_begin_transaction($conn);            // 开始事务定义
		$selsql = "select * from dlt_test where type=1 FOR UPDATE";
		$rs = mysqli_query($conn, $selsql);var_dump(mysqli_num_fields($rs));die;
		$rowre = mysqli_fetch_assoc($rs);
		if($rowre['number'] > 0){
			$upsql = "update dlt_test set `number` = `number` - 1 where type='1' ";
			$rs = mysqli_query($conn, $upsql);
			if(mysqli_affected_rows($conn)){
				mysqli_commit($conn);
				echo "减少成功";
			}else{
				echo "减少失败001";
			}
		}else{
			mysqli_query($conn, "ROLLBACK");
			echo "库存不足";
		}
	}
	public function redis_t(){
		$redis = new redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->auth("123321");
        $redis->set('redistest','666666');
        echo $redis->get('redistest');
	}
	/*
	遍历目录下所有文件
	 */
	public function fun_dir(){
		var_dump($this->for_dir('F:\www\OptionWeb\option\optionweb\application\controllers'));
	}
	public function for_dir($dir){
		$files = array();
		if(@$headdir = opendir($dir) ){
			while(($file = readdir($headdir)) !== false){
				if($file != '..' && $file != '.'){
					$files[$file] = $this->for_dir($dir.'/'.$file);
				}else{
					$files[] = $file;
				}
			}
			closedir($headdir);
			return $files;
		}
	}
	public function paixu(){
		$csarr = array(99,2,15,110,55);
		var_dump($this->charu($csarr));
		var_dump($this->strrev_fun('abcdef'));
	}
	public function kuansu($arr){
		if(count($arr) <= 1) return $arr;
		$tem = $arr[0];
		$arr_left = array();
		$arr_right = array();
		for($i = 1; $i<count($arr); $i ++){
			if($tem > $arr[$i]){
				$arr_left[] =  $arr[$i];
			}else{
				$arr_right[] =  $arr[$i];
			}

		}
		$arr_left = $this->kuansu($arr_left);
		$arr_right = $this->kuansu($arr_right);
		return array_merge($arr_left,array($tem),$arr_right);
	}
	public function charu($arr){
		if(count($arr) <= 1) return $arr;
		for($i=1; $i<count($arr); $i++){
			$tmp = $arr[$i];
			for($j=$i-1; $j >= 0; $j--){
				if($arr[$j] > $tmp ){
					$arr[$j + 1] = $arr[$j];
					$arr[$j] = $tmp;

				}else{
					break;
				}

			}
		}
		return $arr;
	}
	/*
	字符串翻转
	 */
	public function strrev_fun($str){
		/*$len = mb_strlen($str);
		$newstr = '';
		for($i=$len-1; $i>=0; $i--){
			$newstr .= mb_substr($str, $i, 1, 'utf8');
		}*/
		/*
		$newstr = implode("",array_reverse(preg_split("//u",$str)));
		*/
		$newstr = strrev($str);
		return $newstr;
	}
}
?>