<?php
declare(strict_types=1);

use Payment\Loan\Loan;
use Payment\Customer\Customer;
use Payment\Loan\LoanRepayment;
use PHPUnit\Framework\TestCase;

class LoanRepaymentTestTest extends TestCase
{
	private $customer;
	private $loan;

	protected function setUp()
	{
		$this->customer = new Customer();
		$this->loan = new Loan(2018,10,10, 466.65, 0.45, -1700, 1);
		$this->customer->setLoan($this->loan);
	}

	public function testRepaymentSuccess()
	{
		$customer = $this->customer;
		new LoanRepayment(1000, 2018, 10, 13,1, $customer);
		/* @var $customer Customer */
		$loan = $customer->getLoan(1);
		$this->assertEquals(-1168, $loan->getLoanAmount());
	}
}
