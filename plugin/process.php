<?php 

require_once('../../../wp-config.php');
require_once( "../../../wp-load.php" );

//get action

$action = $_POST['action'];

switch ($action) {
	case 'edit_user':

		$uid = $_POST['user_id'];
		$email = sanitize_email($_POST['email']);
		$name = sanitize_text_field($_POST['name']);
		$mgt_fee = sanitize_text_field($_POST['mgt_fee']);

		// $val = $email.' '.$mgt_fee.' '.$name.' '.$uid;

		//for mgt fee

		if(metadata_exists('user', $uid, 'mgt_fee')){
			$mgt_fee_updated = update_user_meta($uid,'mgt_fee',$mgt_fee);
		}
		else{
			add_user_meta( $uid, 'mgt_fee', $mgt_fee);
			$mgt_fee_updated = true;
		}

		
		$user_data = wp_update_user( 
			array( 
				'ID' => $uid, 
				'user_email' => $email,
				'display_name' => $name
			) 
		);

		if ( is_wp_error( $user_data ) ) {
		    // There was an error; possibly this user doesn't exist.
		    $val = 'Error.';
		} else {
		    // Success!
		    $val = 'User profile updated.';
		}
		
		echo $val;

		break;

	case 'add_user':

		$user_login = sanitize_text_field($_POST['email']);
		$email = sanitize_email($_POST['email']);
		$password = $_POST['password'];
		$name = sanitize_text_field($_POST['name']);

		// $val = $user_login.' '.$email.' '.$password.' '.$name;

		$result = wp_insert_user( array(
		  'user_login' => $user_login,
		  'user_pass' => $password,
		  'user_email' => $email,
		  'display_name' => $name,
		  'role' => 'subscriber'
		));


		if(is_wp_error($result)){
		  $error = $result->get_error_message();
		  $val = $error;
		}else{
		  $user = get_user_by('id', $result);
		  if($user!='')
		  {
		  	if(add_user_meta( $user->ID, 'mgt_fee', 0)){
		  		$val = 'success';
		  	}
		  }
		}

		echo $val;

		break;

	case 'add_revenue':

		$revenue_date = $_POST['revenue_date'];
		$revenue_amt = sanitize_text_field($_POST['revenue_amt']);
		$user_id = sanitize_text_field($_POST['user_id']);


		global $wpdb;
		

		$table = $wpdb->prefix.'revenue';
		$data = array(
			'user_id' => $user_id, 
			'revenue_date' => $revenue_date,
			'revenue_amt' => $revenue_amt,
			'date_created' => current_time('mysql')
		);
		$result = $wpdb->insert($table,$data);

		if($result){
			$val = 'Successfully added a revenue record.';
		}
		else
		{
			$val = 'error';
		}

		echo $val;

		break;

	case 'update_revenue':

		$id = $_POST['revenue_id'];
		$revenue_date = $_POST['revenue_date'];
		$revenue_amt = sanitize_text_field($_POST['revenue_amt']);


		global $wpdb;
		

		$table = $wpdb->prefix.'revenue';
		$data = array(
			'revenue_date' => $revenue_date,
			'revenue_amt' => $revenue_amt
		);
		$result = $wpdb->update($table,$data,array('id'=>$id));

		if($result){
			$val = 'Successfully updated a revenue record.';
		}
		else
		{
			$val = 'error';
		}

		echo $val;

		break;

	case 'delete_revenue':

		$id = $_POST['revenue_id'];

		global $wpdb;
		

		$table = $wpdb->prefix.'revenue';

		$result = $wpdb->delete($table,array('id'=>$id));

		if($result){
			$val = 'Successfully removed a revenue record.';
		}
		else
		{
			$val = 'error';
		}

		echo $val;

		break;

	case 'add_withdrawal':

		$withdrawal_date = $_POST['withdrawal_date'];
		$withdrawal_amt = sanitize_text_field($_POST['withdrawal_amt']);
		$user_id = sanitize_text_field($_POST['user_id']);


		global $wpdb;

		// $val = $withdrawal_date.' '.$withdrawal_amt.' '.$user_id;
		

		$table = $wpdb->prefix.'withdrawal';
		$data = array(
			'user_id' => $user_id, 
			'withdrawal_date' => $withdrawal_date,
			'withdrawal_amt' => $withdrawal_amt,
			'date_created' => current_time('mysql')
		);
		$result = $wpdb->insert($table,$data);

		if($result){
			$val = 'Successfully added a withdrawal record.';
		}
		else
		{
			$val = 'error';
		}

		echo $val;

		break;

	case 'update_withdrawal':

		$id = $_POST['withdrawal_id'];
		$withdrawal_date = $_POST['withdrawal_date'];
		$withdrawal_amt = sanitize_text_field($_POST['withdrawal_amt']);


		global $wpdb;

		// $val = $withdrawal_date.' '.$withdrawal_amt.' '.$user_id;
		

		$table = $wpdb->prefix.'withdrawal';
		$data = array(
			'withdrawal_date' => $withdrawal_date,
			'withdrawal_amt' => $withdrawal_amt
		);
		$result = $wpdb->update($table,$data,array('id'=>$id));

		if($result){
			$val = 'Successfully updated a withdrawal record.';
		}
		else
		{
			$val = 'error';
		}

		echo $val;

		break;

	case 'delete_withdrawal':

		$id = $_POST['withdrawal_id'];

		global $wpdb;
		

		$table = $wpdb->prefix.'withdrawal';

		$result = $wpdb->delete($table,array('id'=>$id));

		if($result){
			$val = 'Successfully removed a withdrawal record.';
		}
		else
		{
			$val = 'error';
		}

		echo $val;
		
		break;

	case 'get_cumulative_revenue':

		global $wpdb;

		$user_id = $_POST['user_id'];

		$result = $wpdb->get_results("SELECT sum(revenue_amt) as result_value FROM wp_revenue WHERE user_id = ".$user_id."");

		echo $result[0]->result_value;

		break;

	case 'get_withdrawal_total':

		global $wpdb;

		$user_id = $_POST['user_id'];

		$result = $wpdb->get_results("SELECT sum(withdrawal_amt) as result_value FROM wp_withdrawal WHERE user_id = ".$user_id."");

		echo $result[0]->result_value;

		break;
	
	default:
		// code...
		break;
}

?>