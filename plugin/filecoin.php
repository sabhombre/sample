<?php

/**
* Plugin Name: Filecoin Admin Page
* Description: Adds a custom admin for filecoin admin management.
* Version: 1.0.0
* Author: United Labo Inc.
* Author URI: http://united-labo.co.jp
*/

if(!defined('ABSPATH')){
	die;
}

global $filecoin_db_version;
$filecoin_db_version = '1.0';

class FilecoinPlugin{

	function __construct(){
		add_action( 'admin_menu', array($this,'my_admin_menu' ));
	}

	function activate(){

		flush_rewrite_rules();
		
	}

	function deactivate(){
		flush_rewrite_rules();
	}

	//methods

	function my_admin_menu() {
		add_menu_page(
			__( 'Filecoin Admin Page', 'filecoin-admin-page' ), //page title
			__( 'Filecoin', 'filecoin-admin-page' ), //menu title
			'manage_options', //capability
			'filecoin-page', //slug
			array($this,'my_admin_page_contents'), //callback func
			'dashicons-schedule', //icon
			3 //position
		);
	}

	function my_admin_page_contents() {
	
		if($_GET["user_id"]=='')
		{

			$this->user_list();
	
		}else
		{
			$this->user_stats();
		}
	}

	function filecoin_install() {
		global $wpdb;
		global $filecoin_db_version;

		$table_rev = $wpdb->prefix . 'revenue';
		$table_with = $wpdb->prefix . 'withdrawal';
		
		$charset_collate = $wpdb->get_charset_collate();

		//for revenue

		$sql = "CREATE TABLE $table_rev (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			user_id bigint(20) NOT NULL,
			date_created datetime NOT NULL,
			revenue_date text NOT NULL,
			revenue_amt float NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";

		
		//for withdrawal

		$sql2 = "CREATE TABLE $table_with (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			user_id bigint(20) NOT NULL,
			date_created datetime NOT NULL,
			withdrawal_date text NOT NULL,
			withdrawal_amt float NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";


		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		dbDelta( $sql2 );

		add_option( 'filecoin_db_version', $filecoin_db_version );
	}

