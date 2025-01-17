<x-layout>
  <x-slot:title>
    Payrolls - HRIS
  </x-slot:title>

  <x-slot:header>
    Payrolls
  </x-slot:header>

  <div class="flex space-x-2 items-center mb-4">
    <a href="/payrolls/create"
      class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
      Create Payroll
    </a>
  </div>
  <x-data-table>
    <x-slot:column>
      <th scope="col" class="px-6 py-3">
        Employee Name
      </th>
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
      <th scope="col" class="px-6 py-3">
        Action
      </th>
    </x-slot:column>

    @foreach ($payrolls as $payroll)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-nowrap">
      <td class="px-6 py-4"> {{ $payroll->employee->user->name ?? '' }} </td>
      <td class="px-6 py-4"> {{ date('d-m-Y', strtotime($payroll->payroll_date)) }} </td>
      <td class="px-6 py-4"> ₹ {{ $payroll->basic_salary }} </td>
      <td class="px-6 py-4"> ₹ {{ $payroll->gross_salary }} </td>
      <td class="px-6 py-4"> ₹ {{ $payroll->net_salary }} </td>
      <td class="px-6 py-4"> ₹ {{ $payroll->allowance }} </td>
      <td class="px-6 py-4"> ₹ {{ $payroll->deduction }} </td>
      <td class="px-6 py-4"> ₹ {{ $payroll->bonus }} </td>
      <td class="px-6 py-4">
      <div class="flex space-x-2 items-center">
        <x-link :typeoflink="'link'" href="/payrolls/{{ $payroll->id }}/edit"
        class="text-green-600 dark:text-green-500">
        Edit
        </x-link>

        <span class="mx-1">|</span>
        <form action="/payrolls/{{ $payroll->id }}" method="post">
        @csrf
        @method('DELETE')
        <x-link :typeoflink="'button'" onclick="return confirm('Are you sure? This action cannot be undone.')"
          class="text-red-600 dark:text-red-500">
          Delete
        </x-link>
        </form>
      </div>
      </td>
    </tr>
  @endforeach
  </x-data-table>

  <div class="mt-4">
    {{ $payrolls->links('vendor.pagination.simple-tailwind') }}
  </div>

  
</x-layout>