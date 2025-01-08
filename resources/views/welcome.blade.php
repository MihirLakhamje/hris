<x-layout>
    <x-slot:title>Welcome to HRIS</x-slot:title>
    <x-slot:header>Hello, {{ auth()->user()->name ?? '' }} 👋</x-slot:header>
    

    @can('role-admin')
    

    @elsecan('role-employee', [auth()->user()->employee ?? null])
    <section class=" bg-white rounded-lg dark:bg-gray-800 flex flex-row-reverse justify-between flex-wrap gap-4 ">
    <div class="m-auto sm:m-0">
      <img class="rounded-full w-32 h-32 self-end" src="{{ $employee->photo }}" alt="{{ $employee->user->name }}" />
    </div>
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
    @else

    @endcan


  
</x-layout>