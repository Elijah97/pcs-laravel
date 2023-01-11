@extends('dashboard.sidemenu')
@section('content')
    <div class="container-fluid Main_Content pad32">
        <div class="row">

            <div class="col-4">
                <div class="col-12 M_Card_0 pad32 text-center">
                    <img src="{{ URL::asset('images/avatar.png') }}" width="164px" height="164px"
                        class="rounded-circle M_Nav_Profile mabo16">
                    <br>
                    <button class="btn M_Link_Black mabo16">Edit profile</button>
                    <hr>
                    <p class="M_Txt_Title black">{{ Auth::user()->names }}</p>
                    <p class="M_Txt_Normal grey">{{ Auth::user()->email }}</p>
                    <button class="btn M_Btn_2 mato8">SAVE CHANGES</button>
                </div>
            </div>

            <div class="col-8">
                <div class="col-12 M_Card_0">

                    <ul class="nav nav-pills mb-0 justify-content-center setNav" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="student-tab" data-toggle="pill" href="#Student" role="tab"
                                aria-controls="pills-profile" aria-selected="false">Personal info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="teacher-tab" data-toggle="pill" href="#Teacher" role="tab"
                                aria-controls="pills-contact" aria-selected="false">Password</a>
                        </li>
                    </ul>


                    <p>@include('inc.messages')</p>


                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="Student" role="tabpanel" aria-labelledby="student-tab">
                            <div class="row">
                                <div class="col-12">
                                    <form method="POST" action="{{ route('updateInfo') }}" autocomplete="off">
                                        @csrf
                                        <div class="col-12 pad32">
                                            <p class="M_Txt_Title black mabo32">Edit personal info</p>

                                            <p class="M_Txt_Info black mabo8 mato16"><b>Full names</b></p>
                                            <input type="First" name="names" value="{{ Auth::user()->names }}"
                                                placeholder="First name" class="input M_Input_A  black">

                                            <p class="M_Txt_Info black mabo8 mato16"><b>Email</b></p>
                                            <input type="Email" name="email" value="{{ Auth::user()->email }}"
                                                placeholder="Email address" class="input M_Input_A  black" disabled>

                                            <p class="M_Txt_Info black mabo8 mato16"><b>Phone number</b></p>
                                            <input type="text" name="phone" value="{{ Auth::user()->phone }}"
                                                placeholder="Phone number" class="input M_Input_A mabo32 black">

                                            <button type="submit" class="btn M_Btn_2">SAVE CHANGES</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="Teacher" role="tabpanel" aria-labelledby="teacher-tab">
                            <div class="row">
                                <div class="col-12">
                                    <form method="POST" action="{{ route('updatePassword') }}" autocomplete="off">
                                        @csrf
                                        <div class="col-12 pad32">
                                            <p class="M_Txt_Title black mabo32">Edit your current password</p>

                                            <p class="M_Txt_Info black mabo8 mato16"><b>Current password</b></p>
                                            <input type="password" name="current-password" autofocus
                                                placeholder="Current password" class="input M_Input_A  black">

                                            <p class="M_Txt_Info black mabo8 mato16"><b>New password</b></p>
                                            <input type="password" name="new-password" placeholder="New password"
                                                class="input M_Input_A  black">

                                            <p class="M_Txt_Info black mabo8 mato16"><b>Re-type new password</b></p>
                                            <input type="password" name="new-password-confirm"
                                                placeholder="Re-type new password" class="input M_Input_A mabo32 black">

                                            <button type="submit" class="btn M_Btn_2">SAVE NEW PASSWORD</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
