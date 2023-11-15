<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                     <h3>Users List:</h3>
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
                                        <th class="px-4 py-2">Email</th>
                                        <th class="px-4 py-2">User Role</th>
                                        <th class="px-4 py-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $user->name }}</td>
                                            <td class="border px-4 py-2">{{ $user->email }}</td>
                                            <td class="border px-4 py-2">
                                                <!-- Форма обновления роли пользователя -->
                                                <form method="POST" action="{{ route('users.updateRole', $user) }}">
                                                    @csrf
                                                    @method('PATCH')

                                                    <div class="form-group">
                                                        <select name="role" id="role" class="form-control">
                                                            <option value="student" @if($user->user_role == 'student') selected @endif>Student</option>
                                                            <option value="admin" @if($user->user_role == 'admin') selected @endif>Admin</option>
                                                            <option value="employee" @if($user->user_role == 'employee') selected @endif>Employee</option>
                                                            <option value="commandant" @if($user->user_role == 'commandant') selected @endif>Commandant</option>
                                                        </select>
                                                    </div>

                                                    <!-- Кнопка "Сохранить" -->
                                                    <button type="submit" class="btn btn-primary">
                                                        Save
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="border px-4 py-2">
                                                <!-- Форма удаления пользователя -->
                                                <form method="POST" action="{{ route('users.destroy_user', $user) }}">
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
                        </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Добавьте эту функцию для обновления роли пользователя
    function updateUserRole(userId) {
        var newRole = document.getElementById('user_role_' + userId).value;

        axios.post('/updateUserRole', {
            userId: userId,
            newRole: newRole
        })
        .then(function (response) {
            console.log(response.data);
            // Если нужно, выполните дополнительные действия после успешного обновления роли
        })
        .catch(function (error) {
            console.error('Произошла ошибка при обновлении роли:', error);
        });
    }
</script>


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