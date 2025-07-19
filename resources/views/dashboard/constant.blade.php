<x-dashboard-layout>
    <h2 class="mb-4">إدارة الثوابت</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('dashboard.constants.update') }}" method="POST">
        @csrf

        {{-- المدن --}}
        <div class="mb-4">
            <label class="form-label">المدن:</label>
            <div id="cities-wrapper">
                @foreach($constants['cities']->value ?? [''] as $city)
                    <div class="input-group mb-2">
                        <input type="text" name="cities[]" value="{{ $city }}" class="form-control">
                        <button type="button" class="btn btn-danger" onclick="removeField(this)">❌</button>
                    </div>
                @endforeach
            </div>
            <button type="button" onclick="addField('cities-wrapper', 'cities[]')" class="btn btn-sm btn-secondary">إضافة مدينة</button>
        </div>

        {{-- الجامعات --}}
        <div class="mb-4">
            <label class="form-label">الجامعات:</label>
            <div id="universities-wrapper">
                @foreach($constants['universities']->value ?? [''] as $uni)
                    <div class="input-group mb-2">
                        <input type="text" name="universities[]" value="{{ $uni }}" class="form-control">
                        <button type="button" class="btn btn-danger" onclick="removeField(this)">❌</button>
                    </div>
                @endforeach
            </div>
            <button type="button" onclick="addField('universities-wrapper', 'universities[]')" class="btn btn-sm btn-secondary">إضافة جامعة</button>
        </div>

        {{-- أماكن التطوع --}}
        <div class="mb-4">
            <label class="form-label">أماكن التطوع:</label>
            <div id="volunteering-wrapper">
                @foreach($constants['volunteering_places']->value ?? [''] as $place)
                    <div class="input-group mb-2">
                        <input type="text" name="volunteering_places[]" value="{{ $place }}" class="form-control">
                        <button type="button" class="btn btn-danger" onclick="removeField(this)">❌</button>
                    </div>
                @endforeach
            </div>
            <button type="button" onclick="addField('volunteering-wrapper', 'volunteering_places[]')" class="btn btn-sm btn-secondary">إضافة مكان</button>
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>

    {{-- JavaScript --}}
    <script>
        function addField(wrapperId, name) {
            const wrapper = document.getElementById(wrapperId);
            const div = document.createElement('div');
            div.className = 'input-group mb-2';
            div.innerHTML = `
                <input type="text" name="${name}" class="form-control">
                <button type="button" class="btn btn-danger" onclick="removeField(this)">❌</button>
            `;
            wrapper.appendChild(div);
        }

        function removeField(button) {
            button.closest('.input-group').remove();
        }
    </script>
</x-dashboard-layout>
