@extends('dashboard.sidemenu')
@section('content')
    <div class="container-fluid Main_Content pad32">
        <div class="row justify-content-center">

            <div class="col-8">
                <p>@include('inc.messages')</p>
                <div class="col-12 mabo32 pad0">
                    <div class="col-12 M_Card_16 mabo32">

                        <div class="row mato16">
                            <div class="col-1">
                                <a href="/applications" class="grey">
                                    <i class="material-icons">arrow_back</i>
                                </a>
                            </div>
                            <div class="col-3">
                                <span class="M_Txt_Normal M_Title text-uppercase">
                                    {{ $application[0]->title }}
                                </span>
                            </div>


                            <div class="col-3">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="M_Txt_Normal text-uppercase">Date Expected:
                                </span>
                                <span class="M_Txt_Normal_light">{{ date('d-m-Y', strtotime($application[0]->neededBy)) }}
                                </span>
                            </div>

                            {{-- For reviewer --}}
                            @if (Auth::user()->type == 1)
                                <div class="col-5">
                                    <form method="POST" action="{{ route('changeReviewStatus') }}" class="form"
                                        autocomplete="off">
                                        @csrf
                                        <div class="row">
                                            <div class="col-3">
                                                <span class="M_Txt_Normal M_Title text-uppercase">
                                                    Status:
                                                </span>
                                            </div>
                                            <div class="col-5">
                                                <input type="hidden" name="applicationId"
                                                    value="{{ $application[0]->id }}">
                                                <input type="hidden" name="reviewerId" value="{{ Auth::user()->id }}">
                                                <select class="M_select_B" name="reviewStatus">
                                                    <option value="0"
                                                        {{ $application[0]->reviewStatus == 0 ? 'selected' : '' }}>
                                                        Pending
                                                    </option>
                                                    <option value="1"
                                                        {{ $application[0]->reviewStatus == 1 ? 'selected' : '' }}>
                                                        Approved
                                                    </option>
                                                    <option value="2"
                                                        {{ $application[0]->reviewStatus == 2 ? 'selected' : '' }}>
                                                        Revoked
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-3 ">
                                                <button type="submit" class="btn M_Btn_3 text-uppercase">
                                                    Save changes
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif

                            {{-- For Approver --}}
                            @if (Auth::user()->type == 0 && $application[0]->reviewStatus == 1)
                                <div class="col-5">
                                    <form method="POST" action="{{ route('changeApproveStatus') }}" autocomplete="off">
                                        @csrf
                                        <div class="row">
                                            <div class="col-2">
                                                <span class="M_Txt_Normal M_Title text-uppercase">
                                                    Status:
                                                </span>
                                            </div>
                                            <div class="col-5">
                                                <input type="hidden" name="applicationId"
                                                    value="{{ $application[0]->id }}">
                                                <input type="hidden" name="approverId" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="requestedAmount"
                                                    value="{{ $application[0]->totalPrice }}">
                                                <input type="hidden" name="dateExpected"
                                                    value="{{ $application[0]->neededBy }}">
                                                <select class="M_select_B" name="approveStatus">
                                                    <option value="0"
                                                        {{ $application[0]->approveStatus == 0 ? 'selected' : '' }}>
                                                        Pending
                                                    </option>
                                                    <option value="1"
                                                        {{ $application[0]->approveStatus == 1 ? 'selected' : '' }}>
                                                        Approved
                                                    </option>
                                                    <option value="2"
                                                        {{ $application[0]->approveStatus == 2 ? 'selected' : '' }}>
                                                        Revoked
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <button type="submit" class="btn M_Btn_3">
                                                    Save changes
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif

                        </div>
                    </div>


                    <div class="col-12 M_Card_16">
                        <div class="row pad16">
                            <div class="col-6">
                                <div class="row ">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Rank</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light"> {{ $application[0]->rank }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Names</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light"> {{ $application[0]->names }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row pad16">
                            <div class="col-6">
                                <div class="row ">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Phone</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light"> {{ $application[0]->phone }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Department</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light"> {{ $application[0]->department }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row pad16">
                            <div class="col-6">
                                <div class="row ">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Category</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light"> {{ $application[0]->categoryName }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Reason</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light"> {{ $application[0]->reason }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row pad16">
                            <div class="col-6">
                                <div class="row ">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Quantity</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light"> {{ $application[0]->qty }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Total Price</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light"> {{ number_format($application[0]->totalPrice) }}
                                            Rwf</span>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="row pad16">
                            <div class="col-6">
                                <div class="row ">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black "> Reviewed by</span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light">
                                            @if ($application[0]->reviewerId != '')
                                                {{ $application[0]->reviewerRank . ' ' . $application[0]->reviewerName }}
                                        </span>
                                    @else
                                        ------
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black ">
                                            Reviewed On:
                                        </span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light">
                                            @if ($application[0]->reviewedDate != '')
                                                {{ date('d-m-Y', strtotime($application[0]->reviewedDate)) }}
                                            @else
                                                ------
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row pad16">

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black ">
                                            @if ($application[0]->approveStatus == 0)
                                                Pending
                                            @elseif($application[0]->approveStatus == 1)
                                                Approved by
                                            @elseif($application[0]->approveStatus == 2)
                                                Revoked by
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light">
                                            @if ($application[0]->approverId != '')
                                                {{ $application[0]->approverRank . ' ' . $application[0]->approverName }}
                                            @else
                                                ------
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-6">
                                <div class="row ">
                                    <div class="col-3">
                                        <span class="M_Txt_Normal black ">
                                            @if ($application[0]->approveStatus == 0)
                                                Pending
                                            @elseif($application[0]->approveStatus == 1)
                                                Approved On
                                            @elseif($application[0]->approveStatus == 2)
                                                Revoked On
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-1">
                                        <span class="M_Txt_Normal black "> :</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="M_Txt_Normal_light">
                                            @if ($application[0]->approvedDate != '')
                                                {{ date('d-m-Y', strtotime($application[0]->approvedDate)) }}
                                        </span>
                                    @else
                                        ------
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row pad16 mato32 justify-content-center">
                            <div class="col-1">
                                <a href="/application/{{ $application[0]->id }}/singlepdf"
                                    class="btn M_Btn_3 text-uppercase" title="Download report">
                                    <i class="material-icons" style="font-size: 16px;">download</i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
