<?php
declare(strict_types=1);

namespace Payment\Customer;

use Payment\Loan\Loan;

class Customer
{
	private $id;
	private $customerName;
	private $customerSurname;
	private $loans;

	public function __construct()
	{
		$this->id = 0;
		$this->customerName = 'Jacek';
		$this->customerSurname = 'Placek';
		$this->loans = [];
	}

	public function getId() : int
	{
		return $this->id;
	}

	public function setId(int $id)
	{
		$this->id = $id;
	}

	public function getCustomerName() : string
	{
		return $this->customerName;
	}

	public function setCustomerName(string $customerName)
	{
		$this->customerName = $customerName;
	}

	public function getCustomerSurname() : string
	{
		return $this->customerSurname;
	}

	public function setCustomerSurname(string $customerSurname)
	{
		$this->customerSurname = $customerSurname;
	}

	public function getLoans() : array
	{
		return $this->loans;
	}

	public function setLoan(Loan $loan)
	{
		$this->loans[$loan->getLoanId()] = $loan;
	}

	public function getLoan($loanId) : Loan
	{
		return $this->loans[$loanId];
	}
}
