<x-layout>
  <x-slot:title>Welcome to HRIS</x-slot:title>
  <x-slot:header>Hello, {{ auth()->user()->name ?? '' }} 👋</x-slot:header>


  @can('role-admin')
  <div class="grid gap-4 grid-cols-2 lg:grid-cols-4">
    <div class="max-w-sm p-6 bg-blue-50 gap-1  rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col">
      <div class="flex items-center gap-5">
        <h5 class="text-5xl font-semibold tracking-tight text-gray-900 dark:text-white ">
          {{$no_of_employees}}
        </h5>
        <svg class="w-10 h-10 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
          width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
          <path fill-rule="evenodd"
          d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"
          clip-rule="evenodd" />
        </svg>
        </div>
        <p class="font-normal text-gray-500 dark:text-gray-400">Employees</p>
    </div>

    <div class="max-w-sm p-6 bg-green-50 gap-1  rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col">
      <div class="flex items-center gap-5">
        <h5 class="text-5xl font-semibold tracking-tight text-gray-900 dark:text-white ">
          {{$no_of_departments}}
        </h5>
        <svg class="w-10 h-10 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
          width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
          <path fill-rule="evenodd"
          d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
          clip-rule="evenodd" />
        </svg>
        </div>
      <p class="font-normal text-gray-500 dark:text-gray-400">Departments</p>
    </div>

    <div class="max-w-sm p-6 bg-orange-50 gap-1  rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col">
      <div class="flex items-center gap-5">
        <h5 class="text-5xl font-semibold tracking-tight text-gray-900 dark:text-white ">
          {{$no_of_leaves}}
        </h5>
        <svg class="w-10 h-10 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
          width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
          <path fill-rule="evenodd"
          d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
          clip-rule="evenodd" />
        </svg>
        </div>
      <p class="font-normal text-gray-500 dark:text-gray-400">Pending leaves</p>
    </div>

    <div class="max-w-sm p-6 bg-yellow-50 gap-1  rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col">
      <div class="flex items-center gap-5">
        <h5 class="text-5xl font-semibold tracking-tight text-gray-900 dark:text-white ">
          {{numberToReadable($no_of_payrolls)}}
        </h5>
        <svg class="w-10 h-10 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
          width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
          <path fill-rule="evenodd" d="M7 6a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2h-2v-4a3 3 0 0 0-3-3H7V6Z"
          clip-rule="evenodd" />
          <path fill-rule="evenodd"
          d="M2 11a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-7Zm7.5 1a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5Z"
          clip-rule="evenodd" />
          <path d="M10.5 14.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" />
        </svg>
      </div>
      <p class="font-normal text-gray-500 dark:text-gray-400">Payroll amount</p>
    </div>
  </div>

  <div class="mt-4">
    <x-data-table>
      <x-slot:column>
        <th scope="col" class="px-6 py-3">
          Name
        </th>
        <th scope="col" class="px-6 py-3">
          Email
        </th>
        <th scope="col" class="px-6 py-3">
          Creation Date
        </th>
      </x-slot:column>

      @foreach ($users as $user)
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-nowrap">
        <td class="px-6 py-4"> {{ ucfirst($user->name)}} </td>
        <td class="px-6 py-4"> {{ $user->email }} </td>
        <td class="px-6 py-4"> {{ date('d-m-Y', strtotime($user->created_at)) }} </td>
      </tr>
      @endforeach
    </x-data-table>
    <div class="mt-4">
      {{ $users->links('vendor.pagination.simple-tailwind') }}
    </div>
  </div>
  
  @endcan
</x-layout>