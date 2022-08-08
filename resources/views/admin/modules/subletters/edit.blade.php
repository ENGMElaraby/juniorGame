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
                                  action="{{ route('admin.students.update', $data['id']) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-row">
                                    <div class="col-md-3 mb-5">
                                        <label for="image">صوره</label>
                                        <input type="file" class="form-control" id="image"
                                               name="image"
                                               placeholder="الاسم"
                                        >
                                        <div class="valid-tooltip">
                                            تبدو جيدا!
                                        </div>
                                        <div class="invalid-tooltip">
                                            من فضلك اختر الفصل.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="code">كود</label>
                                        <input type="text" class="form-control" id="code"
                                               name="code"
                                               placeholder="كود"
                                               value="{{ old('code') ?? $data['code'] }}" required>
                                        <div class="valid-tooltip">
                                            تبدو جيدا!
                                        </div>
                                        <div class="invalid-tooltip">
                                            من فضلك اختر الفصل.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="name">الاسم</label>
                                        <input type="text" class="form-control" id="name"
                                               name="name"
                                               placeholder="الاسم"
                                               value="{{ old('name') ?? $data['name'] }}" required>
                                        <div class="valid-tooltip">
                                            تبدو جيدا!
                                        </div>
                                        <div class="invalid-tooltip">
                                            من فضلك اختر الفصل.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="mobile">موبايل</label>
                                        <input type="text" class="form-control" id="mobile"
                                               name="mobile"
                                               placeholder="موبايل"
                                               value="{{ old('mobile') ?? $data['mobile'] }}" required>
                                        <div class="valid-tooltip">
                                            تبدو جيدا!
                                        </div>
                                        <div class="invalid-tooltip">
                                            من فضلك اختر الفصل.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="parent_mobile">موبايل ولي الامر</label>
                                        <input type="text" class="form-control" id="parent_mobile"
                                               name="parent_mobile"
                                               placeholder="موبايل ولي الامر"
                                               value="{{ old('parent_mobile') ?? $data['parent_mobile'] }}">
                                        <div class="valid-tooltip">
                                            تبدو جيدا!
                                        </div>
                                        <div class="invalid-tooltip">
                                            من فضلك اختر الفصل.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="school">المدرسه</label>
                                        <input type="text" class="form-control" id="school"
                                               name="school"
                                               placeholder="موبايل"
                                               value="{{ old('school') ?? $data['school'] }}">
                                        <div class="valid-tooltip">
                                            تبدو جيدا!
                                        </div>
                                        <div class="invalid-tooltip">
                                            من فضلك اختر الفصل.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="education_level">المرحله الدراسه</label>
                                        <select class="selectpicker form-control" id="education_level"
                                                name="education_level">
                                            <option disabled selected>اختر</option>
                                            @foreach(\App\Repositories\EducationLevelRepository::all() as $educationLevel)
                                                <option @if((old('education_level') ?? $data['education_level']) == $educationLevel->id) selected
                                                        @endif value="{{ $educationLevel->id }}">{{ $educationLevel->name_ar }}</option>
                                            @endforeach
                                        </select>
                                        <div class="valid-tooltip">
                                            تبدو جيدا!
                                        </div>
                                        <div class="invalid-tooltip">
                                            من فضلك اختر الفصل.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="education_center">السنتر</label>
                                        <select class="selectpicker form-control" id="education_center"
                                                name="education_center">
                                            <option disabled selected>اختر</option>
                                            @foreach(\App\Repositories\EducationCenterRepository::all() as $educationCenter)
                                                <option @if((old('education_center') ?? $data['education_center']) == $educationCenter->id) selected
                                                        @endif value="{{ $educationCenter->id }}">{{ $educationCenter->name_ar }}
                                                    ({{ $educationCenter->getGovernorate->name_ar }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="valid-tooltip">
                                            تبدو جيدا!
                                        </div>
                                        <div class="invalid-tooltip">
                                            من فضلك اختر الفصل.
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
