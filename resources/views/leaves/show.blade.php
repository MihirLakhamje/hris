<x-layout>
  <x-slot:title>
    Leave details - HRIS
  </x-slot:title>

  <x-slot:header>
    Leave details
  </x-slot:header>

  <div class="flex space-x-2 items-center mb-4">
    <x-link :typeoflink="'link'" href="/leaves" class="text-blue-600 dark:text-blue-500">
      Back
    </x-link>
    <span class="text-gray-800 dark:text-white">|</span>
    <x-link :typeoflink="'link'" href="/leaves/{{ $leave->id }}/edit" class="text-green-600 dark:text-green-500">
      Edit
    </x-link>
    <span class="text-gray-800 dark:text-white">|</span>
    <form action="/leaves/{{ $leave->id }}" method="post">
      @csrf
      @method('DELETE')
      <x-link :typeoflink="'button'" onclick="return confirm('Are you sure? This action cannot be undone.')"
        class="text-red-600 dark:text-red-500">
        Delete
      </x-link>
    </form>
  </div>

  <section class=" bg-white rounded-lg dark:bg-gray-800 flex flex-row-reverse justify-between flex-wrap gap-4 ">
    <div>
      <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
        {{ $employee->user->name }}
      </h2>
      <div class="font-normal text-gray-700 dark:text-gray-400 flex flex-col gap-2">
        <p>
          <span class="font-semibold">
            Employee Code:
          </span>
          {{ $employee->employee_code }}
        </p>
        <p>
          <span class="font-semibold">
            Department name:
          </span>
          {{ $employee->department->name }}
        </p>
        <p>
          <span class="font-semibold">
            Start Date:
          </span>
          {{ $leave->start_date }}
        </p>
        <p>
          <span class="font-semibold">
            End Date:
          </span>
          {{ $leave->end_date }}
        </p>
        <p>
          <span class="font-semibold">
            Reason:
          </span>
          {{ $leave->reason }}
        </p>
        <p>
          <span class="font-semibold">
            Status:
          </span>
          {{ $leave->status }}
        </p>
      </div>
    </div>
  </section>
  @if (session()->has('success'))
    <x-toast :variant="'green'">
    {{ session('success') }}
    </x-toast>
  @elseif (session()->has('error'))
    <x-toast :variant="'red'">
    {{ session('error') }}
    </x-toast>
  @endif
  </section>
</x-layout>