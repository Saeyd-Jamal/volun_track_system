<x-dashboard-layout>
    <form action="{{ route('dashboard.form-settings.update') }}" method="post" class="col-12">
        @csrf

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="pt-4 card-body">
                        <div class="row g-4">

                           
                            <div class="col-md-6">
                                <label for="form_status" class="form-label">حالة النموذج:</label>
                                <select name="form_status" id="form_status" class="form-select">
                                    <option value="" disabled>اختر</option>
                                    <option value="open" {{ $setting->form_status == 'open' ? 'selected' : '' }}>مفتوح</option>
                                    <option value="closed" {{ $setting->form_status == 'closed' ? 'selected' : '' }}>مغلق</option>
                                </select>
                            </div>

                           
                            <div class="col-md-6">
                                <label for="form_open_at" class="form-label">تاريخ فتح النموذج:</label>
                                <input type="datetime-local" name="form_open_at" id="form_open_at"
                                       class="form-control"
                                       value="{{ $setting->form_open_at ? \Carbon\Carbon::parse($setting->form_open_at)->format('Y-m-d\TH:i') : '' }}">
                            </div>

                           
                            <div class="col-md-6">
                                <label for="form_close_at" class="form-label">تاريخ إغلاق النموذج:</label>
                                <input type="datetime-local" name="form_close_at" id="form_close_at"
                                       class="form-control"
                                       value="{{ $setting->form_close_at ? \Carbon\Carbon::parse($setting->form_close_at)->format('Y-m-d\TH:i') : '' }}">
                            </div>

                            
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    حفظ
                                </button>
                            </div>

                        </div> 
                    </div> 
                </div> 

            </div>
        </div>
    </form>
</x-dashboard-layout>
