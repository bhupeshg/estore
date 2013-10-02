<?php
class Authorize  {
	
	public $serviceUrl;  
	public $loginId;  
	public $transactionKey;
	public $version = '3.1';
	public $type;
    
	public function __construct($serviceUrl,$loginId,$transactionKey,$type) {
		$this->serviceUrl = $serviceUrl;
		$this->loginId = $loginId;
		$this->transactionKey = $transactionKey;
		$this->type = $type;
	}
	    
	
    
	// Define the function getRate() - no parameters
	public function makePayment($data = array()) {
		

		$post_values = array(
			
			// the API Login ID and Transaction Key must be replaced with valid values
			"x_login"		=> $this->loginId,
			"x_tran_key"		=> $this->transactionKey,
			"x_version"		=> $this->version,
			"x_delim_data"		=> "TRUE",
			"x_delim_char"		=> "|",
			"x_relay_response"	=> "FALSE",
			"x_type"		=> $this->type,
			"x_method"		=> "CC",
			"x_card_num"		=> $data['cc_number'],
			"x_exp_date"		=> $data['exp_date'],
			"x_amount"		=> $data['amount'],
			"x_description"		=> "Sample Transaction",
			"x_first_name"		=> $data['first_name'],
			"x_last_name"		=> $data['last_name'],
			"x_address"		=> $data['address'],
			"x_state"		=> $data['state'],
			"x_zip"			=> $data['zip_code'],
			// Additional fields can be added here as outlined in the AIM integration
			// guide at: http://developer.authorize.net
		);
		$post_string = "";
		foreach( $post_values as $key => $value ){
			$post_string .= "$key=" . urlencode( $value ) . "&";
		}
		$post_string = rtrim( $post_string, "& " );
		
		$request = curl_init($this->serviceUrl); 
		curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
		curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
		curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
		curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
		$ch_response = curl_exec($request); // execute curl post and store results in $post_response
		// additional options may be required depending upon your server configuration
		// you can find documentation on curl options at http://www.php.net/curl_setopt
		
		if (curl_error($request)) {
			// If it wasn't...
			$output['status'] = "Failure";
			$output['response']['code'] = '-1';
			$output['data'] = null;
			$output['response']['responseMsg'] = curl_error($request);
		} else {
			$output['status'] = 'Success';
			$output['data'] = $ch_response;
			$output = explode($post_values["x_delim_char"],$ch_response);
		}
		
		curl_close ($request); // close curl object
		
		return $output;
	}
		
		
    
}
?>