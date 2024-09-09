@extends('user.componen.app')
@section('content')
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href={{route('dashboard_user')}}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
        <li class="breadcrumb-item"><a href={{route('dashboard_user')}}>Pengelolaan Stok Opname</a></li>
        <li class="breadcrumb-item active" aria-current="page">Input Stok Opname</li>
    </ol>
</nav>

<div class="row layout-top-spacing">
                    <div class="col-xl-5 col-lg-6 col-md-6 mb-4">
                        <div class="card b-l-card-1 h-100" style="-webkit-box-shadow: 0 4px 6px 0 rgba(85, 85, 85, 0.08), 0 1px 20px 0 rgba(0, 0, 0, 0.07), 0px 1px 11px 0px rgba(0, 0, 0, 0.07);-moz-box-shadow: 0 4px 6px 0 rgba(85, 85, 85, 0.08), 0 1px 20px 0 rgba(0, 0, 0, 0.07), 0px 1px 11px 0px rgba(0, 0, 0, 0.07); box-shadow: 0 4px 6px 0 rgba(85, 85, 85, 0.08), 0 1px 20px 0 rgba(0, 0, 0, 0.07), 0px 1px 11px 0px rgba(0, 0, 0, 0.07);">
                            <div class="card-body">
                            <section class="container" id="demo-content">
     
     
     <div>
       <a class="button btn btn-outline-primary mb-3" id="startButton">Start</a>
       <a class="button btn btn-outline-danger mb-3" id="resetButton">Reset</a>
     </div>

     <div>
       <video id="video" width="300" height="200" style="border: 1px solid gray"></video>
     </div>

     <div id="sourceSelectPanel" style="display:none">
       <label for="sourceSelect">Change video source:</label>
       <select  class="form-control  basic" id="sourceSelect" style="max-width:400px">
       </select>
     </div>

     <label class="mt-3">Hasil:</label>
     <pre><code id="result"></code></pre>

     
   </section>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-6 col-md-6 col-sm-12 col-12" style="margin-bottom:24px;">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">                                
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Input Stok Opname</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area" style="height: 571px;">
                                <form>
                                       <div class="form-group mb-4">
                                            <label for="gudangSelect">Code</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" aria-describedby="basic-addon2" required readonly>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M24 32C10.7 32 0 42.7 0 56L0 456c0 13.3 10.7 24 24 24l16 0c13.3 0 24-10.7 24-24L64 56c0-13.3-10.7-24-24-24L24 32zm88 0c-8.8 0-16 7.2-16 16l0 416c0 8.8 7.2 16 16 16s16-7.2 16-16l0-416c0-8.8-7.2-16-16-16zm72 0c-13.3 0-24 10.7-24 24l0 400c0 13.3 10.7 24 24 24l16 0c13.3 0 24-10.7 24-24l0-400c0-13.3-10.7-24-24-24l-16 0zm96 0c-13.3 0-24 10.7-24 24l0 400c0 13.3 10.7 24 24 24l16 0c13.3 0 24-10.7 24-24l0-400c0-13.3-10.7-24-24-24l-16 0zM448 56l0 400c0 13.3 10.7 24 24 24l16 0c13.3 0 24-10.7 24-24l0-400c0-13.3-10.7-24-24-24l-16 0c-13.3 0-24 10.7-24 24zm-64-8l0 416c0 8.8 7.2 16 16 16s16-7.2 16-16l0-416c0-8.8-7.2-16-16-16s-16 7.2-16 16z"/></svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="gudangSelect">Produk</label>
                                            <select class="form-control  basic" id="gudangSelect" name="id_gudang" required readonly>
                                               
                                                    <option value="Udin"></option>
                                                
                                            </select>
                                        </div> 

                                        <div class="form-group mb-4">
                                            <label for="inputAddress2">QTY</label>
                                            <input type="text" class="form-control" id="inputAddress2" >
                                        </div>
           
                                        <button class="btn btn-primary" style="margin-left: 0px">
                                        Submit</button>
                                <a href="{{ route('dashboard_user') }}" type="button" class="btn btn-outline-danger"
                                    style="margin-left: 5px"><i class="ti ti-arrow-back"></i> Cancel</a>
                                </div>
                                    </form>
                            </div>
                        </div>
                    </div>

                        
@endsection

@push('script')

<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest/umd/index.min.js"></script>
  <script type="text/javascript">
    window.addEventListener('load', function () {
      let selectedDeviceId;
      const codeReader = new ZXing.BrowserMultiFormatReader()
      console.log('ZXing code reader initialized')
      codeReader.listVideoInputDevices()
        .then((videoInputDevices) => {
          const sourceSelect = document.getElementById('sourceSelect')
          selectedDeviceId = videoInputDevices[0].deviceId
          if (videoInputDevices.length >= 1) {
            videoInputDevices.forEach((element) => {
              const sourceOption = document.createElement('option')
              sourceOption.text = element.label
              sourceOption.value = element.deviceId
              sourceSelect.appendChild(sourceOption)
            })

            sourceSelect.onchange = () => {
              selectedDeviceId = sourceSelect.value;
            };

            const sourceSelectPanel = document.getElementById('sourceSelectPanel')
            sourceSelectPanel.style.display = 'block'
          }

          document.getElementById('startButton').addEventListener('click', () => {
            codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
              if (result) {
                console.log(result)
                document.getElementById('result').textContent = result.text
              }
              if (err && !(err instanceof ZXing.NotFoundException)) {
                console.error(err)
                document.getElementById('result').textContent = err
              }
            })
            console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
          })

          document.getElementById('resetButton').addEventListener('click', () => {
            codeReader.reset()
            document.getElementById('result').textContent = '';
            console.log('Reset.')
          })

        })
        .catch((err) => {
          console.error(err)
        })
    })
  </script>


@endpush
