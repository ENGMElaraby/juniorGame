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
                                    <h4> جديد</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form class="needs-validation" method="post" novalidate id="storeForm"
                                  action="{{ route('admin.letters.store') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-3 mb-5">
                                        <label for="letter">الحرف</label>
                                        <input type="text" class="form-control" id="letter"
                                               name="letter" maxlength="1"
                                               placeholder="الحرف"
                                               value="{{ old('letter') }}" required>
                                        <div class="valid-tooltip">
                                            تبدو جيدا!
                                        </div>
                                        <div class="invalid-tooltip">
                                            من فضلك ادخل الحقل.
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-5">
                                        <label for="email">الحاله</label>
                                        <div class="n-chk">
                                            <label class="new-control new-radio radio-classic-success">
                                                <input type="radio" class="new-control-input" name="status" value="1"
                                                       checked>
                                                <span class="new-control-indicator"></span>مفعل
                                            </label>
                                        </div>
                                        <div class="n-chk">
                                            <label class="new-control new-radio radio-classic-danger">
                                                <input type="radio" class="new-control-input" name="status" value="0">
                                                <span class="new-control-indicator"></span>غير مفعل
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="youtube">القصه (يوتيوب)</label>
                                        <input type="text" class="form-control" id="youtube"
                                               name="youtube"
                                               placeholder="القصه"
                                               value="{{ old('youtube') }}" required>
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
