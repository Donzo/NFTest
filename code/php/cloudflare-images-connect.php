<?php

	function getUploadURL(){
		$url = "https://api.cloudflare.com/client/v4/accounts/*ACCOUNT*/images/v1/direct_upload";
		$curl = curl_init();

		$customHeaders = array(
			"Content-Type: application/json",
			"Authorization: Bearer :secretKey"
		);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $customHeaders);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, TRUE);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		$data = curl_exec($curl);
		$dataObject = json_decode($data, true);
		$uploadURL = $dataObject['result']['uploadURL'];

		curl_close($curl);
		//uploadFile($uploadURL, $fileName);
		print $uploadURL;
	}
	getUploadURL();

?>