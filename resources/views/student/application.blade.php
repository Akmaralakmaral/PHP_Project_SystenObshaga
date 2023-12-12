<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
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



                        <div class="form-group">
                            <label for="fio">Full Name:</label>
                            <input type="text" name="fio" required>
                        </div>

                        <div class="form-group">
                            <label for="birth_date">Birth Date:</label>
                            <input type="date" name="birth_date" required>
                        </div>

                        <div class="form-group">
                            <label for="nationality"> Nationality: </label>
                            <input type="text" name="nationality" required>
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select name="gender" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="passport_id">Passport ID:</label>
                            <input type="text" name="passport_id" required>
                        </div>

                        <div class="form-group">
                            <label for="issuing_authority">Issuing Authority:</label>
                            <input type="text" name="issuing_authority" required>
                        </div>

                        <div class="form-group">
                            <label for="inn">IIN (Individual Identification Number):</label>
                            <input type="text" name="inn" required>
                        </div>

                         <div class="form-group">
                            <label for="stat_ph_path_img">Statement Photo:</label>
                            <input type="file" name="stat_ph_path_img" required>
                            <input type="text" name="description_stat_ph" placeholder="Description for Statement Photo">
                        </div>

                        <div class="form-group">
                            <label for="edu_w_cert_path_img">Education Work Certificate Photo:</label>
                            <input type="file" name="edu_w_cert_path_img" required>
                            <input type="text" name="description_edu_w_cert" placeholder="Description for Education Work Certificate Photo">
                        </div>

                        <div class="form-group">
                            <label for="ph_3_4_path_img">3x4 Photo:</label>
                            <input type="file" name="ph_3_4_path_img" required>
                            <input type="text" name="description_ph_3_4" placeholder="Description for 3x4 Photo">
                        </div>

                        <div class="form-group">
                            <label for="pay_rec_path_img">Payment Receipt Photo:</label>
                            <input type="file" name="pay_rec_path_img" required>
                            <input type="text" name="description_pay_rec" placeholder="Description for Payment Receipt Photo">
                        </div>

                        <div class="form-group">
                            <label for="med_cert_path_img">Medical Certificate Photo:</label>
                            <input type="file" name="med_cert_path_img" required>
                            <input type="text" name="description_med_cert" placeholder="Description for Medical Certificate Photo">
                        </div>

                        <div class="form-group">
                            <label for="fluor_path_img">Fluorography Photo:</label>
                            <input type="file" name="fluor_path_img" required>
                            <input type="text" name="description_fluor" placeholder="Description for Fluorography Photo">
                        </div>

                        <div class="form-group">
                            <label for="residence_address">Residence Address:</label>
                            <input type="text" name="residence_address" required>
                        </div>


                        <button class="btn btn-default" type="submit">Send Application</button>
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
