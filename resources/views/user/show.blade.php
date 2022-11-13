    @extends('layout.home')
    @section('title')
        <title>We Love One Piece</title>
    @endsection
    @section('header')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    @endsection
    @section('content')


    <div class="card card-widget">
                <div class="card-header">
                    <div class="user-block">
                    <img class="img-circle" src="{{$pertanyaan->user->profile->getAvatar()}}" alt="User Image">
                    <span class="username"><a href="#">{{$pertanyaan->user->profile->nama_lengkap}}</a></span>
                    <span class="description">{{$pertanyaan->created_at->diffForHumans()}}</span>
                    </div>
                    <!-- /.user-block -->
                    <?php $if_null = App\Models\Pertanyaan::where('user_id','=', $pertanyaan->user->id)->first() ?>
                    @if ($if_null->user_id==Auth::user()->id || Auth::user()->role === 'admin')
                    <div class="card-tools">
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle text-dark" data-toggle="dropdown">
                        <i class="fas fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <a href="/forum/edit/{{$pertanyaan->id}}" class="dropdown-item">Edit</a>
                        <form action="/forum/hapus/{{$pertanyaan->id}}" method="POST">
                            @csrf
                            <input type="submit" value="Delete" class="dropdown-item btn btn-light btn-sm">
                        </form>
                        </div>
                    </div>
                    </div>
                    @else

                    @endif
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- post text -->
                    <p>{!!$pertanyaan->isi!!}</p>
                    <!-- Attachment -->
                    <!-- /.attachment-block -->

                    <!-- Social sharing buttons -->
                    <span class="float-right text-muted">{{$pertanyaan->komentar_pertanyaan->count()}} comments</span>
                </div>
                <!-- /.card-body -->
            {{-- {awal komentar --}}
            @foreach ($pertanyaan->komentar_pertanyaan as $komentar)
                <div class="card-footer card-comments">
                    <div class="card-comment">
                    <!-- User image -->
                    <img class="img-circle img-sm" src="{{$komentar->user->profile->getAvatar()}}" alt="User Image">

                    <div class="comment-text">
                        <span class="username">
                        {{$komentar->user->profile->nama_lengkap}}
                        <span class="text-muted float-right">{{$komentar->created_at->diffForHumans()}}</span>
                        </span><!-- /.username -->
                        {{$komentar->isi}}
                    </div>
                    <!-- /.comment-text -->
                    </div>
                </div>
            @endforeach
    {{-- akhir komentar --}}
                <!-- /.card-footer -->
                <div class="card-footer">
                    <form action="/forum/komentar_pertanyaan/{{$pertanyaan->id}}" method="POST">
                    @csrf
                    <img class="img-fluid img-circle img-sm" src="{{auth()->user()->profile->getAvatar()}}" alt="Alt Text">
                    <!-- .img-push is used to add margin to elements next to floating images -->
                    <div class="img-push">
                        <input type="text" name="komentar" class="form-control form-control-sm" placeholder="Press enter to post comment">
                    </div>
                    </form>
                </div>
                <!-- /.card-footer -->
                </div>

        
@endsection
