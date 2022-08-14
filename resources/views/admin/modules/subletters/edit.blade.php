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
                                    <h4>تعديل</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form class="needs-validation" method="post" novalidate id="storeForm"
                                  action="{{ route('admin.sub-letters.update', $data['id']) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-row">
                                    <div class="col-md-3 mb-5">
                                        <label for="letter_id">يندرج تحت حرف</label>
                                        <select class="form-control" name="letter_id" id="letter_id" required>
                                            @foreach(\App\Models\Letter::all() as $letter)
                                                <option value="{{ $letter->id }}"
                                                        @if($data->letter_id == $letter->id) checked @endif>{{ $letter->letter }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="letter">الحرف</label>
                                        <input type="text" class="form-control" id="letter"
                                               name="letter" maxlength="1"
                                               placeholder="الحرف"
                                               value="{{ old('letter') ?? $data->letter }}" required>
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
                                                       @if($data->status == 1) checked @endif
                                                >
                                                <span class="new-control-indicator"></span>مفعل
                                            </label>
                                        </div>
                                        <div class="n-chk">
                                            <label class="new-control new-radio radio-classic-danger">
                                                <input type="radio" class="new-control-input" name="status"
                                                       value="0" @if($data->status == 0) checked @endif>
                                                <span class="new-control-indicator"></span>غير مفعل
                                            </label>
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
