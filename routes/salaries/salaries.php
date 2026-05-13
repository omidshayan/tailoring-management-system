<?php
require_once 'Http/Controllers/salaries/Salary.php';

// salary routes
uri('add-salary', 'App\Salary', 'addSalary');
uri('salaries', 'App\Salary', 'salaries');
uri('salary-store', 'App\Salary', 'salaryStore', 'POST');
uri('salary-details/{id}', 'App\Salary', 'salaryDetails');
uri('edit-salary/{id}', 'App\Salary', 'editSalary');
uri('edit-salary-store/{id}', 'App\Salary', 'editSalaryStore', 'POST');
uri('change-status-salary/{id}', 'App\Salary', 'changeStatusSalary');
