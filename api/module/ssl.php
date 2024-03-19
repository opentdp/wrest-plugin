<?php  
// SSL证书API类  
class SSLAPI {
	private $CuteAPI = [  
	        'https://www.cuteapi.com/api/ssl/api.php',  
	        'https://www.cuteapi.cn/api/ssl/api.php'  
	    ];
	// 获取随机API端点  
	private function getRandomApiUrl() {
		$randomIndex = array_rand($this->CuteAPI);
		return $this->CuteAPI[$randomIndex];
	}
	// 发送GET请求到SSL证书API  
	public function getSSLCertificateInfo($domain) {
		$randomUrl = $this->getRandomApiUrl();
		$url = $randomUrl . '?domain=' . urlencode($domain);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		return json_decode($response, true);
		// 将JSON响应转换为数组
	}
	// 处理API请求并返回格式化信息  
	public function handleRequest($domain) {
		$info = $this->getSSLCertificateInfo($domain);
		// 格式化SSL证书信息  
		$formattedInfo = [ 
		'域名'=> $info['Domain']  , 
		'签发域名' => $info['SSL_Domain'] ,  
		'证书机构' => $info['CA'] ,  
		'颁发者' => $info['issuer'] ,
		'备用主机' => $info['SAN'] ,
		'国家' => $info['Country'] ,
		'省' => $info['Province'] ,
		'市' => $info['City'] ,
		'颁发给' => $info['OA'] ,
		'加密方式' => $info['SN'] ,
		'签发时间' => $info['validFrom'] ,
		'到期时间' => $info['validTo'] ,
		'剩余时间' => $info['DaysRemaining'] ,
		            // ... 根据您的API响应添加其他字段  
		];
		// 返回格式化后的SSL证书信息  
		http_response_code(200);
		header('Content-Type: application/json');
		echo json_encode($formattedInfo);
	}
}
// 处理HTTP请求  
$sslApi = new SSLAPI();
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['domain'])) {
	$domain = $_GET['domain'];
	$sslApi->handleRequest($domain);
	$domain = $_GET['domain'];  
    $domain = trim($domain);  
    $domain = strtolower($domain);  
    $domain = preg_replace('/\s+/', '', $domain); // 移除空白字符  
    $domain = preg_replace('/^https?:\/\//', '', $domain); // 移除协议头  
      
} else {
	http_response_code(400);
		header('Content-Type: application/json');
		echo json_encode($formattedInfo);
	echo 'No domain provided.';
}
