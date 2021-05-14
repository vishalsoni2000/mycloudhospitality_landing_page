<?php
	class Dbfunctions {
		public function fetch($con,$tblName,$optCondition="",$optorder="",$optlimit="",$optorderType="ASC",$colName="*") 
		{
			if(trim($optCondition) != "")
			{
				$condition = " WHERE " . $optCondition;
			}
			else
			{
				$condition = "";
			}
			
			if(trim($optlimit) != "")
			{
				$limit = " ".$optlimit;
			}
			else
			{
				$limit = "";
			}
			if(trim($optorder) != "")
			{
				$sql="SELECT ".$colName." FROM " . $tblName . $condition ." ORDER BY ". $optorder." ".$optorderType." ". $limit;
			}
			else
			{
				$sql="SELECT ".$colName." FROM " . $tblName . $condition." ". $limit;
			}
			//echo $sql;
			$result = mysql_query($sql,$con);
			if(!$result){
				echo "ERROR :- ".mysql_error();
			}
			while($row = mysql_fetch_array($result)){
				$result_array[] = $row;
			}
			if(count($result_array)>0)
			{
				return $result_array;	
			}
			else
			{
				$default_val=array();
				return $default_val;
			}
		}
		
		public function echo_sql($con,$tblName,$optCondition="",$optorder="",$optlimit="",$optorderType="ASC")
		{
			
			if(trim($optCondition) != "")
			{
				$condition = " WHERE " . $optCondition;
			}
			else
			{
				$condition = "";
			}
			
			if(trim($optlimit) != "")
			{
				$limit = " ".$optlimit;
			}
			else
			{
				$limit = "";
			}
			if(trim($optorder) != "")
			{
				$sql="SELECT * FROM " . $tblName . $condition ." ORDER BY ". $optorder." ".$optorderType." ". $limit;
			}
			else
			{
				$sql="SELECT * FROM " . $tblName . $condition." ". $limit;
			}
			//echo $sql;
			$result =$sql;
			return $result;
			
			
			
			
		}
		
		public function echo_sql_insert($con,$tblName,$optCondition="",$optorder="",$optlimit="",$optorderType="ASC")
		{
			
			if(trim($optCondition) != "")
			{
				$condition = " WHERE " . $optCondition;
			}
			else
			{
				$condition = "";
			}
			
			if(trim($optlimit) != "")
			{
				$limit = " ".$optlimit;
			}
			else
			{
				$limit = "";
			}
			if(trim($optorder) != "")
			{
				$sql="INSERT INTO " . $tblName ." set ". $condition ." ORDER BY ". $optorder." ".$optorderType." ". $limit;
			}
			else
			{
				$sql="INSERT INTO " . $tblName ." set ". $condition." ". $limit;
			}
			//echo $sql;
			$result =$sql;
			return $result;
			
			
			
			
		}
		
		public function count_rows($con,$tblName,$optCondition="")
		{
			if($optCondition=="")
			{
				$condition="";
			}
			else
			{
				$condition=" where ".$optCondition;
			}
			
			//$sql="SELECT * FROM " . $tblName ." where ". $optCondition;
			$sql="SELECT * FROM " . $tblName ." ".$condition;
			$result=mysql_query($sql,$con);
			if(!$result)
			echo "ERROR :". mysql_error();
			$val=mysql_num_rows($result);
			return $val;
		}
		
		public function insertSet($con,$tblName,$string)
		{
			$rs= mysql_query("INSERT INTO  " . $tblName . " SET " .  $string,$con);
			if($rs)
			{
				$lastId=mysql_insert_id($con);
				return $lastId;
			}
			else
			{
				echo "ERROR :- ".mysql_error();
				return 0;
			}
		}
		
		public function escapeString($con,$data)
		{
			return mysql_real_escape_string($data,$con);
		}
		
		
		public function fetchDistinct($con,$tblName,$distinctname,$optCondition="",$optorder="",$optlimit="",$optorderType="ASC") 
		{
			if(trim($optCondition) != "")
			{
				$condition = " WHERE " . $optCondition;
			}
			else
			{
				$condition = "";
			}
			
			if(trim($optlimit) != "")
			{
				$limit = " ".$optlimit;
			}
			else
			{
				$limit = "";
			}
			
			if(trim($optorder) != "")	
			{
				$sql="SELECT distinct(".$distinctname.") FROM " . $tblName . $condition ." ORDER BY ". $optorder." ".$optorderType. $limit;
			}
			else
			{
				$sql="SELECT distinct(".$distinctname.") FROM " . $tblName . $condition. $limit;
			}
			//echo $sql;
			$result = mysql_query($sql,$con);
			if(!$result){
			//echo mysql_error();
			trigger_error("Problem selecting data");
			}
			$result_array="";
			while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$result_array[] = $row;
			}
			if(count($result_array)>0)
			{
			return $result_array;	
			}
			else
			{
			$default_val=array();
			return $default_val;
			}
			}
			
			function fetchColumns($con,$tblName,$field,$optCondition="") 
			{
			if(trim($optCondition) != "")
			{
			$sql = "SELECT ".$field." from ".$tblName." WHERE " . $optCondition;
			}
			else
			{
			$sql = "SELECT ".$field." from ".$tblName;
			}
			//echo $sql;
			$result = mysql_query($sql,$con);
			if($result){
			return mysql_fetch_array($result);
			}
			else
			{
			
			return;
			}
			}
			
			function updateTable($con,$tblName,$field,$optCondition="")
			{
			if($optCondition=="")
			{
			$condition="";
			}
			else
			{
			$condition=" where ".$optCondition." ";
			}
			$sql="update ".$tblName ." set ".$field."  ".$condition;
			$res=mysql_query($sql,$con);
			
			if(!$res)
			{
			//echo mysql_query(); 
			return 0;
			}
			else
			return 1;
			
			
			}
			function deleteTable($con,$tblName, $optCondition="")
			{
			if($optCondition=="")
			{
			$condition="";
			}
			else
			{
			$condition=" where ".$optCondition;
			}
			$sql="delete from ". $tblName. " ".$condition;
			$res=mysql_query($sql, $con); 
			$sql="select count(*) from ". $tblName ;
			$res_cnt_arr=mysql_fetch_row(mysql_query($sql,$con));
			$res_cnt=$res_cnt_arr[0];
			return $res_cnt;
		 	
			}
			function completeQuery($con,$string)
			{
			$result=mysql_query($string,$con);
			
			if(!$result)
			echo "ERROR :- ".mysql_error();
			else
			{
			while($val= mysql_fetch_array($result))
			{
			$result_array[]=$val;
			}
			}
			if(count($result_array)>0)
			{
			return $result_array;	
			}
			else
			{
			$default_val=array();
			return $default_val;
			}
			}
			public function subscribeToMailchimp($mail){
			$api_key = MAILCHIMP_APIID;
			$list_id = MAILCHIMP_LISTID;
			require('Mailchimp.php');
			$Mailchimp = new Mailchimp( $api_key );
			$Mailchimp_Lists = new Mailchimp_Lists( $Mailchimp );
			$subscriber = $Mailchimp_Lists->subscribe( $list_id, array( 'email' => htmlentities($mail) ) );
			if ( ! empty( $subscriber['leid'] ) ) {
			return array('responce'=>'OK');   
			}
			else
			{
			return array('responce'=>'FAIL');
			}
			}
			
			}
			?>			