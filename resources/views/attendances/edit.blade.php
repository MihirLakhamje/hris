<x-layout>
  <x-slot:title>
    Edit attendance - HRIS
  </x-slot:title>

  <x-slot:header>
    Edit Attendance
  </x-slot:header>

  <div class="flex space-x-2 items-center mb-4">
    <x-link :typeoflink="'link'" href="/employees/{{ $employee_id }}" class="text-blue-600 dark:text-blue-500">
      Back
    </x-link>
  </div>

  <form method="POST" action="/attendances/1/update">
    @csrf
    @method('PATCH')
    <x-form-layout class="grid gap-6 mb-6 grid-cols-1 md:grid-cols-2">

      <div>
        <x-form-label for="mark_date">Date</x-form-label>
        <x-form-input disabled type="text" id="mark_date" name="mark_date" placeholder="John"
          value="{{ $attendance->mark_date }}" class="cursor-not-allowed bg-gray-300" />
      </div>

      <div>
        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
          status</label>
        <select id="status" name="status" value="{{ $attendance->status }}"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option selected>Choose an status</option>
          <option value="present">Present</option>
          <option value="absent">Absent</option>
          <option value="leave">Leave</option>
        </select>
        <x-form-error name="status" />
      </div>
    </x-form-layout>
    <button type="submit"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
  </form>


</x-layout>