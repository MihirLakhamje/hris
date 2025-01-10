<x-layout>
  <x-slot:title>
    Edit Leave - HRIS
  </x-slot:title>

  <x-slot:header>
    Edit Leave
  </x-slot:header>

  <div class="flex space-x-2 items-center mb-4">
    <x-link :typeoflink="'link'" href="/leaves" class="text-blue-600 dark:text-blue-500">
      Back
    </x-link>
  </div>

  <form method="POST" action="/payrolls/{{ $payroll->id }}/store">
    @csrf
    @method('PATCH')
    <x-form-layout class="grid gap-6 mb-6 grid-cols-1 md:grid-cols-2">
    <div>
        <x-form-label for="name">Employee Name</x-form-label>
        <x-form-input disabled type="text" id="name" name="name" placeholder="John" value="{{ $payroll->employee->user->name }}"
        class="cursor-not-allowed bg-gray-300"
           />
      </div>

      <div class="relative">
        <x-form-label for="payroll_date">Payroll Date</x-form-label>
        <div class="absolute inset-y-0 top-6 start-0 flex items-center ps-3.5 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
          </svg>
        </div>
        <x-form-input class="ps-10" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" type="text" id="payroll_date"
          name="payroll_date" value="{{ date('d-m-Y', strtotime($payroll->payroll_date))}}" required />
      </div>
      <div>
        <x-form-label for="basic_salary">Basic Salary</x-form-label>
        <x-form-input type="text" id="basic_salary" name="basic_salary" value="{{ $payroll->basic_salary }}" required />
        <x-form-error name="basic_salary" />
      </div>
      <div>
        <x-form-label for="deduction">Deduction</x-form-label>
        <x-form-input type="text" id="deduction" name="deduction" value="{{ $payroll->deduction }}" required />
        <x-form-error name="deduction" />
      </div>
      <div>
        <x-form-label for="allowance">Allowance</x-form-label>
        <x-form-input type="text" id="allowance" name="allowance" value="{{ $payroll->allowance }}" required />
        <x-form-error name="allowance" />
      </div>
      <div>
        <x-form-label for="bonus">Bonus</x-form-label>
        <x-form-input type="text" id="bonus" name="bonus" value="{{ $payroll->bonus }}" required />
        <x-form-error name="bonus" />
      </div>
      
    </x-form-layout>
    <button type="submit"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
  </form>


</x-layout>