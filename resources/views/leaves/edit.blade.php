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

  <div class="mb-4">
    <p><span class="font-semibold ">Employee Name: </span> {{ $leave->employee->user->name ?? '' }}</p>
    <p><span class="font-semibold ">Date: </span>{{ $leave->start_date ?? '' }} to {{ $leave->end_date ?? '' }}</p>
    <p><span class="font-semibold ">Leave Type: </span>{{ $leave->leave_type ?? '' }}</p>
    <p><span class="font-semibold ">Reason: </span>{{ $leave->reason ?? '' }}</p>
  </div>


  <form method="POST" action="/leaves/{{ $leave->id }}/update">
    @csrf
    @method('PATCH')
    <x-form-layout class="grid gap-6 mb-6 grid-cols-1 md:grid-cols-2">

      <div>
        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
        <select id="status" name="status"value="{{ $leave->status }}"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option selected value="pending">Pending</option>
          <option value="approved">Approved</option>
          <option value="rejected">Rejected</option>
        </select>
        <x-form-error name="status" />
      </div>
      
    </x-form-layout>
    <button type="submit"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
  </form>


</x-layout>