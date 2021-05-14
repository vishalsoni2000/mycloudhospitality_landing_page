<?php
	include("includes/class.php");
	$dbf=new UBClass();
	
	$trial_hotelname	=	$_POST['trial_hotelname'];
	$trial_name		=	$_POST['trial_name'];	
	$trial_email		=	$_POST['trial_email'];
	$trial_phone		=	$_POST['trial_phone'];	
	$trial_country		=	$_POST['trial_country'];
	$trial_state		=	$_POST['trial_state'];
	$trial_website		=	$_POST['trial_website'];
	$recaptcha_secret 	= 	'6Lcdrw8UAAAAAPUMF8kYP28wbbI3_y5adCccehJb'; 
	
	
	if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	if( $trial_email != '' ) {
			// Runs only when reCaptcha is present in the Contact Form
			if( isset( $_POST['g-recaptcha-response'] ) ) {
				$recaptcha_response = $_POST['g-recaptcha-response'];
				$response = file_get_contents( "https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $recaptcha_response );

				$g_response = json_decode( $response );

				if ( $g_response->success !== true ) {
					echo json_encode(array('status'=>'error','message'=>"Captcha not Validated! Please Try Again."));
					die;
				}
			}
			
			// mycloud trial api 
			
			$curldata = array(
			'hotel_name' => $trial_hotelname,
			'name' => $trial_name,
			'email' => $trial_email,
			'phone' => $trial_phone,
			'country' => $trial_country
			);
			
			$data_string = json_encode($curldata);
			
			$curl = curl_init();

			$headr = array();
			$headr[] = 'Content-length:  ' . strlen($data_string);
			$headr[] = 'Content-type: application/json';
			$headr[] = 'Authorization: mycloudhospitality@trial2016'; 
			
			
			
			curl_setopt_array($curl, array(
			    CURLOPT_RETURNTRANSFER => true,
			    CURLOPT_URL => 'http://trial.mycloudhospitality.com/mycloudSubscriptionAPI/api/activate',
			    CURLOPT_POSTFIELDS => $data_string,
			    CURLOPT_HTTPHEADER => $headr,
			    CURLOPT_USERAGENT => 'mycloud trial activate',
			    CURLOPT_POST => 1
			)); 
			
			$resp_activate_json = curl_exec($curl);
			//print_r($resp_activate_json);
			curl_close($curl);
			
			
			
			$activate_array = json_decode($resp_activate_json, true);
			//print("<pre>".print_r($activate_array,true)."</pre>");
			
			
			// end mycloud trial api
			
			
			
			if($activate_array['status']=='PASS')
			{
			
			$sql	=	"insert into mycloud_trial set hotelname='$trial_hotelname',name='$trial_name',email='$trial_email',phone='$trial_phone',country='$trial_country',state='$trial_state',website='$trial_website'";
			$query	=	mysql_query($sql);	
			$lastid = 	mysql_insert_id();
			echo json_encode(array('status'=>'success','id'=>$lastid));
			
			}
			else{
				echo json_encode(array('status'=>'apierror','message'=>"This email is already registered, use a different email."));
			}
	
	}
	}
	
	
?>