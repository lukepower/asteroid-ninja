<div
    class="ml-4 text-center text-sm text-white dark:text-gray-400 sm:text-left sm:ml-0 border border-gray-200 rounded-lg p-8 mt-5">
    <h2 class="text-2xl font-bold text-white dark:text-white">Search Observations by Obscode</h2>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <div class="mt-8 max-w-md">
        <form method="POST" action="{{ route('mpc.search-by-obscode') }}">
            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
            <div class="grid grid-cols-1 gap-6">

                <select data-te-select-init data-te-select-filter="true" name="obscode">
                    @foreach ($obscodes as $obscode)
                        <option value='{{ $obscode->code }}'>{{ $obscode->code }} ({{ $obscode->name }})</option>
                    @endforeach
                </select>
                <label data-te-select-label-ref>Observatory Code</label>

                <div date-rangepicker class="flex items-center">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input name="date_start" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date start (optional)">
                    </div>
                    <span class="mx-4 text-gray-500">to</span>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input name="end" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date end">
                    </div>
                </div>
                <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                    <input id="bordered-checkbox-1" type="checkbox" value="neocp" name="type_neocp"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="bordered-checkbox-1"
                        class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NEOCP
                        Observations</label>
                </div>
                <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                    <input checked id="bordered-checkbox-2" type="checkbox" value="normal" name="type_normal"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="bordered-checkbox-2"
                        class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Normal
                        Observations</label>
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-blue-800">Get
                    observations</button>


            </div>
        </form>
    </div>

</div>
