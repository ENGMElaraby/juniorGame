@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css') }}">
    <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">

@endpush

@push('js')
    <script src="{{ asset('assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
@endpush

@push('script')
@endpush

@section('content_area')
    <div class="row layout-top-spacing" id="cancel-row">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="row">
                <div id="tooltips" class="col-lg-12 layout-spacing col-md-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>طالب جديد</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form class="needs-validation" method="post" novalidate id="storeForm"
                                  action="{{ route('admin.users.update', $data['id']) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-row">
                                    <div class="col-md-3 mb-5">
                                        <label for="gender">النوع</label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="male" @if($data->gender === 'male') selected @endif>ولد
                                            </option>
                                            <option value="female" @if($data->gender === 'female') selected @endif>بنت
                                            </option>
                                        </select>

                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="name">الاسم</label>
                                        <input type="text" class="form-control" id="name"
                                               name="name"
                                               placeholder="الاسم"
                                               value="{{ old('name') ?? $data->name }}" required>
                                        <div class="valid-tooltip">
                                            تبدو جيدا!
                                        </div>
                                        <div class="invalid-tooltip">
                                            من فضلك ادخل الحقل.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="school">المدرسه</label>
                                        <input type="text" class="form-control" id="school"
                                               name="school"
                                               placeholder="المدرسه"
                                               value="{{ old('school') ?? $data->school }}">
                                        <div class="valid-tooltip">
                                            تبدو جيدا!
                                        </div>
                                        <div class="invalid-tooltip">
                                            من فضلك ادخل الحقل.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="city">البلد</label>
                                        <input type="text" class="form-control" id="city"
                                               name="city"
                                               placeholder="البلد"
                                               value="{{ old('city') ?? $data->city }}">
                                        <div class="valid-tooltip">
                                            تبدو جيدا!
                                        </div>
                                        <div class="invalid-tooltip">
                                            من فضلك ادخل الحقل.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="years_old">السن</label>
                                        <input type="text" class="form-control" id="years_old"
                                               name="years_old"
                                               placeholder="السن"
                                               value="{{ old('years_old') ?? $data->years_old }}">
                                        <div class="valid-tooltip">
                                            تبدو جيدا!
                                        </div>
                                        <div class="invalid-tooltip">
                                            من فضلك ادخل الحقل.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="mobile">موبايل</label>
                                        <input type="text" class="form-control" id="mobile"
                                               name="mobile"
                                               placeholder="موبايل"
                                               value="{{ old('mobile') ?? $data->mobile }}">
                                        <div class="valid-tooltip">
                                            تبدو جيدا!
                                        </div>
                                        <div class="invalid-tooltip">
                                            من فضلك ادخل الحقل.
                                        </div>
                                    </div>
                                </div>
                                <button id="submit_saved" class="btn btn-primary mt-2" type="submit">حفظ</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
