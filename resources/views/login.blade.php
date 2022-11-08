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

                <form method="POST" class="form-horizontal M_Set_field mato32" action="{{route('login')}}">
                    @csrf
                    <div class="row justify-content-center">

                        <div class="col-md-8 mabo32 pad0">
                            <p>@include('inc.messages')</p>
                        </div>

                        <div class="col-md-8 mabo32 pad0">
                            <label for="username" class="M_Txt_Set grey">Email</label>
                            <input class="form-control M_Txt_Normal mato8" type="email" name="email" placeholder="johndoe@minadef.gov.rw" aria-label="">
                        </div>

                        <div class="col-md-8 mabo32 pad0">
                            <label for="username" class="M_Txt_Set grey">Password</label>
                            <input name="password" class="form-control M_Txt_Normal mato8" type="password" password="password" placeholder="*************" aria-label="">
                        </div>

                        <div class="col-md-8 pad0">
                            <button type="submit" class="button-12" style="width:100%;">SIGN IN</button>
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