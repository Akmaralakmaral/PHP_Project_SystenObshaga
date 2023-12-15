<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Rooms') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h2 class="text-2xl font-bold mt-4 mb-2">Room List</h2>

                        <!-- Filter dropdown -->
                        <form action="{{ route('commandant.rooms') }}" method="GET" class="mb-4">
                            <label for="filterGender" class="mr-2 font-bold">Filter by Gender:</label>
                            <select name="filterGender" id="filterGender" onchange="this.form.submit()">
                                <option value="">All</option>
                                <option value="male" {{ request('filterGender') === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ request('filterGender') === 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </form>

                        <form action="{{ route('commandant.rooms') }}" method="GET" class="mb-4">
                            <label for="filterObshaga" class="mr-2 font-bold">Filter by Obshaga:</label>
                            <select name="filterObshaga" id="filterObshaga" onchange="this.form.submit()">
                                <option value="">All</option>
                                @foreach($obshagas as $obshaga)
                                    <option value="{{ $obshaga->id }}" {{ request('filterObshaga') == $obshaga->id ? 'selected' : '' }}>
                                        {{ $obshaga->name_obshaga }}
                                    </option>
                                @endforeach
                            </select>
                        </form>

                        <form action="{{ route('commandant.rooms') }}" method="GET" class="mb-4">
                            <label for="filterStatus" class="mr-2 font-bold">Filter by Room Status:</label>
                            <select name="filterStatus" id="filterStatus" onchange="this.form.submit()">
                                <option value="">All</option>
                                <option value="Busy" {{ request('filterStatus') === 'Busy' ? 'selected' : '' }}>Busy</option>
                                <option value="Free" {{ request('filterStatus') === 'Free' ? 'selected' : '' }}>Free</option>
                                <option value="1 bed available" {{ request('filterStatus') === '1 bed available' ? 'selected' : '' }}>1 bed available</option>
                                <option value="2 free berths" {{ request('filterStatus') === '2 free berths' ? 'selected' : '' }}>2 free berths</option>
                                <option value="3 beds available" {{ request('filterStatus') === '3 beds available' ? 'selected':'' }}>3 beds available</option>
                            </select>
                        </form>


                        @if($rooms->isEmpty())
                            <p class="text-red-500 font-bold">No rooms available.</p>
                        @else
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Room Number
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Room Gender
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Obshaga
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Room Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($rooms as $room)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $room->room_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $room->roomGender }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $room->obshaga->name_obshaga }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $room->room_status->status_rooms }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('passes', ['room_id' => $room->id]) }}" class="text-blue-500">View Passes</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        @endif

                </div>
            </div>
        </div>
    </div>





    <script>
    var idleTimeout = 900000; // 15 минут в миллисекундах
    var idleTimer = null;

    // Функция сброса таймера неактивности
    function resetIdleTimer() {
        clearTimeout(idleTimer);
        idleTimer = setTimeout(logoutUser, idleTimeout);
    }

    // Функция для выхода пользователя
   function logoutUser() {

    // alert("Вы будете перенаправлены на страницу авторизации.");
    var confirmLogout = confirm("Вы будете перенаправлены на страницу авторизации. Хотите продолжить?");

    if (confirmLogout) {
    axios.post('/logout') // Замените '/logout' на URL вашего маршрута выхода
        .then(function (response) {
            // После успешного выхода перенаправляем на страницу авторизации
            window.location.href = '/login'; // Замените '/login' на URL вашей страницы авторизации
        })
        .catch(function (error) {
            console.error('Произошла ошибка при выходе:', error);
        });
    }
}
    // Начните сброс таймера при каждом действии пользователя
    document.addEventListener('mousemove', resetIdleTimer);
    document.addEventListener('keydown', resetIdleTimer);

    // Инициализация таймера
    resetIdleTimer();
    </script>


</x-app-layout>
