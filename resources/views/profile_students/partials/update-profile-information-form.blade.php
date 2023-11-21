<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information-Student') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
        <x-input-label for="faculty_id" :value="__('Faculty')" />
        <x-select id="faculty_id" name="faculty_id" class="mt-1 block w-full" required>
            @foreach($faculties as $faculty)
                <option value="{{ $faculty->id }}" {{ old('faculty_id', $student->faculty_id) == $faculty->id ? 'selected' : '' }}>
                    {{ $faculty->name_faculty }}
                </option>
            @endforeach
        </x-select>
        <x-input-error class="mt-2" :messages="$errors->get('faculty_id')" />
        </div>

        <div>
            <x-input-label for="department_id" :value="__('Department')" />
            <x-select id="department_id" name="department_id" class="mt-1 block w-full" required>
                @foreach($departments as $department)
                    @if(old('faculty_id', $student->faculty_id) == $department->faculty_id)
                        <option value="{{ $department->id }}" {{ old('department_id', $student->department_id) == $department->id ? 'selected' : '' }}>
                            {{ $department->department_name }}
                        </option>
                    @endif
                @endforeach
            </x-select>
            <x-input-error class="mt-2" :messages="$errors->get('department_id')" />
        </div>

        <div>
            <x-input-label for="course_id" :value="__('Course')" />
            <x-select id="course_id" name="course_id" class="mt-1 block w-full" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id', $course->id) == $course->id ? 'selected' : '' }}>
                        {{ $course->course_name }}
                    </option>
                @endforeach
            </x-select>
            <x-input-error class="mt-2" :messages="$errors->get('course_id')" />
        </div>

        <div>
            <x-input-label for="group" :value="__('Group')" />
            <x-text-input id="group" name="group" type="text" class="mt-1 block w-full" :value="old('group', $student->group)" required />
            <x-input-error class="mt-2" :messages="$errors->get('group')" />
        </div>

        <div>
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" :value="old('phone_number', $student->phone_number)" required />
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>





        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
