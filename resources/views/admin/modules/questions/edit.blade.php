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
                                    <h4>تعديل </h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form class="needs-validation" method="post" novalidate id="storeForm"
                                  action="{{ route('admin.words.update', $data['id']) }}"
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
                                        <label for="word">الكلمه</label>
                                        <input type="text" class="form-control" id="word"
                                               name="word"
                                               placeholder="الكلمه"
                                               value="{{ old('word') ?? $data->word }}" required>
                                        <div class="valid-tooltip">
                                            تبدو جيدا!
                                        </div>
                                        <div class="invalid-tooltip">
                                            من فضلك ادخل الحقل.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="image">الصوره</label>
                                        <input type="file" class="form-control" id="image"
                                               name="image"
                                        >
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <img src="{{ $data->image }}" alt="" width="100" height="100">
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="voice">الصوت</label>
                                        <input type="file" class="form-control" id="voice"
                                               name="voice"
                                        >
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <a href="{{ $data->voice }}" class="badge badge-info" target="_blank">فتح
                                            الصوت</a>
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
