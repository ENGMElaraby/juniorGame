@php use App\Models\Letter; @endphp
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"
            integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@push('script')
    <script>
        $(".repeater-default").repeater({
            show: function () {
                $(this).slideDown();
            }, hide: function (e) {
                confirm("متأكد تردي مسح ؟") && $(this).slideUp(e)
            }
        })
    </script>
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
                                    <h4>سؤال جديد</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form class="needs-validation" method="post" novalidate id="storeForm"
                                  action="{{ route('admin.questions.store') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-3 mb-5">
                                        <label for="letter_id">يندرج تحت حرف</label>
                                        <select class="form-control" name="letter_id" id="letter_id" required>
                                            @foreach(Letter::all() as $letter)
                                                <option value="{{ $letter->id }}">{{ $letter->letter }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="title">السؤال</label>
                                        <input type="text" class="form-control" id="title"
                                               name="title"
                                               placeholder="السؤال"
                                               value="{{ old('title') }}">
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
                                               required>
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="voice">الصوت</label>
                                        <input type="file" class="form-control" id="voice"
                                               name="voice"
                                        >
                                    </div>
                                </div>
                                <div class="repeater-default">
                                    <div data-repeater-list="answers">
                                        <div data-repeater-item class="form-row">
                                            <div class="col-md-3 mb-5">
                                                <label for="title">الاجابه</label>
                                                <input type="text" class="form-control" id="title"
                                                       name="title"
                                                       placeholder="الاجابه"
                                                       value="{{ old('title') }}">
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
                                                       required>
                                            </div>
                                            <div class="col-md-3 mb-5">
                                                <label for="voice">الصوت</label>
                                                <input type="file" class="form-control" id="voice"
                                                       name="voice"
                                                >
                                            </div>
                                            <div class="col-md-3 col-sm-12 form-group d-flex align-items-center"
                                                 style="padding-top: 1.5rem!important;">
                                                <button class="btn btn-danger" data-repeater-delete type="button"><i
                                                            class="bx bx-x"></i>
                                                    مسح من الامتحان
                                                </button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col p-0">
                                        <button class="btn btn-secondary" data-repeater-create type="button"><i
                                                    class="bx bx-plus"></i>
                                            اضف اجابه
                                        </button>
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
