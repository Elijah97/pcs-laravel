@extends('layout')
@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-4 mato128">
            <div class="M_Card16">
                <div class="center">
                    <img src="images/logo.png" class="logo" alt=""><br />
                    <span class="M_Txt_Large grey">Petty Cash System</span><br />
                    <hr class="hr mato16">
                </div>

                <form method="POST" class="form-horizontal M_Set_field mato32" action="{{route('register')}}">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-8 mabo32 pad0">
                            <label for="name" class="M_Txt_Set grey">Full Names</label>
                            <input name="name" class="form-control M_Txt_Normal mato8" type="text" placeholder="John Doe" aria-label="" autofocus>

                            @error('name')
                            <div class="alert alert-danger alert-dismissible fade show  mato8" role="alert">
                                <span class="M_TXT_Err">{{ $message }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-8 mabo32 pad0">
                            <label for="username" class="M_Txt_Set grey">Email</label>
                            <input class="form-control M_Txt_Normal mato8" type="email" name="email" placeholder="johndoe@minadef.gov.rw" aria-label="">
                            @error('name')
                            <div class="alert alert-danger alert-dismissible fade show  mato8" role="alert">
                                <span class="M_TXT_Err">{{ $message }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-8 mabo32 pad0">
                            <label for="username" class="M_Txt_Set grey">Password</label>
                            <input class="form-control M_Txt_Normal mato8" type="password" name="password" placeholder="*************" aria-label="">

                            @error('password')
                            <div class="alert alert-danger alert-dismissible fade show  mato8" role="alert">
                                <span class="M_TXT_Err">{{ $message }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-8 mabo32 pad0">
                            <label for="username" class="M_Txt_Set grey"> User Type</label>
                            <select name="userType" class="custom-select M_select_A mabo16">
                                <option selected>Select Category</option>
                                <option value="0">Head DRD/Deputy</option>
                                <option value="1">Superior</option>
                                <option value="2">Applicant</option>
                                <option value="99">Sytem Admin</option>
                            </select>
                            @error('userType')
                            <div class="alert alert-danger alert-dismissible fade show  mato8" role="alert">
                                <span class="M_TXT_Err">{{ $message }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-8 pad0">
                            <button type="submit" class="button-12 text-uppercase" style="width:100%;">register</button>
                        </div>

                        <div class="col-md-8 mato32 mabo32 pad0 center">
                            <a href="forgot.html" class="green">
                                Forgot Password
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection