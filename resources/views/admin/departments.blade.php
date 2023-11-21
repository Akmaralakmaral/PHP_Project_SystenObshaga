<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Departments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <h3>Departments List:</h3>
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
                                    @foreach ($departments as $department)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $department->department_name }}</td></td>
                                            <td class="border px-4 py-2">

                                                <form method="POST" action="{{ route('departments.update', $department) }}">
                                                    @csrf
                                                    @method('PATCH')

                                                    <div class="mb-3">
                                                        <label for="department_name" class="form-label">Department Name:</label>
                                                        <input type="text" class="form-control" id="department_name" name="department_name" value="{{ $department->department_name }}" required>
                                                    </div>

                                                     <div class="mb-3">
                                                        <label for="faculty_id" class="form-label">Select Faculty:</label>
                                                        <select name="faculty_id" required>
                                                            @foreach($faculties as $faculty)
                                                                <option value="{{ $faculty->id }}">{{ $faculty->name_faculty }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </form>
                                            </td>
                                            <td class="border px-4 py-2">
                                                <form method="POST" action="{{ route('departments.destroy_department', $department) }}">
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
                            <!-- Department Form -->
                            <form method="post" action="{{ route('departments.create') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="department_name" class="form-label">Department Name:</label>
                                    <input type="text" class="form-control" id="department_name" name="department_name" required>

                                </div>

                                 <div class="mb-3">
                                    <label for="faculty_id" class="form-label">Select Faculty:</label>
                                    <select name="faculty_id" required>
                                        @foreach($faculties as $faculty)
                                            <option value="{{ $faculty->id }}">{{ $faculty->name_faculty }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Department</button>
                            </form>


                        </ul>
                </div>
            </div>
        </div>
    </div>
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
