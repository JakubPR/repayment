<?php
require "../vendor/autoload.php";

use Payment\Customer\Customer;
use Payment\Loan\Loan;
use Payment\Loan\LoanRepayment;

$customer = new Customer();

$loan1 = new Loan(2018,10,10, 466.65, 0.45, -1700, 1);
$loan1->getDailyInterestRate();

$customer->setLoan($loan1);
var_dump($customer);

$repayment = new LoanRepayment(1000, 2018, 10, 13,1, $customer);
var_dump($customer);
