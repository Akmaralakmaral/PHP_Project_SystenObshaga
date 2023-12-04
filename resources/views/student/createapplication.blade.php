<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Application') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('applications.store') }}" enctype="multipart/form-data">
                    @csrf



                    <!-- Добавьте свои поля формы здесь -->
                    <div class="mb-4">
                        <label for="fio" class="block text-sm font-medium text-gray-700">ФИО</label>
                        <input type="text" name="fio" id="fio" class="mt-1 p-2 border rounded-md w-full" required />
                    </div>

                    <div class="mb-4">
                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Дата Рождения</label>
                        <input type="date" name="birth_date" id="birth_date" class="mt-1 p-2 border rounded-md w-full" required />
                    </div>

                    <div class="mb-4">
                        <label for="nationality" class="block text-sm font-medium text-gray-700">Национальность</label>
                        <input type="text" name="nationality" id="nationality" class="mt-1 p-2 border rounded-md w-full" required />
                    </div>

                    <div class="mb-4">
                        <label for="gender" class="block text-sm font-medium text-gray-700">Пол</label>
                        <select name="gender" id="gender" class="mt-1 p-2 border rounded-md w-full" required>
                            <option value="male">Мужской</option>
                            <option value="female">Женский</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="passport_id" class="block text-sm font-medium text-gray-700">ID_паспорт</label>
                        <input type="text" name="passport_id" id="passport_id" class="mt-1 p-2 border rounded-md w-full" required />
                    </div>

                     <div class="mb-4">
                        <label for="issuing_authority" class="block text-sm font-medium text-gray-700">Орган выдачи</label>
                        <input type="text" name="issuing_authority" id="issuing_authority
                        " class="mt-1 p-2 border rounded-md w-full" required />
                    </div>

                    <div class="mb-4">
                        <label for="iin" class="block text-sm font-medium text-gray-700">ИНН</label>
                        <input type="text" name="iin" id="iin
                        " class="mt-1 p-2 border rounded-md w-full" required />
                    </div>

                    <div class="mb-4">
                        <label for="statement_photo" class="block text-sm font-medium text-gray-700">Заявление</label>
                        <input type="file" name="statement_photo" id="statement_photo" accept="image/*" required />
                    </div>

                    <div class="mb-4">
                        <label for="education_work_certificate" class="block text-sm font-medium text-gray-700">Справка с места учебы или работы</label>
                        <input type="file" name="education_work_certificate" id="education_work_certificate" accept="image/*,application/pdf" required />
                    </div>

                    <div class="mb-4">
                        <label for="photo_3_4" class="block text-sm font-medium text-gray-700">Фото 3x4</label>
                        <input type="file" name="photo_3_4" id="photo_3_4" accept="image/*" required />
                    </div>

                    <div class="mb-4">
                        <label for="payment_receipt" class="block text-sm font-medium text-gray-700">Квитанция об оплате</label>
                        <input type="file" name="payment_receipt" id="payment_receipt" accept="image/*" required />
                    </div>

                    <div class="mb-4">
                        <label for="medical_certificate" class="block text-sm font-medium text-gray-700">Медицинская справка</label>
                        <input type="file" name="medical_certificate" id="medical_certificate" accept="image/*" required />
                    </div>

                    <div class="mb-4">
                        <label for="fluorography" class="block text-sm font-medium text-gray-700">Флюорография</label>
                        <input type="file" name="fluorography" id="fluorography" accept="image/*" required />
                    </div>

                    <div class="mb-4">
                        <label for="residence_address" class="block text-sm font-medium text-gray-700">Адрес Проживания</label>
                        <textarea name="residence_address" id="residence_address" class="mt-1 p-2 border rounded-md w-full" required></textarea>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-4">
                            {{ __('Send Application') }}
                        </x-primary-button>
                    </div>

                </form>
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
