<x-layout>
  <x-slot:title>
    user register
  </x-slot:title>

  <form method="POST" action="/register" class="flex flex-col justify-center items-center">
    @csrf
    <x-auth-form>
    <h5 class="text-xl font-medium text-gray-900 dark:text-white">Create an account</h5>
      <div>
        <x-form-label for="name">Name</x-form-label>
        <x-form-input type="text" id="name" name="name" required />
        <x-form-error name="name" />
      </div>
      <div>
        <x-form-label for="email">Email</x-form-label>
        <x-form-input type="email" id="email" name="email" required />
        <x-form-error name="email" />
      </div>
      <div>
        <x-form-label for="password">Password</x-form-label>
        <x-form-input type="password" id="password" name="password" required />
        <x-form-error name="password" />
      </div>
      <div>
        <x-form-label for="password_confirmation">Confirm password</x-form-label>
        <x-form-input name="password_confirmation" type="password" id="password_confirmation" />
        <x-form-error name="password_confirmation" />
      </div>
      <button type="submit"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Continue</button>
      <div class="flex">
        <span class="text-nowrap">Already have an account?</span>
        <x-link href="/login" :typeoflink="'link'">Login</x-link>
      </div>
    </x-auth-form>

  </form>
</x-layout>