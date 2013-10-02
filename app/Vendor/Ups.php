<?php
class Ups  {
	
	public $AccessLicenseNumber;  
	public $UserId;  
	public $Password;
	public $shipperNumber;
	public $credentials;
	public $dimensionsUnits = "IN";
	public $weightUnits = "LBS";
    
    
	
	public function __construct($access,$user,$pass,$shipper) {
		$this->AccessLicenseNumber = $access;
		$this->UserID = $user;
		$this->Password = $pass;	
		$this->shipperNumber = $shipper;
		$this->credentials = 1;
	}
	    
	public function setDimensionsUnits($unit){
		$this->dimensionsUnits = $unit;
	}
	
	public function setWeightUnits($unit){
		$this->weightUnits = $unit;
	}
    
	// Define the function getRate() - no parameters
	public function getRate($service,$PostalCode,$dest_zip,$length,$width,$height,$weight) {
		if ($this->credentials != 1) {
			print 'Please set your credentials with the setCredentials function';
			die();
		}
		$data ="<?xml version=\"1.0\"?>  
			<AccessRequest xml:lang=\"en-US\">  
			    <AccessLicenseNumber>$this->AccessLicenseNumber</AccessLicenseNumber>  
			    <UserId>$this->UserID</UserId>  
			    <Password>$this->Password</Password>  
			</AccessRequest>  
			<?xml version=\"1.0\"?>  
			<RatingServiceSelectionRequest xml:lang=\"en-US\">  
				<Request>  
				    <TransactionReference>  
					<CustomerContext>Bare Bones Rate Request</CustomerContext>  
					<XpciVersion>1.0001</XpciVersion>  
				    </TransactionReference>  
				    <RequestAction>Rate</RequestAction>  
				    <RequestOption>Rate</RequestOption>  
				</Request>  
				<PickupType>  
				    <Code>01</Code>  
				</PickupType>  
				<Shipment>  
				    <Shipper>  
					<Address>  
					    <PostalCode>$PostalCode</PostalCode>  
					    <CountryCode>US</CountryCode>  
					</Address>  
				    <ShipperNumber>$this->shipperNumber</ShipperNumber>  
				    </Shipper>  
				    <ShipTo>  
					<Address>  
					    <PostalCode>$dest_zip</PostalCode>  
					    <CountryCode>US</CountryCode>  
					<ResidentialAddressIndicator/>  
					</Address>  
				    </ShipTo>  
				    <ShipFrom>  
					<Address>  
					    <PostalCode>$PostalCode</PostalCode>  
					    <CountryCode>US</CountryCode>  
					</Address>  
				    </ShipFrom>  
				    <Service>  
					<Code>$service</Code>  
				    </Service>  
				    <Package>  
					<PackagingType>  
					    <Code>02</Code>  
					</PackagingType>  
					<Dimensions>  
					    <UnitOfMeasurement>  
						<Code>$this->dimensionsUnits</Code>  
					    </UnitOfMeasurement>  
					    <Length>$length</Length>  
					    <Width>$width</Width>  
					    <Height>$height</Height>  
					</Dimensions>  
					<PackageWeight>  
					    <UnitOfMeasurement>  
						<Code>$this->weightUnits</Code>  
					    </UnitOfMeasurement>  
					    <Weight>$weight</Weight>  
					</PackageWeight>  
				    </Package>  
				</Shipment>  
			</RatingServiceSelectionRequest>";  
			$ch = curl_init("https://www.ups.com/ups.app/xml/Rate");  
			curl_setopt($ch, CURLOPT_HEADER, 0);  
			curl_setopt($ch,CURLOPT_POST,1);  
			curl_setopt($ch,CURLOPT_TIMEOUT, 60);  
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
			curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);  
			curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
			curl_setopt($ch,CURLOPT_POSTFIELDS,$data);  
			$ch_response=curl_exec ($ch);
			
			if (curl_error($ch)) {
				// If it wasn't...
				$output['status'] = "Failure";
				$output['response']['code'] = '-1';
				$output['data'] = null;
				$output['response']['responseMsg'] = curl_error($ch);
			} else {
				$output['status'] = 'Success';
				$output['data'] = $ch_response;
				$output = $this->processResponse($output);
			}
			curl_close($ch);
			return $output;
			//echo "<pre>";print_r($result);die;
			//echo '<!-- '. $result. ' -->'; // THIS LINE IS FOR DEBUG PURPOSES ONLY-IT WILL SHOW IN HTML COMMENTS
			
			//$xml =  json_decode(json_encode((array) simplexml_load_string($result)), 1);
			
			//echo "<pre>";print_r($xml1);die;
			//$data = strstr($result, '<?');  
			//$xml_parser = xml_parser_create();  
			//xml_parse_into_struct($xml_parser, $data, $vals, $index);  
			//xml_parser_free($xml_parser);  
			//$params = array();  
			//$level = array();  
			//foreach ($vals as $xml_elem) {  
			//	if ($xml_elem['type'] == 'open') {  
			//		if (array_key_exists('attributes',$xml_elem)) {  
			//		     list($level[$xml_elem['level']],$extra) = array_values($xml_elem['attributes']);  
			//		} else {  
			//		     $level[$xml_elem['level']] = $xml_elem['tag'];  
			//		}  
			//	}  
			//	if ($xml_elem['type'] == 'complete') {  
			//		$start_level = 1;  
			//		$php_stmt = '$params';  
			//		while($start_level < $xml_elem['level']) {  
			//		     $php_stmt .= '[$level['.$start_level.']]';  
			//		     $start_level++;  
			//		}  
			//		$php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';  
			//		eval($php_stmt);  
			//	}  
			//}  
			

		}
		
		
    
		public function processResponse($output){
			
			$result =  json_decode(json_encode((array) simplexml_load_string($output['data'])), 1);
			
			$output['response'] = array();
			
			if(isset($result['Response']['ResponseStatusCode']) && $result['Response']['ResponseStatusCode'] == 1){
				$output['response']['code'] = 100;
				$output['response']['rate'] = $result['RatedShipment']['TotalCharges']['MonetaryValue'];
			}
			else{
				$output['status'] = "Failure";
				$output['response']['code'] = $result['Response']['Error']['ErrorCode'];
				$output['response']['errorMessage'] = $result['Response']['Error']['ErrorDescription'];
			}
			return $output;
		}
	}
?>