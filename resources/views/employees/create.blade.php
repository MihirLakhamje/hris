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

  <form method="POST" action="/employees/store">
    @csrf
    <x-form-layout class="grid gap-6 mb-6 grid-cols-1 md:grid-cols-2">
      <div>
        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an User</label>
        <select id="user_id"name="user_id"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option selected>Choose an User</option>
          @foreach ($users as $user)
            <option value="{{$user->id}}">{{$user->name}} - {{$user->email}}</option>
          @endforeach
        </select>
        <x-form-error name="user_id"/>
      </div>
      <div>
        <label for="department_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an Department</label>
        <select id="department_id" name="department_id"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option selected>Choose a Department</option>
          @foreach ($departments as $department)
            <option value="{{$department->id}}">{{$department->name}} {{$department->id}}</option>
          @endforeach
        </select>

        <x-form-error name="department_id"/>
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
        <x-form-input class="ps-10" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" type="text" id="joining_date"
          name="joining_date" required />
      </div>
      <div>
        <x-form-label for="phone">Phone</x-form-label>
        <x-form-input type="text" id="phone" name="phone" value="8104323255" required />
        <x-form-error name="phone" />
      </div>
      <div>
        <x-form-label for="salary">Salary</x-form-label>
        <x-form-input type="text" id="salary" name="salary" value="10000" required />
        <x-form-error name="salary" />
      </div>
      <div>
        <x-form-label for="address">Address</x-form-label>
        <x-form-input type="text" id="address" name="address" value="Kathmandu" required />
        <x-form-error name="address" />
      </div>
      <div>
        <x-form-label for="photo">photo</x-form-label>
        <x-form-input type="text" id="photo" name="photo" value="sun.png" required />
        <x-form-error name="photo" />
      </div>
      <div>
        <x-form-label for="employee_code">code</x-form-label>
        <x-form-input type="text" id="employee_code" name="employee_code" value="{{ $random }}" required />
        <x-form-error name="employee_code" />
      </div>
    </x-form-layout>
    <button type="submit"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
  </form>
</x-layout>
