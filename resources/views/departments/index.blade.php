<x-layout>
  <x-slot:title>
    Employees - HRIS
  </x-slot:title>

  <x-slot:header>
    Employees
  </x-slot:header>

  <x-data-table>
    <x-slot:column>
      <th scope="col" class="px-6 py-3">
        Employee Code
      </th>
      <th scope="col" class="px-6 py-3">
        Name
      </th>
      <th scope="col" class="px-6 py-3">
        Email
      </th>
      <th scope="col" class="px-6 py-3">
        Joining Date
      </th>
      <th scope="col" class="px-6 py-3">
        Action
      </th>
    </x-slot:column>

    @foreach ($employees as $employee)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-nowrap">
      <td class="px-6 py-4"> {{ $employee->employee_code }} </td>
      <td class="px-6 py-4"> {{ $employee->user->name }} </td>
      <td class="px-6 py-4"> {{ $employee->user->email }} </td>
      <td class="px-6 py-4 ">
        {{ date('d-m-Y', strtotime($employee->joining_date)) }}
      </td>
      <td class="px-6 py-4">
        <div class="flex space-x-2 items-center mb-4">
          <x-link :typeoflink="'link'" href="/employees/{{ $employee->id }}/" class="text-blue-600 dark:text-blue-500">
            View
          </x-link>
          <span class="mx-1">|</span>
          <x-link :typeoflink="'link'" href="/employees/{{ $employee->id }}/edit"
          class="text-green-600 dark:text-green-500">
            Edit
          </x-link>
          <span class="mx-1">|</span>
          <form action="/employees/{{ $employee->id }}" method="post">
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
    {{ $employees->links('vendor.pagination.simple-tailwind') }}
  </div>
</x-layout>