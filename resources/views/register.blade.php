<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.3/datatables.min.css"/>

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/flatpickr.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/colors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/components.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dark-layout.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bordered-layout.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/semi-dark-layout.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/form-flat-pickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/form-pickadate.min.css')}}">

    <title></title>


</head>
<body>
<div class="content-body">
    <section class="bs-validation m-3">
        <div class="row">
            <form enctype="multipart/form-data" id="form-data-1"
                  class="needs-validation"
                  name="form1" novalidate>
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="d-flex justify-content-between card-header ">
                            <div class="heading-elements ">
                                <ul class="list-inline mb-0 ms-0">
                                    <li>
                                        <a href="{{route('index')}}"><i data-feather="chevron-left"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <h1 class="">????ng k??</h1>
                            <div class="heading-elements ">
                                <ul class="list-inline mb-0 ms-0">
                                    <li>
                                        <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @csrf
                        @error('name')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        <div class="card-content collapse show">

                            <div class="card-body m-3">

                                <div class="row">
                                    <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                        <label class="form-label" for="name">T??n</label>

                                        <input
                                            value="{{old('name')}}"
                                            type="text"
                                            id="name"
                                            class="form-control"
                                            placeholder="H??? v?? t??n"
                                            name="name"
                                            required
                                        />
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">Vui l??ng ??i???n t??n.</div>
                                    </div>
                                    @error('gender')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                    <div class="col-xl-3 col-md-4 col-sm-12 mb-1 px-5">
                                        <label class="form-label" class="d-block">Gi???i t??nh</label>
                                        <div class="demo-inline-spacing">
                                            <div class="form-check my-50">
                                                <input
                                                    type="radio"
                                                    value="0"
                                                    name="gender"
                                                    class="form-check-input"
                                                    required
                                                />
                                                <label class="form-check-label" for="validationRadio3">Nam</label>
                                            </div>
                                            <div class="form-check my-50">
                                                <input
                                                    type="radio"
                                                    value="1"
                                                    name="gender"
                                                    class="form-check-input"
                                                    required

                                                />
                                                <label class="form-check-label" for="validationRadio4">N???</label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('birthdate')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                    <div class="col-xl-5 col-md-6 mb-1">
                                        <label class="form-label" for="dob">
                                            Ng??y th??ng n??m sinh
                                        </label>

                                        <input
                                            type="date"
                                            name="birthdate"
                                            id="fp-human-friendly"
                                            class="form-control picker flatpickr-human-friendly "
                                            placeholder=""
                                            required
                                        />
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">Vui l??ng ch???n ng??y th??ng n??m sinh.</div>
                                    </div>
                                    @error('phone_numbers')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                    <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                        <label class="form-label" for="phone_numbers">S??? ??i???n tho???i</label>

                                        <input
                                            value="{{old('phone_numbers')}}"

                                            type="number"
                                            id="phone_numbers"
                                            class="form-control"
                                            placeholder="S??? ??i???n tho???i"
                                            name="phone_numbers"
                                            required
                                        />
                                        <div class="invalid-feedback">Vui l??ng nh???p s??? ??i???n tho???i.</div>
                                    </div>
                                    @error('id_numbers')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                    <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                        <label class="form-label" for="id_numbers">CCCD/CMND</label>

                                        <input
                                            value="{{old('id_numbers')}}"

                                            type="number"
                                            id="id_numbers"
                                            class="form-control"
                                            placeholder="C??n c?????c c??ng d??n"
                                            name="id_numbers"
                                            required
                                        />
                                        <div class="invalid-feedback">Vui l??ng nh???p CCCD/CMND.</div>
                                    </div>
                                    @error('email')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                    <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                        <label class="form-label" for="email">Email</label>
                                        <input
                                            value="{{old('email')}}"

                                            type="email"
                                            id="email"
                                            class="form-control"
                                            placeholder="email"
                                            name="email"
                                            required
                                        />
                                        <div class="invalid-feedback">Vui l??ng nh???p email.</div>
                                    </div>
                                    @error('file')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                    <div class="col-xl-5 col-md-6 col-sm-12 mb-2">
                                        <label for="customFile1" class="form-label">File h??nh th???</label>
                                        <input class="form-control" name="file" type="file" id="file" required/>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                        <label class="form-label" for="password">M???t kh???u</label>

                                        <input
                                            value="{{old('password')}}"
                                            max="20"
                                            min="8"
                                            type="password"
                                            id="password"
                                            class="form-control"
                                            placeholder="M???t kh???u"
                                            name="password"
                                            required
                                        />
                                        <div class="invalid-feedback">Vui l??ng nh???p m???t kh???u.</div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">????ng k?? bu???i h???c</h4>
                            <div class="heading-elements">
                                <ul class="list-inline">
                                    <li>
                                        <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse">
                            <div class="card-body m-3">
                                <div class="row">

                                    <div class="col-md-4 mb-1">
                                        <label class="form-label" for="select2-limited">Ch???n th???</label>
                                        <select name="days_of_week"
                                                class="max-length form-select form-control select2 required"
                                                id="select2-limited" multiple required>
                                            <optgroup label="Th???">
                                                <option value="Mon">Th??? 2</option>
                                                <option value="Tue">Th??? 3</option>
                                                <option value="Wed">Th??? 4</option>
                                                <option value="Thu">Th??? 5</option>
                                                <option value="Fri">Th??? 6</option>
                                                <option value="Sat">Th??? 7</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <!-- Basic Select -->
                                    <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                        <label class="form-label" for="last">Th???i gian m???i bu???i</label>
                                        <select name="last" class="form-select" id="last">
                                            <option value="2">2 ti???ng</option>
                                            <option value="4">4 ti???ng</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                        <label class="form-label" for="shift">Ca</label>
                                        <select name="shift" class="form-select" id="shift">
                                            <option value="AM">S??ng</option>
                                            <option value="PM">Chi???u</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="disabledInput">S??? bu???i</label>
                                            <input name="lesson" type="number" value="20" class="form-control"
                                                   id="lesson"
                                                   disabled/>
                                        </div>
                                    </div>
                                    @error('is_full')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                    <div class="col-xl-4 col-md-6 col-sm-12 mb-1">
                                        <label class="form-label" class="d-block">Tr???n g??i</label>
                                        <div class="demo-inline-spacing">
                                            <div class="form-check my-50">
                                                <input
                                                    value="1"
                                                    type="radio"
                                                    name="is_full"
                                                    class="form-check-input"
                                                    required
                                                />
                                                <label class="form-check-label" for="validationRadio3">C??</label>
                                            </div>
                                            <div class="form-check my-50">
                                                <input
                                                    value="0"
                                                    type="radio"
                                                    name="is_full"
                                                    class="form-check-input"
                                                    required
                                                />
                                                <label class="form-check-label" for="validationRadio4">Kh??ng</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="disabledInput">T???ng ti???n</label>
                                            <input name="bill" type="number" value="" class="form-control"
                                                   id="bill"
                                                   disabled/>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-lg-center center-layout">
                                        <button type="submit" class="btn btn-primary " id="btn-submit">
                                            Submit
                                        </button>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>


                </div>
            </form>
            <!-- /Bootstrap Validation -->
        </div>
    </section>
