# digital-certificate-test

Simple routine developed in PHP to test digital certificates.

Inform a digital certificate file and its password, then routine returns a json with digital certificate information.

JSON indicates success (1) or failure (0) of certificate reading. In case of success returns digital certificates information.

Example:

```sh
{
 	"returnCode":1,
	"isExpired":true,
 	"companyName":"AUDITS SOLUCOES LTDA:99999999999999",
 	"validFrom":{"date":"2017-10-25 17:26:58.000000","timezone_type":3,"timezone":"Europe\/Berlin"},
	"validTo":{"date":"2018-10-25 17:26:58.000000","timezone_type":3,"timezone":"Europe\/Berlin"},
	"cnpj":"99999999999999"
}
```

```sh
{
 	"returnCode":0
}
```


### Requirements

That routine uses open source projects to run properly:

* [PHP](http://php.net/)
* [Composer](https://getcomposer.org/)
* [nfephp-org/sped-nfe](https://github.com/nfephp-org/sped-nfe)



### Installation

Create a directory to store routine.

```sh
$ mkdir certtest
$ cd certtest
```

Routine requires [nfephp-org/sped-nfe](https://github.com/nfephp-org/sped-nfe) to run.

```sh
$ composer require nfephp-org/sped-nfe
```

Copy certtest.php script to directory created before.


### Execution

Run script informing digital certificate file with ".pfx" extension and its password.

```sh
$ php certtest.php audits.pfx 123456
```



### License

MIT
