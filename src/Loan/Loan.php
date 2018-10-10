<?php
declare(strict_types=1);

namespace Payment\Loan;

class Loan
{
	private $loanId;
	private $loanStartDate;
	private $lastPaymentDate;
	private $commission;
	private $dailyInterestRate;
	private $loanAmount;

	public function __construct(
		int $year,
		int $month,
		int $day,
		float $commission,
		float $dailyInterestRate,
		int $loanAmount,
		int $loanId
	) {
		$this->loanId = $loanId;
		$this->loanStartDate = $this->setDate($year, $month, $day);
		$this->lastPaymentDate = $this->loanStartDate;
		$this->commission = $commission;
		$this->dailyInterestRate = $dailyInterestRate;
		$this->loanAmount= $loanAmount;
	}

	public function getLoanId() : int
	{
		return $this->loanId;
	}

	public function getLastPaymentDate() : string
	{
		return $this->lastPaymentDate;
	}

	public function setLastPaymentDate(string $lastPaymentDate)
	{
		$this->lastPaymentDate = $lastPaymentDate;
	}

	public function getCommission() : float
	{
		return $this->commission;
	}

	public function setCommission(float $commission)
	{
		$this->commission = $commission;
	}

	public function getDailyInterestRate() : float
	{
		return $this->dailyInterestRate;
	}

	public function getLoanAmount() : float
	{
		return $this->loanAmount;
	}

	public function setLoanAmount(float $loanAmount)
	{
		$this->loanAmount = $loanAmount;
	}

	public function setDate($year, $month, $day)
	{
		$date = new \DateTime();
		$date->setDate($year, $month, $day);
		return $date->format('Y-m-d');
	}

	public function getLoanStartDate()
	{
		return $this->loanStartDate;
	}
}