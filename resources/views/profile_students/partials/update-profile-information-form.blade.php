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

        <!-- <div class="mb-3">
            <label for="faculty_id" class="form-label">Select Faculty:</label>
            <select name="faculty_id" required>
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}">{{ $faculty->name_faculty }}</option>
                @endforeach
            </select>
        </div> -->

         <div>
            <x-input-label for="faculty_id" :value="__('Faculty')" />

            <select name="faculty_id" class="mt-1 block w-full" required>
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}">{{ $faculty->name_faculty }}</option>
                @endforeach
            </select>

            <x-input-error class="mt-2" :messages="$errors->get('faculty_id')" />
        </div>

        <div>
            <x-input-label for="department_id" :value="__('Department')" />
            <select id="departmentSelect" name="department_id" class="mt-1 block w-full" required>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id', optional($student)->department_id) == $department->id ? 'selected' : '' }}>
                        {{ $department->department_name }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('department_id')" />
        </div>

        <div>
            <x-input-label for="direction" :value="__('Direction')" />
            <x-text-input id="direction" name="direction" type="text" class="mt-1 block w-full" :value="old('direction', optional($student)->direction)" required />
            <x-input-error class="mt-2" :messages="$errors->get('direction')" />
        </div>

        <<div>
            <x-input-label for="group" :value="__('Group')" />
            <x-text-input id="group" name="group" type="text" class="mt-1 block w-full" :value="old('group', optional($student)->group)" required />
            <x-input-error class="mt-2" :messages="$errors->get('group')" />
        </div>

        <div>
            <x-input-label for="degree" :value="__('Degree')" />
            <x-text-input id="degree" name="degree" type="text" class="mt-1 block w-full" :value="old('degree', optional($course)->degree)" required />
            <x-input-error class="mt-2" :messages="$errors->get('degree')" />
        </div>

        <div>
            <x-input-label for="course_name" :value="__('Course Name')" />
            <x-text-input id="course_name" name="course_name" type="text" class="mt-1 block w-full" :value="old('course_name', optional($course)->course_name)" required />
            <x-input-error class="mt-2" :messages="$errors->get('course_name')" />
        </div>


       <div>
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" :value="old('phone_number', optional($student)->phone_number)" required />
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