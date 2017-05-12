<?php namespace ATDev\Commweb;

/**
 * An abstract class which handles all requests to api
 */
abstract class RequestAbstract implements \JsonSerializable {

	/** @var string Api operation, should be defined at child classes */
	protected $apiOperation;
	/** @var string Request method, can be overriden at child classes if required*/
	protected $method = 'PUT';
	/** @var string Subject order */
	protected $order;
	/** @var string Subject transaction */
	protected $transaction;

	/** @var string Api version */
	private $version = 34;
	/** @var string Api url */
	private $url = "https://paymentgateway.commbank.com.au/api/rest/";
	/** @var string Merchant id */
	private $merchant;
	/** @var string Api password */
	private $password;
	/** @var bool Test mode, "TEST" will be added to merchant id when sent to api */
	private $testMode = false;
	/** @var string|null Error message, empty if no error, some text if any */
	private $error;

	/**
	 * Class constructor
	 *
	 * @param string $merchant Merchant id
	 */
	public function __construct($merchant) {

		$this->setMerchant($merchant);
	}

	/**
	 * Sets transaction for the request
	 *
	 * @param \ATDev\Commweb\Transaction $transaction
	 *
	 * @return \ATDev\Commweb\RequestAbstract
	 */
	public function setTransaction(Transaction $transaction) {

		$this->transaction = $transaction;

		return $this;
	}

	/**
	 * Sets order for the request
	 *
	 * @param \ATDev\Commweb\Order $order
	 *
	 * @return \ATDev\Commweb\RequestAbstract
	 */
	public function setOrder(Order $order) {

		$this->order = $order;

		return $this;
	}

	/**
	 * Sets api version to request
	 *
	 * @param string $version
	 *
	 * @return \ATDev\Commweb\RequestAbstract
	 */
	public function setVersion($version) {

		$this->version = $version;

		return $this;
	}

	/**
	 * Sets api url
	 *
	 * @param string $url
	 *
	 * @return \ATDev\Commweb\RequestAbstract
	 */
	public function setUrl($url) {

		$this->url = $url;

		return $this;
	}

	/**
	 * Sets merchant id
	 *
	 * @param string $merchant Merchant id
	 *
	 * @return \ATDev\Commweb\RequestAbstract
	 */
	public function setMerchant($merchant) {

		if ( substr($merchant, 0, 4) == "TEST" ) {

			$this->setTestMode(true);
			$this->merchant = substr($merchant, 4, strlen($merchant) - 4);
		} else {

			$this->setTestMode(false);
			$this->merchant = $merchant;
		}

		return $this;
	}

	/**
	 * Gets merchant id
	 *
	 * @return string
	 */
	public function getMerchant() {

		return ($this->testMode) ? ("TEST" . $this->merchant) : $this->merchant;
	}

	/**
	 * Set api password
	 *
	 * @param string $password
	 *
	 * @return \ATDev\Commweb\RequestAbstract
	 */
	public function setApiPassword($password) {

		$this->password = $password;

		return $this;
	}

	/**
	 * Sets test mode
	 *
	 * @param bool $testMode
	 *
	 * @return \ATDev\Commweb\RequestAbstract
	 */
	public function setTestMode($testMode) {

		$this->testMode = $testMode;

		return $this;
	}

	/**
	 * Gets test mode
	 *
	 * @return bool
	 */
	public function getTestMode() {

		return $this->testMode;
	}

	/**
	 * Sends request to api
	 *
	 * @return \ATDev\Commweb\RequestAbstract
	 */
	public function send() {

		$client = new \GuzzleHttp\Client();
		$res = $client->request(
			$this->method,
			$this->getApiUrl(),
			[
				"auth" => [$this->getApiUsername(), $this->getApiPassword()],
				"json" => $this,
				"timeout" => 60,
				"connect_timeout" => 60,
				"exceptions" => false
			]
		);

		$code = $res->getStatusCode();
		$body = $res->getBody()->getContents();

		if ( $code != 200 ) {

			$this->error = $body;
		} else {

			$this->error = null;
		}

		return $this;
	}

	/**
	 * Gets error
	 *
	 * @return string
	 */
	public function getError() {

		return $this->error;
	}

	/**
	 * Gets user name for the api
	 *
	 * @return string
	 */
	public function getApiUsername() {

		return "merchant." . $this->getMerchant();
	}

	/**
	 * Gets password for the api
	 *
	 * @return string
	 */
	public function getApiPassword() {

		return $this->password;
	}

	/**
	 * Gets full api url for the request
	 *
	 * @return string
	 */
	private function getApiUrl() {

		$url = $this->url;

		if ( ! empty($this->version) ) {
			$url = $url . "version/" . $this->version . "/";
		}

		if ( ! empty($this->merchant) ) {
			$url = $url . "merchant/" . $this->getMerchant() . "/";
		}

		if ( ! empty($this->order) ) {
			$url = $url . "order/" . $this->order->getId() . "/";
		}

		if ( ! empty($this->transaction) ) {
			$url = $url . "transaction/" . $this->transaction->getId() . "/";
		}

		return $url;
	}
}