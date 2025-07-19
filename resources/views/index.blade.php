<x-front-layout>
    @push('styles')
        <style>
            body {
                background-color: #f0f2f5;
                font-family: 'Segoe UI', sans-serif;
            }

            .card {
                margin-bottom: 20px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
                border: 1.5px solid #dee2e6;
            }

            .form-section {
                max-width: 700px;
                margin: auto;
                padding: 30px;
            }

            .form-title {
                text-align: center;
                margin-bottom: 30px;
                background-color: #6c63ff;
                color: #fff;
                padding: 20px;
                border-radius: 10px;
                font-weight: bold;
                font-size: 1.5rem;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            .submit-btn {
                background-color: #6c63ff;
                border: none;
                padding: 12px 40px;
                font-size: 1.1rem;
                border-radius: 8px;
                color: white;
                transition: 0.3s ease;
            }

            .submit-btn:hover {
                background-color: #594ed1;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            }

            .required-star {
                color: red;
                margin-right: 4px;
            }
        </style>
    @endpush
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $key => $error)
                    <li>{{ $key  }} . {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('application.store') }}" method="POST" class="container form-section" enctype="multipart/form-data">
        @csrf
        <div class="form-title">نموذج التسجيل للتطوع</div>
        <div class="p-4 card">
            <label for="email" class="form-label">
                البريد الإلكتروني
                <span class="required-star">*</span>
            </label>
            <input type="email" id="email" name="email" class="form-control" required value="{{ old('email') }}">
            <div class="invalid-feedback" style="display: none;"></div>
        </div>
        <div class="p-4 card">
            <label for="full_name" class="form-label">
                الاسم الكامل
                <span class="required-star">*</span>
            </label>
            <input type="text" id="full_name" name="full_name" class="form-control" required value="{{ old('full_name') }}">
        </div>
        <div class="p-4 card">
            <label for="gender" class="form-label">
                الجنس
                <span class="required-star">*</span>
            </label>
            <select class="form-select" id="gender" name="gender" required>
                <option value="" selected disabled>اختر</option>
                <option value="male" @selected(old('gender') == 'male')>ذكر</option>
                <option value="female" @selected(old('gender') == 'female')>أنثى</option>
            </select>
        </div>
        <div class="p-4 card">
            <label for="phone" class="form-label">رقم الهاتف</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
        </div>
        <div class="p-4 card">
            <label for="birth_date" class="form-label">
                تاريخ الميلاد
                <span class="required-star">*</span>
            </label>
            <input type="date" id="birth_date" name="birth_date" class="form-control" required value="{{ old('birth_date') }}">
        </div>
        <div class="p-4 card">
            <label class="form-label">
                الجامعة
                <span class="required-star">*</span>
            </label>
            <select class="form-select" id="university" name="university" required>
                <option value="" selected disabled>اختر</option>
                @foreach ($universities as $university)
                    <option value="{{ $university }}" @selected(old('university') == $university)>{{ $university }}</option>
                @endforeach
            </select>
        </div>
        <div class="p-4 card">
            <label class="form-label">
                المدينة
                <span class="required-star">*</span>
            </label>
            <select class="form-select" id="city" name="city" required>
                <option value="" selected disabled>اختر</option>
                @foreach ($cities as $city)
                    <option value="{{ $city }}" @selected(old('city') == $city)>{{ $city }}</option>
                @endforeach
            </select>
        </div>
        <div class="p-4 card">
            <label for="volunteer_place" class="form-label">
                مكان التطوع
                <span class="required-star">*</span>
            </label>
            <select class="form-select" id="volunteer_place" name="volunteer_place" required>
                <option value="" selected disabled>اختر</option>
                @foreach ($volunteer_places as $volunteer_place)
                    <option value="{{ $volunteer_place }}" @selected(old('volunteer_place') == $volunteer_place)>{{ $volunteer_place }}</option>
                @endforeach
            </select>
        </div>
        <div class="p-4 card">
            <label for="specialization_id" class="form-label">
                التخصص
                <span class="required-star">*</span>
            </label>
            <select class="form-select" id="specialization_id" name="specialization_id" required>
                <option value="" selected disabled>اختر</option>
                @foreach ($specializations as $specialization)
                    <option value="{{ $specialization->id }}" @selected(old('specialization_id') == $specialization->id)>{{ $specialization->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="p-4 card">
            <label for="major" class="form-label">
                التخصص الأكاديمي
                <span class="required-star">*</span>
            </label>
            <input type="text" id="major" name="major" class="form-control" required value="{{ old('major') }}">
        </div>
        <div class="p-4 card">
            <label for="academic_year" class="form-label">
                السنة الدراسية
                <span class="required-star">*</span>
            </label>
            <input type="number" min="2000" max="{{ date('Y') }}" step="1" id="academic_year" name="academic_year" class="form-control" required value="{{ old('academic_year') }}">
        </div>
        <div class="p-4 card">
            <label for="motivation" class="form-label">
                لماذا ترغب في التطوع؟
            </label>
            <textarea id="motivation" name="motivation" class="form-control" rows="2" value="{{ old('motivation') }}"></textarea>
        </div>

        <div class="p-4 card">
            <label for="previous_experience" class="form-label">خبرات سابقة</label>
            <textarea id="previous_experience" name="previous_experience" class="form-control" rows="2" value="{{ old('previous_experience') }}"></textarea>
        </div>
        <div class="p-4 card">
            <label for="availability" class="form-label">متى تكون متاحًا؟</label>
            <input type="text" id="availability" name="availability" class="form-control" value="{{ old('availability') }}">
        </div>
        <div class="p-4 card">
            <label for="notes" class="form-label">ملاحظات إضافية</label>
            <textarea id="notes" name="notes" class="form-control" rows="2" value="{{ old('notes') }}"></textarea>
        </div>
        <div class="p-4 card">
            <label for="file" class="form-label">السيرة الذاتية (CV)</label>
            <input type="file" id="file" name="file" class="form-control" value="{{ old('file') }}">
        </div>
        <div class="text-end">
            <button class="submit-btn" type="submit" id="submit-btn">إرسال</button>
        </div>
    </form>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#email').on('blur', function() {
                    let email = $(this).val();
                    if (email.includes('@') && email.includes('.')) {
                        $(this).removeClass('is-invalid');
                        $(this).next('.invalid-feedback').remove();
                    } else {
                        $(this).addClass('is-invalid');
                        $(this).next('.invalid-feedback').remove();
                        $(this).after('<div class="invalid-feedback">البريد الإلكتروني غير صحيح.</div>');
                    }
                    $.ajax({
                        url: '{{ route('application.checkEmail') }}',
                        type: 'POST',
                        data: {
                            email: email,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.exists) {
                                $('#email').addClass('is-invalid');
                                $(this).next('.invalid-feedback').remove();
                                $('#email').after('<div class="invalid-feedback">البريد الإلكتروني موجود بالفعل.</div>');
                                $('#submit-btn').prop('disabled', true);
                            } else {
                                $('#email').removeClass('is-invalid');
                                $('#email').next('.invalid-feedback').remove();
                                $('#submit-btn').prop('disabled', false);
                            }
                        },
                    });
                });
            });
        </script>
    @endpush
</x-front-layout>
