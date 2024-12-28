<x-layout>
  <x-slot:title>
    Departments - HRIS
  </x-slot:title>

  <x-slot:header>
    Departments
  </x-slot:header>

  <div class="flex space-x-2 items-center mb-4">
    <a href="/departments/create"
      class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
      Create department
    </a>
  </div>

  <x-data-table>
    <x-slot:column>
      <th scope="col" class="px-6 py-3">
        Department Name
      </th>
      <th scope="col" class="px-6 py-3">
        No. of employees
      </th>
      <th scope="col" class="px-6 py-3">
        Created At
      </th>
      <th scope="col" class="px-6 py-3">
        Action
      </th>
    </x-slot:column>

    @foreach ($departments as $department)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-nowrap">
      <td class="px-6 py-4"> {{ $department->name }} </td>
      <td class="px-6 py-4"> {{ $department->employees->count() }} </td>
      <td class="px-6 py-4"> {{ date('d-m-Y', strtotime($department->created_at)) }} </td>
      <td class="px-6 py-4">
        <div class="flex space-x-2 items-center">
          <x-link :typeoflink="'link'" href="/departments/{{ $department->id }}/" class="text-blue-600 dark:text-blue-500">
            View
          </x-link>
          <span class="mx-1">|</span>
          <x-link :typeoflink="'link'" href="/departments/{{ $department->id }}/edit"
          class="text-green-600 dark:text-green-500">
            Edit
          </x-link>
          <span class="mx-1">|</span>
          <form action="/departments/{{ $department->id }}" method="post">
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
    {{ $departments->links('vendor.pagination.simple-tailwind') }}
  </div>
</x-layout>