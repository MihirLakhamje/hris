<x-layout>
  <x-slot:title>
    Leave requests - HRIS
  </x-slot:title>

  <x-slot:header>
    Employees leave requests
  </x-slot:header>

  <div class="flex space-x-2 items-center mb-4">
    <a href="/employees/create"
      class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
      Request Leave
    </a>
  </div>
  <x-data-table>
    <x-slot:column>
      <th scope="col" class="px-6 py-3">
        Employee Code
      </th>
      <th scope="col" class="px-6 py-3">
        Leave Type
      </th>
      <th scope="col" class="px-6 py-3">
        Start Date
      </th>
      <th scope="col" class="px-6 py-3">
        End Date
      </th>
      <th scope="col" class="px-6 py-3">
        Reason
      </th>
      <th scope="col" class="px-6 py-3">
        No. of days
      </th>
      <th scope="col" class="px-6 py-3">
        Status
      </th>
      <th scope="col" class="px-6 py-3">
        Action
      </th>
    </x-slot:column>

    @foreach ($leaves as $leave)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-nowrap">
      <td class="px-6 py-4"> {{ $leave->employee->employee_code ?? '' }} </td>
      <td class="px-6 py-4"> {{ $leave->leave_type }} </td>
      <td class="px-6 py-4">
      {{ date('d-m-Y', strtotime($leave->start_date)) }}
      </td>
      <td class="px-6 py-4 ">
      {{ date('d-m-Y', strtotime($leave->end_date)) }}
      </td>
      <td class="px-6 py-4"> {{ $leave->reason }} </td>
      <td class="px-6 py-4"> {{ $leave->number_of_days }} </td>
      <td class="px-6 py-4"> {{ $leave->status }} </td>
      <td class="px-6 py-4">
      <div class="flex space-x-2 items-center">
        <x-link :typeoflink="'link'" href="/leaves/{{ $leave->id }}/edit"
        class="text-green-600 dark:text-green-500">
        Submit Response
        </x-link>

        <span class="mx-1">|</span>
        <form action="/leaves/{{ $leave->id }}" method="post">
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
    {{ $leaves->links('vendor.pagination.simple-tailwind') }}
  </div>

  
</x-layout>