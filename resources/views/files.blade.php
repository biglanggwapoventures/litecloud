<!doctype html>
<html lang="{{ app()->getLocale() }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/files.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/dropzone.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('plugins/dropzone/basic.min.css') }}"> -->

</head>
<body class="bg-light h-100">

    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-primary">
      <a class="navbar-brand font-weight-light" href="#"><i class="fa fa-cloud"></i> Lite Cloud Storage</a>
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#"><i class="fa fa-folder-open"></i> My Files <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fa fa-share-alt"></i> Sharing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fa fa-folder-o"></i> Archived</a>
          </li>
          <li class="nav-item d-none">
            <a class="nav-link" href="#">Switch account</a>
          </li>
          <li class="nav-item dropdown d-none">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
        <div class="row d-flex navigation position-sticky" style="top:0;z-index:10">
            <div class="col-md-9 pr-0">
                <div class="nav-scroller bg-white">
                    <nav class="nav nav-underline path">
                        <a class="nav-link" href="{{ route('browse.files') }}">{{ auth()->user()->email }}</a>
                        @php $partialPath = ''; @endphp
                        @foreach(explode('/', $path) as $segment)
                        @php $partialPath .= $segment; @endphp
                        <a class="nav-link" href="{{ route('browse.files', ['parameters' => $partialPath]) }}">{{ $segment }}</a>
                        @endforeach
                    </nav>
                </div>
            </div>
            <div class="col-md-3  pl-0">
                <div class="nav-scroller bg-white">
                    <nav class="nav nav-underline d-flex justify-content-end font-weight-light">
                        <a class="nav-link text-primary" data-toggle="modal" data-target="#new-folder-modal" style="cursor: pointer"><i class="fa fa-plus-circle"></i> Create new folder</a>
                        <a class="nav-link d-none" href="#">
                          Friends
                          <span class="badge badge-pill bg-light align-text-bottom">27</span>
                        </a>
                        <a class="nav-link text-primary" data-target="#upload-file-modal" data-toggle="modal" style="cursor: pointer"><i class="fa fa-cloud-upload"></i> Upload new file</a>
                    </nav>
                </div>
            </div>
    </div>

        <main class="container pt-5">
            @if($message = session('uploadSuccess'))
              <div class="row">
                <div class="col">
                  <div class="alert alert-success">{{ $message }}</div>
                </div>
              </div>
            @endif
            <div class="row">
                @foreach($files->subObjects as $subfile)
                <div class="col-sm-2">
                    <div class="file-box">
                        <div class="file">
                            <div class="custom-control custom-checkbox select-file-wrapper position-absolute mt-1 ml-2">
                              <input type="checkbox" class="custom-control-input select-file" id="check-{{ $subfile->id }}">
                              <label class="custom-control-label" for="check-{{ $subfile->id }}">&nbsp;</label>
                            </div>
                            <a href="{{ $subfile->is('folder') ? (url()->current() . '/' . $subfile->filename) : '' }}">
                                <span class="corner"></span>
                                <div class="icon">
                                    @if($subfile->is('folder'))
                                        <i class="fa fa-folder text-primary"></i>
                                    @else
                                        <i class="fa fa-file"></i>
                                    @endif
                                </div>
                                <div class="file-name text-truncate">
                                    {{ $subfile->filename }}
                                    <br>
                                    <small>Created: {{ $subfile->created_at->format('M d, Y') }}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </main>
        <div class="modal fade" id="new-folder-modal" tabindex="-1" role="dialog" aria-labelledby="new-folder-modal-label" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="new-folder-modal-label">Create new folder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              {!! Form::open(['url' => url()->current(), 'method' => 'POST', 'class' => 'ajax']) !!}
                  <div class="modal-body bg-light">
                    {!! Form::inputGroup('text', 'Folder Name', 'name') !!}
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary">Ok</button>
                  </div>
               {!! Form::close() !!}
            </div>
          </div>
        </div>
        <div class="modal fade" id="upload-file-modal" tabindex="-1" role="dialog" aria-labelledby="upload-file-modal-label" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="upload-file-modal-label">Upload files</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                  <div class="modal-body bg-light" style="min-height: 200px;">
                    {!! Form::open(['data-url' => route('browser.new.file', ['parameters' => $path]), 'method' => 'POST', 'class' => 'dropzone', 'id' => 'lite-dropzone']) !!}
                    {!! Form::close() !!}
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary" id="upload">Upload</button>
                  </div>
            </div>
          </div>
        </div>
      <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
      <script type="text/javascript" src="{{ asset('plugins/dropzone/dropzone.min.js') }}"></script>
      <script  type="text/javascript">
        Dropzone.autoDiscover = false;
        $(document).ready(function () {

            var myDropzone = new Dropzone("#lite-dropzone", {
                url: $('#lite-dropzone').data('url'),
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 100,
                addRemoveLinks: true,
                createImageThumbnails:true
            });

            myDropzone.on("complete", function(file) {
              window.location.reload()
            });

            $('#upload').on('click',function(e){
                e.preventDefault();
                myDropzone.processQueue();
            });

          $('[data-toggle="offcanvas"]').on('click', function () {
            $('.offcanvas-collapse').toggleClass('open')
          })

          $('.select-file').change(function () {
            var $this = $(this);

            if($this.prop('checked')){
                $('.select-file-wrapper').addClass('visible')
            }else{
                if($('.select-file').length === $('.select-file:not(:checked)').length){
                    $('.select-file-wrapper').removeClass('visible')
                }
            }
            console.log($(this).prop('checked'))
          })
        })
      </script>
</body>
</html>
