<?php
declare(strict_types=1);

namespace Payment\Loan;

use Payment\Customer\Customer;

class LoanRepayment
{
	private $repaymentAmount;
	private $repaymentDate;
	private $customer;
	private $loan;

	function __construct(
		int $repaymentAmount,
		int $year,
		int $month,
		int $day,
		int $loanId,
		Customer $customer
	) {
		$this->repaymentAmount = $repaymentAmount;
		$this->repaymentDate = $this->setDate($year, $month, $day);
		$this->customer = $customer;

		$loan = $this->checkIfLoanIdExist($loanId);
		$this->loan = $loan;

		$this->settleCapitalInterest();
		$this->settleCommission();
		$this->settleCapital();
	}

	public function checkIfLoanIdExist(int $loanId) : Loan
	{
		if (!$this->customer->getLoan($loanId))
		{
			echo 'Bad loan Id';
		}
		return $this->customer->getLoan($loanId);
	}

	public function settleCapitalInterest()
	{
		$this->repaymentAmount = $this->repaymentAmount - $this->countAmountOfInterest();
		$this->loan->setLastPaymentDate($this->repaymentDate);
	}

	public function settleCommission()
	{
		$this->repaymentAmount = $this->repaymentAmount - $this->loan->getCommission();
		$this->loan->setCommission(0);
	}

	public function settleCapital()
	{
		$this->loan->setLoanAmount($this->loan->getLoanAmount() + $this->repaymentAmount);
	}

	public function countAmountOfInterest()
	{
		return $this->loan->getDailyInterestRate() * $this->countInterestDays();
	}

	public function countInterestDays()
	{
		return intval(
			round((strtotime($this->repaymentDate) - strtotime($this->loan->getLastPaymentDate()))/ (60 * 60 * 24))
		);
	}

	public function countLoanAfterRepayment()
	{
		$loanAfterOperations = $this->loan->getLoanAmount() + $this->repaymentAmount;
		return $loanAfterOperations;
	}

	public function setDate(int $year, int $month, int $day) : string
	{
		$date = new \DateTime();
		$date->setDate($year, $month, $day);
		return $date->format('Y-m-d');
	}
}