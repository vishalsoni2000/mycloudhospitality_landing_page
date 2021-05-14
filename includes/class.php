<?php
	include_once 'db_constant.php';
	include_once 'db_function.php';
class DB_Class extends Dbfunctions{
	public $website_con;	
	function __construct(){
		$this->website_con = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die('Oops connection error -> ' . mysql_error());
		mysql_select_db(DB_DATABASE, $this->website_con) or die('Database error -> ' . mysql_error());	
		mysql_query("SET character_set_results=utf8", $this->website_con);
		mb_language('uni');
		mb_internal_encoding('UTF-8');	
		mysql_query("set names 'utf8'",$this->website_con);		
		
	}

}

class UBClass extends DB_Class{
	
	public function __construct(){
		parent::__construct();
	}
	public function __destruct(){
		mysql_close($this->website_con);
	}
}

	function sendmailnow($to,$from,$name,$subj,$msg) 
	{

		
		$mail_request_flag=true;
		$subject=	$subj;
		
				
		$body = "<html><body><h3>" . $subject. "</h3> ". 
		"<table rules='all' style='border-color: #666;' cellpadding='10'>".
		"<tr style='background: #eee;'><td><strong>Please find client details below </strong> </td><td></td></tr>".
		"<tr style='background: #eee;'><td><strong>Name:</strong> </td><td> ". $bulk_client_name ."</td></tr>".
		"<tr style='background: #eee;'><td><strong>Email:</strong> </td><td> " . $bulk_client_email. "</td></tr>".
		"<tr style='background: #eee;'><td><strong>Message:</strong> </td><td> " . $bulk_client_msg. "</td></tr>";
		
		
		$body_footer = "</table></body></html>";		
		$complete_mailbody = $body.$body_footer;		
		
		if($mail_request_flag==true){

			$fromAddress = "From: $from\r\n" .
		   "Reply-To: webmaster@" . $_SERVER['SERVER_NAME'] . "\r\n" .
		   "MIME-Version: 1.0\r\n".
		   "Content-Type: text/html; charset=ISO-8859-1\r\n" .
		   "X-Mailer: PHP/" . phpversion();


			if ($to <> "" ){

				for ($i = 1; $i <= 1; $i++) 
				{				
					
					if(mail($to, $subject, $complete_mailbody, $from))
					{
						$response='Thank You';
						
					}
					else
					{
						$response='Oops';
					}
					$mail_request_flag=false;
				}
			}
		}
		
		//return $response;
		
	}
	

?>
