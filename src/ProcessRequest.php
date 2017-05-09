<?php namespace ATDev\Commweb;

abstract class ProcessRequestAbstract extends RequestAbstract {

	private $oldTransaction;

	public function setOldTransaction(Transaction $oldTransaction) {

		$this->oldTransaction = $oldTransaction;

		return $this;
	}

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