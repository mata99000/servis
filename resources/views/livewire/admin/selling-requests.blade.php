<div>
    @section('admin-pages')
    <div id="main" class="main-content w-full min-h-screen flex-grow bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
        <!-- Naslov -->
        <div class="w-full bg-gray-800 pt-3">
            <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                <h1 class="font-bold pl-2">Selling Requests</h1>
            </div>
        </div>
    
        <!-- Table Container -->
        <div class="w-full p-1">
            <div class="bg-white overflow-hidden shadow-md rounded my-6">
                <table class="w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($devices as $device)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $device->brand }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $device->model }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $device->expected_price }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @foreach ($device->images as $image)
                                    <img src="" alt="Device Image" class="w-8 h-8 rounded-full"> <!-- Pretpostavljamo da imate metod getUrl() ili slično za dohvatanje URL-a slike -->
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    
    </div>
    @endsection
    </div>
    