	function user_list(){
		?>

		<div class="box">
			<h1>ユーザー一覧</h1>
			<form id="create-user-form">
				<input type="text" name="user-name" id="user-name" placeholder="氏名">
				<input type="email" name="user-email" id="user-email" placeholder="sample@mail.com">
				<input type="text" name="user-password" id="user-password" placeholder="password">
				<input type="submit" name="create-user" id="create-user" value="+ 新規追加">
			</form>
			<div class="table-hldr">
				<table id="filecoin-user-list" border="1" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th>氏名</th>
							<th>メールアドレス</th>
							<th>登録日時</th>
						</tr>
					</thead>
					<tbody>
						<?php 

							$args = array(
							    'role'       => 'subscriber',
							    'orderby'    => 'user_registered',
							    'order'      => 'DESC',
							);

							$blogusers = get_users( $args );
							foreach ( $blogusers as $user ){
						 ?>
						<tr data-id="<?php echo $user->ID; ?>">
							<td><?php echo $user->display_name; ?></td>
							<td><?php echo $user->user_email; ?></td>
							<td><?php echo date('Y/m/d',strtotime($user->user_registered)); ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>

		<?php
	}

	function user_stats(){
		
		global $wpdb;
		
		$user = get_user_by( 'id', $_GET["user_id"] );

		if(metadata_exists('user', $_GET["user_id"], 'mgt_fee')){
			$mgt_fee = get_user_meta($_GET["user_id"], 'mgt_fee', true);
		}
		else
		{
			$mgt_fee = 0;
		}


		?>

		<div class="box user-stats">
			<form class="user-settings" id="user-settings-form">
				<div class="row">
					<div class="flex group">
						<div class="label">氏名</div>
						<div class="val"><input id="user-full-name" class="full-width" type="text" name="user-full-name" value="<?php echo $user->display_name; ?>"></div>
					</div>
					<div class="flex group">
						<div class="label">メールアドレス</div>
						<div class="val"><input id="user-email" class="full-width" type="email" name="user-email" value="<?php echo $user->user_email; ?>"></div>
					</div>
					<div class="flex group">
						<div class="label">パスワード</div>
						<div class="val"><a class="btn" href="<?php echo home_url(); ?>/wp-admin/user-edit.php?user_id=<?php echo $_GET["user_id"]; ?>">パスワードの編集</a></div>
					</div>
				</div>
				<div class="row">
					<div class="flex group">
						<div class="label">累計収益額</div>
						<div class="val" id="user-cum-rev"><span></span> FIL</div>
					</div>
					<div class="flex group">
						<div class="label">累計出金額</div>
						<div class="val" id="user-wdrw-amt"><span></span> FIL</div>
					</div>
					<div class="flex group">
						<div class="label">管理手数料</div>
						<div class="val"><input id="user-mgt-fee" type="text" name="user-mgt-fee" value="<?php echo $mgt_fee; ?>">%</div>
					</div>
				</div>
				<input type="submit" id="save-user" name="save-user-profile" value="設定を保存する">
			</form>
			<div class="tables">
				<div class="flex">
					<div class="col">
						<form id="revenue-form">
							<input type="text" name="rev-date" id="rev-date" placeholder="2021/05/24～2021/06/30"><span style="display:none;" id="rev-update-id" class="update-id-holder"></span>
							<input type="text" name="rev-total" id="rev-amt">
							<input type="submit" name="" id="rev-submit" class="submit-btn" value="+ 新規追加">
							<a href="javascript:void(0);" class="reset">リセット</a>
						</form>
						<div class="scroll-box">
							<table>
								<thead>
									<tr>
										<th>日付</th>
										<th>収益額</th>
										<th>オプション</th>
									</tr>
								</thead>
								<tbody>
									<?php 

										$myrows = $wpdb->get_results($wpdb->prepare("SELECT id, revenue_date, revenue_amt FROM wp_revenue WHERE user_id = $user->ID ORDER BY date_created DESC" ));
										foreach($myrows as $row){
									 ?>
									<tr data-id="<?php echo $row->id; ?>">
										<td class="td-rev-date"><?php echo $row->revenue_date; ?></td>
										<td class="td-rev-amt"><span class="span-rev-amt"><?php echo number_format((float)$row->revenue_amt, 3); ?></span> FIL</td>
										<td class="td-options-rev"><a href="javascript:void(0);" class="edit-rev">更新</a> | <a href="javascript:void(0);" class="del-rev">削除</a></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col">
						<form id="withdrawal-form">
							<input type="text" name="wdrw-date" id="wdrw-date" placeholder="2021/05/24"><span style="display:none;" id="wdrw-update-id" class="update-id-holder"></span>
							<input type="text" name="wdrw-amt" id="wdrw-amt">
							<input type="submit" id="wdrw-submit" name="" class="submit-btn" value="+ 新規追加">
							<a href="javascript:void(0);" class="reset">リセット</a>
						</form>
						<div class="scroll-box">
							<table>
								<thead>
									<tr>
										<th>出金申請日</th>
										<th>出金額</th>
										<th>オプション</th>
									</tr>
								</thead>
								<tbody>
									<?php 

										$myrows = $wpdb->get_results($wpdb->prepare("SELECT id,withdrawal_date, withdrawal_amt FROM wp_withdrawal WHERE user_id = $user->ID ORDER BY date_created DESC" ));
										foreach($myrows as $row){
									 ?>
									<tr data-id="<?php echo $row->id; ?>">
										<td class="td-wdrw-date"><?php echo $row->withdrawal_date; ?></td>
										<td class="td-wdrw-amt"><span class="span-wdrw-amt"><?php echo number_format((float)$row->withdrawal_amt, 3); ?></span> FIL</td>
										<td class="td-options-wdrw"><a href="javascript:void(0);" class="edit-wdrw">更新</a> | <a href="javascript:void(0);" class="del-wdrw">削除</a></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
	}

	function register_my_plugin_scripts() {

		wp_register_style( 'filecoin-style', plugins_url( 'filecoin/css/plugin.css' ) );
		wp_register_style( 'filecoin-table-style', '//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css');
		wp_register_script('filecoin-table-script', '//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js');
		wp_register_script('filecoin-user-list-script', plugins_url( 'filecoin/js/table.js'), array('jquery') );

	}

	function load_my_plugin_scripts( $hook ) {

		if( $hook != 'toplevel_page_filecoin-page' ) {

			return;

		}

		// Load style & scripts.

		wp_enqueue_style( 'filecoin-style' );
		wp_enqueue_style( 'filecoin-table-style' );

		wp_enqueue_script( 'filecoin-table-script' );
		wp_enqueue_script( 'filecoin-user-list-script' );

	}

}

if(class_exists('FilecoinPlugin')){
	$filecoinPlugin = new FilecoinPlugin();
}


//activation

register_activation_hook(__FILE__,array($filecoinPlugin, 'activate'));

register_activation_hook( __FILE__,array($filecoinPlugin, 'filecoin_install'));

//deactivation

register_deactivation_hook(__FILE__,array($filecoinPlugin, 'deactivate'));

add_action( 'admin_enqueue_scripts', array($filecoinPlugin,'register_my_plugin_scripts'));
add_action( 'admin_enqueue_scripts', array($filecoinPlugin,'load_my_plugin_scripts'));









?>