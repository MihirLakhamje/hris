
<x-layout>
  <x-slot:title>
    Mark Attendance - HRIS
  </x-slot:title>

  <x-slot:header>
    Attendance Marking
  </x-slot:header>

  <div class="flex space-x-2 items-center mb-4">
    <x-link :typeoflink="'link'" href="/employees" class="text-blue-600 dark:text-blue-500">
      Back
    </x-link>
  </div>


  <form method="POST" action="/attendances/{{ $employee->id }}/store">
    @csrf
    <x-form-layout class="grid gap-6 mb-6 grid-cols-1 md:grid-cols-2">

      <div class="relative">
        <x-form-label for="mark_date">Mark Date</x-form-label>
        <div class="absolute inset-y-0 top-6 start-0 flex items-center ps-3.5 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
          </svg>
        </div>
        <x-form-input class="ps-10" datepicker datepicker-buttons datepicker-autoselect-today datepicker
          datepicker-format="dd-mm-yyyy" type="text" id="mark_date" value="{{ $mark_date }}" name="mark_date"
          readonly />
      </div>

      <div>
        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
          status</label>
        <select id="status" name="status"
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

  @if(session()->has('error'))
  <div class="textt-red-500">
    <x-toast>
      {{ session('error') }}
    </x-toast>
  </div>
    @endif


</x-layout>