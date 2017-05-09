<?php namespace ATDev\Commweb;

abstract class ProcessRequestAbstract extends RequestAbstract {

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

class CaptureRequest extends ProcessRequestAbstract {

	protected $apiOperation = 'CAPTURE';
}

class RefundRequest extends ProcessRequestAbstract {

	protected $apiOperation = 'REFUND';
}

class VoidRequest extends ProcessRequestAbstract {

	protected $apiOperation = 'VOID';
}