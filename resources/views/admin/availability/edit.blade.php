@extends('admin.layouts.app')

@section('admin_content')

    <div class="py-12 px-10 pt-72" >

       <div class="bg-white p-16">
           @if (session()->has('message'))
               <div x-data="{ open: true }" x-show="open" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                   <strong class="font-bold">Success!</strong>
                   <span class="block sm:inline">{{ session('message') }}</span>
                   <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg x-on:click="open = false" class="fill-current h-6 w-6 text-green-500 cursor-pointer" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M13.414 6l5.293-5.293a1 1 0 1 0-1.414-1.414L12 4.586 6.707-.707a1 1 0 0 0-1.414 1.414L10.586 6l-5.293 5.293a1 1 0 1 0 1.414 1.414L12 7.414l5.293 5.293a1 1 0 0 0 1.414-1.414L13.414 6z"/>
                                </svg>
                            </span>
               </div>
           @endif
           <h1 class="text-2xl pb-3 pt-3">Edit Availability</h1>
           <form action="{{ route('availability.update') }}" method="post">
               @csrf
               <div id="dynamic_field">
               <div class="grid gap-6 mb-6 md:grid-cols-5" id="">
                   <div>
                       <input type="hidden" name="id" value="{{ $availability->id }}">
                       <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                       <select id="countries" name="day" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                           <option selected>Choose a day</option>
                           <option {{ $availability->day == 'Monday' ?  'selected' : '' }} value="Monday">Monday</option>
                           <option {{ $availability->day == 'Tuesday' ?  'selected' : '' }} value="Tuesday">Tuesday</option>
                           <option {{ $availability->day == 'Wednesday' ?  'selected' : '' }} value="Wednesday">Wednesday</option>
                           <option {{ $availability->day == 'Thursday' ?  'selected' : '' }} value="Thursday">Thursday</option>
                           <option  {{ $availability->day == 'Friday' ?  'selected' : '' }} value="Friday">Friday</option>
                           <option {{ $availability->day == 'Saturday' ?  'selected' : '' }} value="Saturday">Saturday</option>
                           <option {{ $availability->day == 'Sunday' ?  'selected' : '' }} value="Sunday">Sunday</option>
                       </select>
                       @error('day') <span class="text-red-700">{{ $message }}</span> @enderror

                   </div>
                   <div>
                       <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                       <input type="date" name="date" id="date" value="{{ $availability->date }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required>
                       @error('date') <span class="text-red-700">{{ $message }}</span> @enderror

                   </div>
                   <div>
                       <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Time</label>
                       <input type="time" name="start_time" value="{{ $availability->start_time }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required>
                       @error('start_time') <span class="text-red-700">{{ $message }}</span> @enderror

                   </div>
                   <div>
                       <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Time</label>
                       <input type="time" name="end_time" value="{{ $availability->end_time }}"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required>
                       @error('end_time') <span class="text-red-700">{{ $message }}</span> @enderror

                   </div>
                   <div>
                       <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slots Duration</label>
                       <input type="number" name="duration"  value="{{ $availability->duration }}"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="in mints" required>
                       @error('duration') <span class="text-red-700">{{ $message }}</span> @enderror

                   </div>
               </div>
               </div>
               <a href="{{ route('availability.index') }}" class="text-black border-2 bg-transparent hover:text-[white] hover:border-none hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Back</a>

               <div class="text-end">
                   <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
               </div>
           </form>
       </div>

    </div>
@endsection
