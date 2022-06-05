@extends('backend.layout.admin_master')
@section('title', 'Restaurant | Dashboard')
@push('styles')
    <!-- Include stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush
@section('content')
<div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Restaurant</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dasboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Profile</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-float waves-light" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg></button>
                            <div class="dropdown-menu dropdown-menu-end" style=""><a class="dropdown-item" href="app-todo.html"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square me-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square me-1"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail me-1"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar me-1"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-detached content-right">
                <div class="content-body">
                    <!-- E-commerce Products Starts -->
                    
                        <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                                <li class="nav-item">
                                    <a class="nav-link active" href="http://127.0.0.1:8000/users/profile">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>    
                                    Settings</a>
                                </li>
                            </ul>
                        </div>
                            <div class="card-body">
                                <form>
                                    <div class="row border-bottom">
                                    <h5 class="col-12 pb-2">Main Fields</h5>
                                    
                                        <div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
                                        
                                            <div class="form-group row mb-1">
                                                <label for="name" class="col-3 control-label text-right">Name</label>        
                                                <div class="col-9">
                                                    <input class="form-control" placeholder="Insert Name" name="name" type="text" value="" id="name">            
                                                </div>
                                            </div>
                                            <div class="form-group row mb-1">
                                                <label for="email" class="col-3 control-label text-right">Email</label>        
                                                <div class="col-9">
                                                    <input class="form-control" placeholder="Insert Email" name="email" type="text" value="manager@demo.com" id="email">            
                                                </div>
                                            </div>
                                        </div>
                                        <div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
                                        <div class="form-group row mb-1">
                                                <label for="password" class="col-3 control-label text-right">Password</label>        
                                                <div class="col-9">
                                                    <input class="form-control" placeholder="Insert Password" name="password" type="password" value="" id="password">
                                                </div>
                                            </div>
                                            <div class="form-group row  mb-1">
                                                <label for="avatar" class="col-3 control-label text-right">Avatar</label>
                                                <div class="col-9">
                                                    <input type="file" class="form-control" name="brandLogo" accept=".png, .jpg, .jpeg"/>
                                                    @if($errors->has('brandLogo'))
                                                        <small class="d-block text-danger mb-3">
                                                            {{ $errors->first('brandLogo') }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        
                                    </div>
                                    <div class="row">
                                    <h5 class="col-12 pt-2 pb-2">Custom Fields</h5>
                                        <div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
                                        
                                            <div class="form-group row mb-1">
                                                <label for="phone" class="col-3 control-label text-right">Phone</label>        
                                                <div class="col-9">
                                                    <input class="form-control" placeholder="Insert Phone" name="phone" type="text" value="" id="phone">            
                                                </div>
                                            </div>
                                            <div class="form-group row mb-1">
                                            <label for="phone" class="col-3 control-label text-right">Details</label> 
                                            <div class="col-9">    
                                            <div id="editor"></div>
</div>
                                            </div>

                                        </div>
                                        <div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
                                            <div class="form-group row mb-1">
                                                <label for="address" class="col-3 control-label text-right">Address</label>        
                                                <div class="col-9">
                                                    <input class="form-control" placeholder="Address Here" name="address" type="text" value="" id="address">            
                                                </div>
                                            </div>
                                            <div class="form-group row mb-1">
                                                <label for="address" class="col-3 control-label text-right">Verified Account</label>        
                                                <div class="col-9">
                                                    <input class="form-control" placeholder="Address Here" name="address" type="text" value="" id="address">            
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group col-12 d-md-flex justify-content-md-end">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        </div>  
                                    </div>
                             

                                </form>
                            </div>
                        </div>
                  
                    <!-- E-commerce Products Ends -->
                </div>
            </div>
            <div class="sidebar-detached sidebar-left">
                <div class="sidebar">
                    <!-- Ecommerce Sidebar Starts -->
                   
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h5 class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user font-medium-3 me-1"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></i> About Me</h5>
                            </div>
                            <div class="card-body">
                            <div class="box-profile card-body">
                                <div class="text-center">
                                    <img src="" class="profile-user-img img-fluid img-circle" alt="">
                                </div>
                                <h5 class="profile-username text-center">{{encryptor('decrypt',Session::get('name'))}}</h5>
                                <p class="text-muted text-center">{{encryptor('decrypt',Session::get('roleIdentity'))}}</p>
                                <a class="btn btn-outline-primary btn-block" href="mailto:{{encryptor('decrypt',Session::get('email'))}}"><i class="fa fa-envelope mr-2"></i>{{encryptor('decrypt',Session::get('email'))}}
                                </a>
                            </div>



                            </div>
                        </div>
                    
                    <!-- Ecommerce Sidebar Ends -->

                </div>
            </div>
        </div>


@endsection
@push('scripts')
<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<!-- Initialize Quill editor -->
<script>
  var quill = new Quill('#editor', {
    theme: 'snow'
  });
</script>
@endpush