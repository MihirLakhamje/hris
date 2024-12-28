<x-layout>
  <x-slot:title>
    Create Employee - HRIS
  </x-slot:title>

  <x-slot:header>
    Create Employee
  </x-slot:header>

  <div class="flex space-x-2 items-center mb-4">
    <x-link :typeoflink="'link'" href="/employees" class="text-blue-600 dark:text-blue-500">
      Back
    </x-link>
  </div>

  <form method="POST" action="/leaves/{{ $employee->id }}/store">
    @csrf
    <x-form-layout class="grid gap-6 mb-6 grid-cols-1 md:grid-cols-2">
      <div class="flex items-center">
        <div class="relative max-w-sm flex-grow">
          <div class="absolute inset-y-12 start-0 flex items-center ps-3.5 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
            </svg>
          </div>
          <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Starting date</label>
          <input datepicker id="start_date" type="text" name="start_date"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Select date">
        </div>

        <span class="mx-4 mt-7 text-gray-500">to</span>


        <div class="relative max-w-sm flex-grow">
          <div class="absolute inset-y-12 start-0 flex items-center ps-3.5 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
            </svg>
          </div>
          <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Ending date
          </label>
          <input datepicker id="end_date" type="text" name="end_date"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Select date">
        </div>

      </div>

      <div>
        <label for="leave_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Leave Type</label>
        <select id="leave_type" name="leave_type"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option selected>Choose Leave Type</option>
          <option value="annual">Annual</option>
          <option value="sick">Sick</option>
          <option value="maternity">Maternity</option>
          <option value="paternity">Paternity</option>
        </select>
        <x-form-error name="leave_type" />
      </div>
      <div>
        <label for="reasom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a reason</label>
        <select id="reasom" name="reason"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option selected>Choose an reason</option>
          <option value="family emergency">Family emergency</option>
          <option value="medical check-up">Medical check-up</option>
          <option value="personal time off">Personal time off</option>
          <option value="vacation">Vacation</option>
          <option value="bereavement leave">Bereavement leave</option>
          <option value="education or exams">Education or exams</option>
          <option value="religious observance">Religious observance</option>
          <option value="mental health day">Mental health day</option>
          <option value="jury duty or legal obligations">Jury duty or legal obligations</option>
          <option value="other reason">Other reason</option>
        </select>
        <x-form-error name="reason" />
      </div>
    </x-form-layout>
    <button type="submit"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
  </form>

  @if (session()->has('error'))
    <x-toast :variant="'red'">
      {{ session('error') }}
    </x-toast>
  @elseif (session()->has('success'))
    <x-toast :variant="'green'">
      {{ session('success') }}
    </x-toast>
  @endif
</x-layout>