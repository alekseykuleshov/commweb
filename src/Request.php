<?php namespace ATDev\Commweb;

abstract class RequestAbstract implements \JsonSerializable {

	private $method = 'PUT';
	private $version = 34;
	private $url = "https://paymentgateway.commbank.com.au/api/rest/";

	private $merchant;
	private $password;
	private $testMode = false;

	protected $apiOperation;

	protected $order;
	protected $transaction;

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
	 * Sets request method
	 *
	 * @param string $method
	 *
	 * @return \ATDev\Commweb\RequestAbstract
	 */
	public function setMethod($method) {

		$this->method = $method;

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

		if (substr($merchant, 0, 4) == "TEST") {

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
				"json" => $this
			]
		);

		return $this;
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
		$url = $url . "version/" . $this->version . "/";
		$url = $url . "merchant/" . $this->getMerchant() . "/";
		$url = $url . "order/" . $this->order->getId() . "/";
		$url = $url . "transaction/" . $this->transaction->getId() . "/";

		return $url;
	}
}