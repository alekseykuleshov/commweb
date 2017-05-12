<?php namespace ATDev\Commweb;

/**
 * An abstract class to process existing transactions
 */
abstract class ProcessRequestAbstract extends RequestAbstract {

	/** @var \ATDev\Commweb\Transaction Old transaction data */
	private $oldTransaction;

	/**
	 * Sets old transaction for request to process
	 *
	 * @param \ATDev\Commweb\Transaction $oldTransaction
	 *
	 * @return \ATDev\Commweb\ProcessRequestAbstract
	 */
	public function setOldTransaction(Transaction $oldTransaction) {

		$this->oldTransaction = $oldTransaction;

		return $this;
	}

	/**
	 * Specifies what has to be returned on serialization to json
	 *
	 * @return array Data to serialize
	 */
	public function jsonSerialize() {

		return [
			"apiOperation" => $this->apiOperation,
			"transaction" => $this->oldTransaction
		];
	}
}

/**
 * Class to capture the transaction
 */
class CaptureRequest extends ProcessRequestAbstract {

	protected $apiOperation = 'CAPTURE';
}

/**
 * Class to refund the transaction
 */
class RefundRequest extends ProcessRequestAbstract {

	protected $apiOperation = 'REFUND';
}

/**
 * Class to void the transaction
 */
class VoidRequest extends ProcessRequestAbstract {

	protected $apiOperation = 'VOID';
}

/**
 * Class to update autorization transaction
 */
class UpdateAutorizationRequest extends ProcessRequestAbstract {

	protected $apiOperation = 'UPDATE_AUTHORIZATION';
}