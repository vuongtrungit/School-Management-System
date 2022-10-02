<div class="mt-8 min-h-screen">
    @livewire('livewire-toast')
    <div class="flex justify-between">
        <div class="text-2xl">Students</div>
    </div>
    @if (session()->has('danger'))
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
        {{ session('danger') }}
    </div>
@endif
            
    <div class="grid grid-cols-2 gap-8">
        <div class="mt-4">

            <x-tall-crud-label>Old Class</x-tall-crud-label>
            <x-tall-crud-select class="block mt-1 w-full" wire:model="old_class">
                <option value="">Please Select</option>
                @foreach($class as $c)
                <option value="{{$c->id}}">{{$c->class_name}}</option>
                @endforeach
            </x-tall-crud-select>
            @error('old_class') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
        </div>
        <div class="mt-4">
            <x-tall-crud-label>Old Section</x-tall-crud-label>
            <x-tall-crud-select class="block mt-1 w-full" wire:model="old_section">
                <option value="">Please Select</option>
                <option value="{{App\Enums\ClassSectionEnum::A->value}}">A</option>
                <option value="{{App\Enums\ClassSectionEnum::B->value}}">B</option>
            </x-tall-crud-select>
            @error('old_section') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
        </div>
    </div>
  
    <div class="mt-6">
        <div class="flex justify-around">
            <div class="flex">
                <x-tall-crud-input-search />
            </div>
            <div x-data="{ dropdown: false }" class=" mr-auto ml-3 flex">
                <div class="w-36 items-center flex bg-primary justify-between text-gray-100 rounded transition duration-150">
                    <button class="flex-1 h-full hover:bg-primary-dark border-r rounded-l">Bulk Action</button>
                    <button @click="dropdown = !dropdown" class="h-full hover:bg-primary-dark rounded-r px-1" :class=" dropdown ? 'bg-primary-dark' : ''">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-0 transition duration-200" :class=" dropdown ? 'rotate-180 transition duration-200' : 'rotate-0 transition duration-200'" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div x-show="dropdown" x-transition="" @click.away="dropdown = false" class="absolute bg-white border border-gray-300 text-gray-700 mt-9 py-2 z-10" style="display: none;">
                    <div class="flex flex-col">
                        <a @click="dropdown = false"  class="hover:bg-gray-100 py-1 px-4" wire:click="graduateStudents">
                          Graduate Student
                        </a>
                        <a @click="dropdown = false" href="#" class="hover:bg-gray-100 py-1 px-4">
                            Revoke Promotion
                        </a>
                        <a @click="dropdown = false" href="#" class="hover:bg-gray-100 py-1 px-4">
                            Something else here
                        </a>
                    </div>
                    <hr class="my-2">
                    <div class="flex flex-col">
                        <a @click="dropdown = false" href="#" class="hover:bg-gray-100 py-1 px-4">
                            Separated link
                        </a>
                    </div>
                </div>
                <span class="ml-2 my-auto">Selected {{ count($selectedRows) }} {{ Str::plural('student', count($selectedRows)) }}</span>
            </div>
            <div class="flex">

                <x-tall-crud-page-dropdown />
            </div>
        </div>
        <table class="w-full my-8 whitespace-nowrap" wire:loading.class.delay="opacity-50">
            <thead class="bg-secondary text-gray-100 font-bold">
                <td class="px-2 py-3 capitalize" >
                    <input type="checkbox" name="checkbox_checked" id="checkbox_checked" class="ml-2 focus:ring-0"  wire:model="selectedAllRows">
                    </td>
                <td class="px-2 py-2" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('id')">Id</button>
                        <x-tall-crud-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-2 py-2" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('user_id')">Name</button>
                        <x-tall-crud-sort-icon sortField="user_id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-2 py-2" >Admission </td>
                <td class="px-2 py-2" >Parent </td>
                <td class="px-2 py-2" >Class</td>
                <td class="px-2 py-2" >Gender</td>
                <td class="px-2 py-2" >Section</td>
                <td class="px-2 py-2" >Status</td>
            </thead>
            <tbody class="divide-y divide-blue-400">
            @foreach($results as $result)
                <tr class="hover:bg-blue-300 {{ ($loop->even ) ? "bg-blue-100" : ""}}">
                    <td class="px-2 py-3 capitalize" >
                        <input type="checkbox" name="checkbox_checked" id="{{ $result->id }}" value="{{ $result->id }}" class="ml-2 focus:ring-0"  wire:model="selectedRows" >
                        </td>
                    <td class="px-2 py-3 capitalize" >{{ $loop->iteration }}</td>
                    <td class="px-2 py-3 capitalize" >{{ $result->user->name }}</td>
                    <td class="px-2 py-3 capitalize" >{{ $result->admission_no }}</td>
                    <td class="px-2 py-3 capitalize" >{{ $result->parent->user->name }}</td>
                    <td class="px-2 py-3 capitalize" >{{$result->class->class_name }}</td>
                    <td class="px-2 py-3 capitalize" >{{ $result->gender }}</td>
                    <td class="px-2 py-3 capitalize" >{{ $result->section }}</td>
                    <td class="px-2 py-3 capitalize" >{{ $result->Status }}</td>
               </tr>
            @endforeach
            
            </tbody>
        </table>


    </div>

    <div class="mt-4">
        {{ $results->links() }}
    </div>
</div>