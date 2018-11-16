<?php

// first install dependencies: 
//     composer require nfephp-org/sped-nfe

require __DIR__.'/vendor/autoload.php';

use NFePHP\Common\Certificate;

if ($argc < 3) {
	echo "\nUsage: php certtest.php <certificate-pfx-file> <password>\n";
	exit(1);
}

$arg_file = $argv[1];
$arg_password = $argv[2];

 /**
  * Function getCertificateData receives a digital certificate file and its password,
  * then returns a json with digital certificate information.
  *
  * @author  Andre Dourado <andreldcastro@gmail.com>
  *
  * @since 1.0
  *
  * @param string $file 	Digital certificate file wit ".pfx" extension.
  * @param string $password Digital certificate's password.
  *
  * @return string JSON that indicates success (1) or failure (0) of certificate reading,
  *                and in case of success returns digital certificates information.
  * Example:
  *
  * <code>
  * {
  * 	"returnCode":1,
  *		"isExpired":true,
  * 	"companyName":"AUDITS SOLUCOES LTDA:99999999999999",
  * 	"validFrom":{"date":"2017-10-25 17:26:58.000000","timezone_type":3,"timezone":"Europe\/Berlin"},
  *		"validTo":{"date":"2018-10-25 17:26:58.000000","timezone_type":3,"timezone":"Europe\/Berlin"},
  *		"cnpj":"99999999999999"
  *	}
  * </code>
  *
  * <code>
  * {
  * 	"returnCode":0
  *	}
  * </code>
  *
  */
function getCertificateData($file, $password) {

    $certificate = null;
    $cert_info = array();

    try {

        $certificate = Certificate::readPfx(file_get_contents($file), $password);

    } catch(\Exception $exception) {

    	$cert_info["returnCode"] = 0;
    	return json_encode($cert_info);
  		exit();
    }

    $cert_info["returnCode"] = 1;
    $cert_info["isExpired"] = $certificate->isExpired();
    $cert_info["companyName"] = $certificate->getCompanyName();
    $cert_info["validFrom"] = $certificate->getValidFrom();
    $cert_info["validTo"] = $certificate->getValidTo();
    $cert_info["cnpj"] = $certificate->getCnpj();

    return json_encode($cert_info);
}

echo getCertificateData($arg_file, $arg_password);

?>