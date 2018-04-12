@extends('default')

@push('css')
<link rel="stylesheet" href="{{ asset('css/files.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/dropzone/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/fancybox/jquery.fancybox.min.css') }}">
@endpush

@section('body')
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

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
          </form>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ auth()->user()->email }}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="javascript:alert('Coming soon')">Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" onclick="javascript:document.getElementById('logout-form').submit()">Logout</a>
            {!! Form::open(['url' => route('logout'), 'method' => 'post', 'id' => 'logout-form']) !!}
            {!! Form::close() !!}
          </div>
        </li>

      </ul>

    </div>
  </nav>
      <div class="row d-flex navigation position-sticky" style="top:0;z-index:10">
          <div class="col-md-9 pr-0">
              <div class="nav-scroller bg-white">
                  <nav class="nav nav-underline path">
                      <a class="nav-link" href="{{ route('directory.browse') }}">{{ auth()->user()->email }}</a>
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
                      @if($currentDirectory)
                      <a class="nav-link text-primary" data-target="#upload-file-modal" data-toggle="modal" style="cursor: pointer"><i class="fa fa-cloud-upload"></i> Upload new file</a>
                      @endif
                  </nav>
              </div>
          </div>
  </div>

      <main class="container-fluid pt-3">
        <div class="row">
          <div class="col-sm-9">
            <div class="row">
              @foreach($subDirectories as $folder)
                <div class="col-sm-2 col-6">
                    <div class="file-box">
                        <div class="file">
                            <div class="custom-control custom-checkbox select-file-wrapper position-absolute mt-1 ml-2">
                              <input type="checkbox" class="custom-control-input select-file" id="check-{{ $folder->id }}">
                              <label class="custom-control-label" for="check-{{ $folder->id }}">&nbsp;</label>
                            </div>
                            <a href="{{ route('directory.browse', $folder) }}">
                                <span class="corner"></span>
                                <div class="icon">
                                    <i class="fa fa-folder text-primary"></i>
                                </div>
                                <div class="file-name text-truncate">
                                    {{ $folder->name }}
                                    <br>
                                    <small>{{ $folder->updated_at->format('M d, Y') }}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                @foreach($items as $item)
                <div class="col-sm-2 col-6">
                    <div class="file-box">
                        <div class="file">
                            <div class="custom-control custom-checkbox select-file-wrapper position-absolute mt-1 ml-2">
                              <input type="checkbox" class="custom-control-input select-file" id="check-{{ $item->id }}">
                              <label class="custom-control-label" for="check-{{ $item->id }}">&nbsp;</label>
                            </div>
                            <a href="{{ route('download.single', $item) }}">
                                <span class="corner"></span>
                                <div class="icon">
                                    <i class="fa {{ iconFromMime($item->mime_type) }} text-info"></i>
                                </div>
                                <div class="file-name text-truncate">
                                    {{ $item->file_name }}
                                    <br>
                                    <small>{{ $item->updated_at->format('M d, Y') }}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
          </div>
          <div class="col-sm-3">

          </div>
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
            {!! Form::open(['url' => route('directory.create', $currentDirectory), 'method' => 'POST', 'class' => 'ajax']) !!}
                <div class="modal-body bg-light">
                  {!! Form::inputGroup('text', 'Folder Name', 'name') !!}
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="cd" value="1">
                    <label class="custom-control-label" for="customCheck1">Change to this directory</label>
                  </div>
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
                  {!! Form::open(['data-url' => route('directory.put', $currentDirectory), 'method' => 'PUT', 'class' => 'dropzone', 'id' => 'lite-dropzone']) !!}
                  {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-outline-primary" id="upload">Upload</button>
                </div>
          </div>
        </div>
      </div>

</body>
@endsection


@push('js')
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/dropzone/dropzone.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/fancybox/jquery.fancybox.min.js') }}"></script>
<script  type="text/javascript">
  Dropzone.autoDiscover = false;
  $(document).ready(function () {

      var myDropzone = new Dropzone("#lite-dropzone", {
          url: $('#lite-dropzone').data('url'),
          autoProcessQueue: false,
          uploadMultiple: true,
          parallelUploads: 100,
          maxFiles: 5,
          addRemoveLinks: true,
          createImageThumbnails:true,
          timeout: 180000,
      });

      myDropzone.on("error", function(file) {
        window.alert('Upload timeout / internal server error');
      });

      myDropzone.on("success", function(file) {
        window.location.reload();
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
@endpush
