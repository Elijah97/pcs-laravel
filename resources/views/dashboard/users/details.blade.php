@extends('dashboard.sidemenu')
@section('content')
    <div class="container-fluid Main_Content pad32">
        <div class="row justify-content-center">

            <div class="col-8">
                <div class="col-12 mabo32 pad0">
                    <div class="col-12 M_Card_16 mabo32">
                        <div class="row mato16">
                            <div class="col-1">
                                <a href="/users" class="grey">
                                    <i class="material-icons">arrow_back</i>
                                </a>
                            </div>
                            <div class="col-4">
                                <span class="M_Txt_Normal M_Title text-uppercase">
                                    {{ $details[0]->rank }} {{ $details[0]->names }}
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 M_Card_16">
                        <div class="row pad16">
                            <div class="col-6">
                                <div class="row ">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Service N<sup>o</sup></span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light"> {{ $details[0]->serv_no }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Rank</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light"> {{ $details[0]->rank }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row pad16">
                            <div class="col-6">
                                <div class="row ">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Names</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light"> {{ $details[0]->names }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Gender</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light"> {{ $details[0]->gender }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row pad16">
                            <div class="col-6">
                                <div class="row ">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Email</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light"> {{ $details[0]->email }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Phone</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light"> {{ $details[0]->phone }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row pad16">
                            <div class="col-6">
                                <div class="row ">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Function</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light"> {{ $details[0]->function }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Unit</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light"> {{ $details[0]->unit }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="row pad16">
                            <div class="col-6">
                                <div class="row ">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> User Type</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light">
                                            @if ($details[0]->type == 0)
                                                Head / Deputy DRD
                                            @elseif($details[0]->type == 1)
                                                Superior
                                            @elseif($details[0]->type == 2)
                                                Applicant
                                            @else
                                                System Admin
                                            @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Status</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light">
                                            @if ($details[0]->status == 0)
                                                Pending
                                            @elseif($details[0]->status == 1)
                                                Active
                                            @elseif($details[0]->status == 2)
                                                Revoked
                                            @else
                                                Deleted
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