</div>
</body>
<script src="{{asset('js/vendors.min.js')}}"></script>
<!-- BEGIN: Theme JS-->
<script src="{{asset('js/app-menu.min.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('js/customizer.min.js')}}"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.3/datatables.min.js"></script>

<script src={{asset('js/picker.js')}}></script>
<script src={{asset('js/picker.date.js')}}></script>
<script src={{asset('js/picker.time.js')}}></script>
<script src={{asset('js/legacy.js')}}></script>
<script src={{asset('js/flatpickr.min.js')}}></script>
<script src={{asset('js/form-pickers.min.js')}}></script>
<script src={{asset('js/select2.full.min.js')}}></script>
<script src={{asset('js/jquery.validate.min.js')}}></script>
<script src={{asset('js/form-select2.min.js')}}></script>
<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({width: 14, height: 14});
        }
    })
    $(document).ready(function () {
        let last = document.getElementById("last");
        let bill = document.getElementById('bill'),
            full = "3500000",
            dow = document.getElementById('select2-limited').length,
            notfull = last.value / 2 * 200000 * dow,
            isFull = document.getElementsByName('is_full');

        last.addEventListener("change", function () {
            isFull = $('input[name="is_full"]:checked').val();
            if (isFull == "true") {
                if (last.value === "2") {
                    document.getElementById("lesson").value = 20;
                } else if (last.value === "4") {
                    document.getElementById("lesson").value = 10;
                }
            } else {

                document.getElementById("lesson").value = $('select#select2-limited').val().length;

            }

        });
        for (let i = 0; i < isFull.length; i++) {
            isFull[i].addEventListener('change', function (value) {
                let dow = $('select#select2-limited').val().length,
                    notfull = last.value / 2 * 200000 * dow;
                if (this.value == "true") {
                    document.getElementById('bill').value = full;
                } else {
                    document.getElementById('bill').value = notfull;
                }
            })
        }
        $("#btn-submit").click(function (event) {
            //validate
            console.log($("select#select2-limited").length);
            var form = document.getElementById('form-data-1');
            form.dispatchEvent(new Event('submit'));
            event.preventDefault();

            // Form data
            let dow = $("select#select2-limited").val();
            var form1 = new FormData(document.getElementById('form-data-1'));
            var day = $('input[name="lesson"]').val();
            var last = $('select[name="last"]').val();
            form1.append('lesson', day);
            form1.set('days_of_week', dow);
            //ajax
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '{{route('registering')}}',
                type: 'POST',
                dataType: "JSON",
                data: form1,
                // "'X-CSRF-TOKEN'": data1,

                contentType: false,
                processData: false,
                success: function (event) {
                    if (event == "1") {
                        window.location = "{{route('index')}}";
                    } else {
                        console.log(0);
                    }
                },
                error: function () {
                    console.log(1);

                },

            });
        })
    });
</script>
<script src={{asset('js/form-validation.js')}}></script>

</html>
