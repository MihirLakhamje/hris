<x-layout>
  <x-slot:title>
    attendance details - HRIS
  </x-slot:title>

  <x-slot:header>
    Attendance details
  </x-slot:header>

  <x-data-table>
      <x-slot:column>
        <th scope="col" class="px-6 py-3">
          Date
        </th>
        <th scope="col" class="px-6 py-3">
          Status
        </th>
        @can('role-admin')
        <th scope="col" class="px-6 py-3">
          Action
        </th>
        @endcan
      </x-slot:column>

      @foreach ($attendances as $attendance)
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-nowrap">
      <td class="px-6 py-4"> {{ date('d-m-Y', strtotime($attendance->mark_date)) }} </td>
      <td class="px-6 py-4"> {{ $attendance->status }} </td>
      @can('role-admin')
      <td class="px-6 py-4">
        <div class="flex space-x-2 items-center">
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
      @endcan
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
</x-layout>