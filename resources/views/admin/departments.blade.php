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
