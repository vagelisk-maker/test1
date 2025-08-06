<?php

namespace App\Repositories;

use App\Models\SalaryGroupEmployee;

class SalaryGroupEmployeeRepository
{
    public function assignEmployeeToSalaryGroup($salaryGroupDetail,$validatedEmployeeData)
    {
        return $salaryGroupDetail->groupEmployees()->createMany($validatedEmployeeData);
    }

    public function updateSalaryGroupEmployee($salaryGroupDetail,$validatedEmployeeData)
    {
       $this->removeAssignedEmployeeFromSalaryGroup($salaryGroupDetail);
       return $salaryGroupDetail->groupEmployees()->createMany($validatedEmployeeData);

    }

    public function removeAssignedEmployeeFromSalaryGroup($salaryGroupDetail)
    {
        return $salaryGroupDetail->groupEmployees()->delete();
    }

    public function getSalaryGroupFromEmployeeId($employeeId)
    {
        return SalaryGroupEmployee::where('employee_id',$employeeId)->first();
    }

}
