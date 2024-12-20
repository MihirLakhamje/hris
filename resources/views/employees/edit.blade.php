<x-layout>
  <x-slot:title>
    {{$employee->user->name}} - HRIS
  </x-slot:title>

  <x-slot:header>
    Edit Employee
  </x-slot:header>

  <div class="flex space-x-2 items-center mb-4">
    <x-link :typeoflink="'link'" href="/employees" class="text-blue-600 dark:text-blue-500">
      Back
    </x-link>
  </div>


  <form method="POST" action="/employees/{{ $employee->id }}">
    @csrf
    @method('PATCH')
    <x-form-layout class="grid gap-6 mb-6 grid-cols-1 md:grid-cols-2">
      <div>
        <x-form-label for="name">Employee Name</x-form-label>
        <x-form-input disabled type="text" id="name" name="name" placeholder="John" value="{{ $employee->user->name }}"
        class="cursor-not-allowed bg-gray-300"
           />
      </div>
      <div>
        <x-form-label for="name">Employee Email</x-form-label>
        <x-form-input disabled type="email" id="email" name="email" placeholder="John" value="{{ $employee->user->email }}" 
          class="cursor-not-allowed bg-gray-300"
        />
        <x-form-error name="email"/>
      </div>
      <div>
        <x-form-label for="employee_code">Employee Code</x-form-label>
        <x-form-input type="text" id="employee_code" name="employee_code" placeholder="John"
          value="{{ $employee->employee_code }}"/>
      </div>
      <div class="relative">
        <x-form-label for="joining_date">Joining Date</x-form-label>
        <div class="absolute inset-y-0 top-6 start-0 flex items-center ps-3.5 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
          </svg>
        </div>
        <x-form-input class="ps-10" datepicker datepicker-format="dd-mm-yyyy" type="text" id="joining_date" name="joining_date"
          value="{{ date('d-m-Y', strtotime($employee->joining_date)) }}" required />
        </div>
      <div>
        <x-form-label for="address">Address</x-form-label>
        <x-form-input type="text" id="address" name="address" value="{{ $employee->address }}" required />
        <x-form-error name="address" />
      </div>
    </x-form-layout>
    <button type="submit"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
  </form>


</x-layout>