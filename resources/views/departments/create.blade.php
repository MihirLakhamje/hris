<x-layout>
  <x-slot:title>
    Create Employee - HRIS
  </x-slot:title>

  <x-slot:header>
    Create Employee
  </x-slot:header>

  <div class="flex space-x-2 items-center mb-4">
    <x-link :typeoflink="'link'" href="/departments" class="text-blue-600 dark:text-blue-500">
      Back
    </x-link>
  </div>
  
  <form method="POST" action="/departments/store">
    @csrf
    <x-form-layout>
      <div>
        <x-form-label for="name">Name</x-form-label>
        <x-form-input type="text" id="name" name="name" required />
        <x-form-error name="name" />
      </div>
    </x-form-layout>
    <button type="submit"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
  </form>
</x-layout>
