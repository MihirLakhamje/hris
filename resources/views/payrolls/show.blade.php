<x-layout>
  <x-slot:title>
    Payroll | {{ ucfirst($employee->user->name) ?? '' }} - HRIS
  </x-slot:title>

  <x-slot:header>
    {{ ucfirst($employee->user->name) ?? '' }}'s Payroll 
  </x-slot:header>

  <x-data-table>
    <x-slot:column>
      <th scope="col" class="px-6 py-3">
        Payroll Date
      </th>
      <th scope="col" class="px-6 py-3">
        Basic Salary
      </th>
      <th scope="col" class="px-6 py-3">
        Gross Salary
      </th>
      <th scope="col" class="px-6 py-3">
        Net Salary
      </th>
      <th scope="col" class="px-6 py-3">
        Allowance
      </th>
      <th scope="col" class="px-6 py-3">
        Deduction
      </th>
      <th scope="col" class="px-6 py-3">
        Bonus
      </th>
    </x-slot:column>

    @foreach ($payrolls as $payroll)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-nowrap">
      <td class="px-6 py-4"> {{ date('d-m-Y', strtotime($payroll->payroll_date)) }} </td>
      <td class="px-6 py-4"> ₹ {{ $payroll->basic_salary }} </td>
      <td class="px-6 py-4"> ₹ {{ $payroll->gross_salary }} </td>
      <td class="px-6 py-4"> ₹ {{ $payroll->net_salary }} </td>
      <td class="px-6 py-4"> ₹ {{ $payroll->allowance }} </td>
      <td class="px-6 py-4"> ₹ {{ $payroll->deduction }} </td>
      <td class="px-6 py-4"> ₹ {{ $payroll->bonus }} </td>
    </tr>
  @endforeach
  </x-data-table>

  <div class="mt-4">
    {{ $payrolls->links('vendor.pagination.simple-tailwind') }}
  </div>

  
</x-layout>