<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Application') }}
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



   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2>Create Application</h2>

                    <form action="{{ route('application.upload') }}" method="post" enctype="multipart/form-data" >
                        {{csrf_field()}}


                        <div class="mb-4">
                            <label for="fio" class="block text-sm font-medium text-gray-700">Full Name:</label>
                            <input type="text" name="fio" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="birth_date" class="block text-sm font-medium text-gray-700">Birth Date:</label>
                            <input type="date" name="birth_date" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="nationality" class="block text-sm font-medium text-gray-700"> Nationality: </label>
                            <input type="text" name="nationality" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                       <div class="mb-4">
                            <label for="gender" class="block text-sm font-medium text-gray-700">Gender:</label>
                            <select name="gender" class="mt-1 p-2 border rounded-md w-full" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>


                        <div class="mb-4">
                            <label for="passport_id"class="block text-sm font-medium text-gray-700">Passport ID:</label>
                            <input type="text" name="passport_id" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="issuing_authority" class="block text-sm font-medium text-gray-700">Issuing Authority:</label>
                            <input type="text" name="issuing_authority" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="inn" class="block text-sm font-medium text-gray-700" >IIN (Individual Identification Number):</label>
                            <input type="text" name="inn" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="stat_ph_path_img" class="block text-sm font-medium text-gray-700">Statement Photo:</label>
                            <input type="file" name="stat_ph_path_img" required>
                        </div>

                       <div class="mb-4">
                            <label for="edu_w_cert_path_img" class="block text-sm font-medium text-gray-700">Education Work Certificate Photo:</label>
                            <input type="file" name="edu_w_cert_path_img" required>
                        </div>

                        <div class="mb-4">
                            <label for="ph_3_4_path_img" class="block text-sm font-medium text-gray-700">3x4 Photo:</label>
                            <input type="file" name="ph_3_4_path_img" required>
                        </div>

                        <div class="mb-4">
                            <label for="pay_rec_path_img" class="block text-sm font-medium text-gray-700">Payment Receipt Photo:</label>
                            <input type="file" name="pay_rec_path_img" required>
                        </div>

                        <div class="mb-4">
                            <label for="med_cert_path_img" class="block text-sm font-medium text-gray-700">Medical Certificate Photo:</label>
                            <input type="file" name="med_cert_path_img" required>
                        </div>

                        <div class="mb-4">
                            <label for="fluor_path_img" class="block text-sm font-medium text-gray-700">Fluorography Photo:</label>
                            <input type="file" name="fluor_path_img" required>
                        </div>

                        <div class="mb-4">
                            <label for="residence_address" class="block text-sm font-medium text-gray-700">Residence Address:</label>
                            <textarea type="text" name="residence_address" class="mt-1 p-2 border rounded-md w-full" required></textarea>
                        </div>


                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Send Application') }}</x-primary-button>
                        </div>




                    </form>


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
