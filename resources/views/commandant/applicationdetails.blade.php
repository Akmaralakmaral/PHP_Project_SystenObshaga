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


     <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Application Details') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2>{{ $application->fio }}'s Application Details</h2>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Field
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Value
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Birth Date
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $application->birth_date }}
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Nationality
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $application->nationality }}
                                </td>
                            </tr>
                           <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Gender
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $application->gender }}
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Passport ID
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $application->passport_id }}
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Issuing Authority
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $application->issuing_authority }}
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    IIN
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $application->iin }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Statement Photo
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $application->statement_photo_path) }}" alt="Statement Photo">
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Education Work Certificate Path
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $application->education_work_certificate_path) }}" alt="Education Work Certificate Photo">
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Photo 3x4 Path
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $application->photo_3_4_path) }}" alt="Photo 3x4">
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Payment Receipt Path
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $application->payment_receipt_path) }}" alt="Payment Receipt">
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Medical Certificate Path
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $application->medical_certificate_path) }}" alt="Medical Certificate">
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Fluorography Path
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $application->fluorography_path) }}" alt="Fluorography">
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Residence Address
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $application->residence_address }}
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Status Application
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $application->statusaplication->status_aplication }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Department
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($student)
                                        {{ $student->department->department_name }}
                                    @else
                                        No student information available
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Faculty
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($student)
                                        {{ $student->faculty->name_faculty }}
                                    @else
                                        No student information available
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Course
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($student)
                                        {{ $student->course->course_name }}
                                    @else
                                        No student information available
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Group
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($student)
                                        {{ $student->group }}
                                    @else
                                        No student information available
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Direction
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($student)
                                        {{ $student->direction }}
                                    @else
                                        No student information available
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Phone Number
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($student)
                                        {{ $student->phone_number }}
                                    @else
                                        No student information available
                                    @endif
                                </td>
                            </tr>

                        </tbody>
                    </table>


                    <!-- Button to navigate to the 'rooms' page -->
                   <a href="{{ route('commandant.rooms') }}" class="btn btn-primary">
                        Go to Rooms
                    </a>

                    <form method="post" action="{{ route('send.application.notification', ['id' => $application->id]) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Send Notification Email
                        </button>
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
