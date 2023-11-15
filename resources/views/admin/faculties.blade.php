<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Faculties') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3>Faculties List:</h3>
                   @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                        <ul>
                            <table class="table-auto">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">Name</th>
                                        <th class="px-4 py-2">Update</th>
                                        <th class="px-4 py-2">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faculties as $faculty)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $faculty->name_faculty }}</td>
                                            <td class="border px-4 py-2">
                                                <!-- Форма обновления факультета -->
                                                <form method="POST" action="{{ route('faculties.update', $faculty) }}">
                                                    @csrf
                                                    @method('PATCH')

                                                    <div class="mb-3">
                                                        <label for="name_faculty" class="form-label">Faculty Name:</label>
                                                        <input type="text" class="form-control" id="name_faculty" name="name_faculty" value="{{ $faculty->name_faculty }}" required>
                                                    </div>

                                                    <!-- Кнопка "Сохранить" -->
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </form>
                                            </td>
                                            <td class="border px-4 py-2">
                                                <!-- Форма удаления пользователя -->
                                                <form method="POST" action="{{ route('faculties.destroy_faculty', $faculty) }}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <!-- Кнопка "Удалить" -->
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>


                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Faculty Form -->
                            <form method="post" action="{{ route('faculties.create') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name_faculty" class="form-label">Faculty Name:</label>
                                    <input type="text" class="form-control" id="name_faculty" name="name_faculty" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Faculty</button>
                            </form>


                        </ul>
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
