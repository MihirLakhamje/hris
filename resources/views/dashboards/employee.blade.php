<x-layout>
  <x-slot:title>Welcome to HRIS</x-slot:title>
  <x-slot:header>Hello, {{ auth()->user()->name ?? '' }} 👋</x-slot:header>

  <div class="flex flex-col items-center justify-center">
    <p class="text-gray-400 text-lg text-center">{{ $message ?? '' }}</p>
  </div>

  @if(isset($employee))
    <section class=" bg-white rounded-lg dark:bg-gray-800 flex justify-between flex-wrap gap-4 ">
    <div>
      <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
      {{ ucfirst($employee->user->name) }}
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
        Email:
        </span>
        {{ $employee->user->email }}
      </p>
      <p>
        <span class="font-semibold">
        Joining Date:
        </span>
        {{ $employee->joining_date }}
      </p>
      <p>
        <span class="font-semibold">
        Address:
        </span>
        {{ $employee->address }}
      </p>
      <p>
        <span class="font-semibold">
        Leave request:
        </span>
        {{ $no_of_leaves_left }} out of {{ $leaves_limit }} requests used
      </p>
      </div>
    </div>
    </section>
  @endif


</x-layout>