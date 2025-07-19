<x-dashboard-layout>
    <h2 class="mb-6 text-xl font-semibold">إدارة الثوابت</h2>

    <form action="{{ route('dashboard.constants.update') }}" method="POST" class="space-y-8">
        @csrf

        {{-- مكون إعادة استخدام --}}
        @php
            $sections = [
                ['label' => 'المدن', 'name' => 'cities', 'items' => $constants['cities']->value ?? ['']],
                ['label' => 'الجامعات', 'name' => 'universities', 'items' => $constants['universities']->value ?? ['']],
                [
                    'label' => 'أماكن التطوع',
                    'name' => 'volunteering_places',
                    'items' => $constants['volunteering_places']->value ?? [''],
                ],
            ];
        @endphp

        @foreach ($sections as $section)
            <div class="mb-4 shadow-sm card">
                <div class="card-body">
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $section['label'] }}</h5>
                        <button type="button"
                            onclick="addField('{{ $section['name'] }}-wrapper', '{{ $section['name'] }}[]')"
                            class="btn btn-outline-primary btn-sm">
                            <i class="ti ti-plus"></i> إضافة {{ $section['label'] }}
                        </button>
                    </div>

                    <hr>

                    <div id="{{ $section['name'] }}-wrapper" class="row g-3">
                        @foreach ($section['items'] as $item)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="input-group">
                                    <input type="text" name="{{ $section['name'] }}[]" value="{{ $item }}"
                                        class="form-control" placeholder="{{ $section['label'] }}...">
                                    <button type="button" class="btn btn-danger" onclick="removeField(this)">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

        <div class="text-end">
            <button type="submit" class="btn btn-success">
                <i class="ti ti-save"></i> حفظ التعديلات
            </button>
        </div>

    </form>

    {{-- JavaScript --}}
    <script>
        function addField(wrapperId, name) {
            const wrapper = document.getElementById(wrapperId);
            const div = document.createElement('div');
            div.className = 'col-12 col-md-6 col-lg-4';
            div.innerHTML = `
                <div class="input-group">
                    <input type="text" name="${name}" class="form-control" placeholder="...">
                    <button type="button" class="btn btn-danger" onclick="removeField(this)">
                        <i class="ti ti-trash"></i>
                    </button>
                </div>
            `;
            wrapper.appendChild(div);
        }

        function removeField(button) {
            button.closest('.col-12').remove();
        }
    </script>


</x-dashboard-layout>
