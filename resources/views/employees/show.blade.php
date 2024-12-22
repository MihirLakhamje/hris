<x-layout>
  <x-slot:title>
    {{$employee->user->name}} - HRIS
  </x-slot:title>

  <x-slot:header>
    Employees details
  </x-slot:header>

  <div class="flex space-x-2 items-center mb-4">
    <x-link :typeoflink="'link'" href="/employees" class="text-blue-600 dark:text-blue-500">
      Back
    </x-link>
    <span class="text-gray-800 dark:text-white">|</span>
    <x-link :typeoflink="'link'" href="/employees/{{ $employee->id }}/edit" class="text-green-600 dark:text-green-500">
      Edit
    </x-link>
    <span class="text-gray-800 dark:text-white">|</span>
    <x-link :typeoflink="'link'" href="/attendances/{{ $employee->id }}/create"
      class="text-gray-600 dark:text-gray-500">
      Mark Attendance
    </x-link>
    <span class="text-gray-800 dark:text-white">|</span>
    <form action="/employees/{{ $employee->id }}" method="post">
      @csrf
      @method('DELETE')
      <x-link :typeoflink="'button'" onclick="return confirm('Are you sure? This action cannot be undone.')"
        class="text-red-600 dark:text-red-500">
        Delete
      </x-link>
    </form>
  </div>

  <section class=" bg-white rounded-lg dark:bg-gray-800 flex flex-row-reverse justify-between flex-wrap gap-4 ">
    <div class="m-auto sm:m-0">
      <img class="rounded-full w-32 h-32 self-end" src="{{ $employee->photo }}" alt="{{ $employee->user->name }}" />
    </div>
    <div>
      <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
        {{ $employee->user->name }}
      </h2>
      <div class="font-normal text-gray-700 dark:text-gray-400 flex flex-col gap-2">
        <p>
          <span class="font-semibold">
            Employee Code:
          </span>
          {{ $employee->employee_code }}
        </p>
        <p>
          <span class="font-semibold">
            Email:
          </span>
          {{ $employee->user->email }}
        </p>
        <p>
          <span class="font-semibold">
            Joining Date:
          </span>
          {{ $employee->joining_date }}
        </p>
        <p>
          <span class="font-semibold">
            Address:
          </span>
          {{ $employee->address }}
        </p>
      </div>
    </div>
  </section>
  <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700" />
  <section>
    <x-data-table>
      <x-slot:column>
        <th scope="col" class="px-6 py-3">
          Date
        </th>
        <th scope="col" class="px-6 py-3">
          Status
        </th>
        <th scope="col" class="px-6 py-3">
          Action
        </th>
      </x-slot:column>

      @foreach ($attendances as $attendance)
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-nowrap">
      <td class="px-6 py-4"> {{ date('d-m-Y', strtotime($attendance->mark_date)) }} </td>
      <td class="px-6 py-4"> {{ $attendance->status }} </td>
      <td class="px-6 py-4">
        <div class="flex space-x-2 items-center mb-4">
        <x-link :typeoflink="'link'" href="/attendances/{{ $attendance->id }}/edit"
          class="text-green-600 dark:text-green-500">
          Edit
        </x-link>
        <span class="mx-1">|</span>
        <form action="/attendances/{{ $attendance->id }}" method="post">
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
      {{ $attendances->links() }}
    </div>
    @if (session()->has('success'))
      <x-toast :variant="'green'">
        {{ session('success') }}
      </x-toast>
    @elseif (session()->has('error'))
    <x-toast :variant="'red'">
      {{ session('error') }}
    </x-toast>
    @endif
  </section>
</x-layout>