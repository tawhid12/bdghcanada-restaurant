@extends('backend.layout.admin_master')
@section('title', 'Gallery List')
@section('content')
<div class="content-wrapper container-xxl p-0">
	<div class="content-body">   
        <div class="row">
            <div class="col-12">
            <h4 class="mb-0">Dashboard</h4><div class="breadcrumb-wrapper"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{route(currentUser()."Dashboard")}}">{{ encryptor("decrypt", Session::get("username")) }}</a></li><li class="breadcrumb-item"><a href="#">Gallery</a></li><li class="breadcrumb-item">{{$restaurant->name}}</li><li class="breadcrumb-item active">List</li></ol></div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{$restaurant->name}} Image Gallery</h4>
                    </div>
                </div>
            </div>
            @if(count($gallerybyRestaurant))
                @foreach($gallerybyRestaurant as $count=>$gallery)
                <div class="col-4">  
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Card title</h4>
                            <h6 class="card-subtitle text-muted">Support card subtitle</h6>
                        </div>
                        <img src="{{asset('/')}}storage/images/gallery/{{$gallery->gallery_img}}" class="card-img-top" alt="" style="height: 15vw;object-fit:cover">
                        <div class="card-body">
                            <p class="card-text">Bear claw sesame snaps gummies chocolate.</p>
                            <a href="#" class="card-link">Delete</a>
                            <a href="#" class="card-link">Make Feature Image</a>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
        {{$gallerybyRestaurant->links()}}
</div>
@endsection
@push('scripts')
<script>
    @if( Session::has('response') )
    toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{Session::get('response')['message']}}");
    @endif
</script>
@endpush
