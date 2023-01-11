@extends('dashboard.sidemenu')
@section('content')
    <div class="container-fluid Main_Content pad32">
        <div class="row">

            <div class="col-12">
                <div class="col-12 mabo32 pad0">
                    <div class="col-12 M_Card_16 mabo32">
                        <div class="row">
                            <div class="col-6">
                                <span class="M_Txt_Title black">{{ count($applications) }} Applications</span>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <form action="{{ route('downloadPDF') }}" method="POST" class="form">
                                        @csrf
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-3">
                                                    <span class="M_Txt_Info black "> From: </span>
                                                </div>
                                                <div class="col-6">
                                                    <input type="date" name="downloadFrom" value=""
                                                        class="input M_Input_B black ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4" style="margin-left: 20px">
                                            <div class="row">
                                                <div class="col-3">
                                                    <span class="M_Txt_Info black "> To: </span>
                                                </div>
                                                <div class="col-6">
                                                    <input type="date" name="downloadTo" value=""
                                                        class="input M_Input_B black ">
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn M_Icon_Btn  ml-4 fright" role="button">
                                            <i class="material-icons" style="font-size: 16px;">download</i>
                                        </button>
                                        {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                            <p class="dropdown-item-text M_Txt_Normal" href="#">Download</p>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item M_Txt_Normal grey"
                                                href="{{ URL::to('/application/pdf') }}">PDF</a>
                                        </div> --}}
                                    </form>
                                    <div class="col-4">

                                        <div class="btn-group fright">
                                            <a href="" class="btn M_Icon_Btn  ml-2" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown">
                                                <i class="material-icons" style="font-size: 16px;">filter_list</i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <p class="dropdown-item-text M_Txt_Normal" href="#">Filter list
                                                </p>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item M_Txt_Normal grey" href="#">Active</a>
                                                <a class="dropdown-item M_Txt_Normal grey" href="#">Inactive</a>
                                            </div>
                                        </div>

                                        <div class="btn-group fright">
                                            <a href="" class="btn M_Icon_Btn  ml-2" role="button"
                                                id="dropdownMenuLink2" data-toggle="dropdown">
                                                <i class="material-icons" style="font-size: 16px;">sort</i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                    <div class="col-12 M_Card_16">
                        <table id="example" class="table table-md table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Rank</th>
                                    <th scope="col">Names</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Application Title</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Date applied</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Reviewed By</th>
                                    <th scope="col">Approved By</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $app)
                                    <tr>
                                        <td scope="row">{{ $index++ }}</td>
                                        <td>{{ $app->rank }}</td>
                                        <td>{{ $app->names }}</td>
                                        <td>{{ $app->phone }}</td>
                                        <td>{{ $app->title }}</td>
                                        <td>{{ $app->department }}</td>
                                        <td>{{ date('d-m-Y', strtotime($app->created_at)) }}</td>
                                        <td>{{ $app->qty }}</td>
                                        <td>{{ number_format($app->totalPrice) }} Rwf</td>
                                        <td>
                                            @if ($app->reviewerId == '')
                                                ---
                                                @else{{ $app->reviewerRank . ' ' . $app->reviewerName }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($app->approverId == '')
                                                ---
                                                @else{{ $app->approverRank . ' ' . $app->approverName }}
                                            @endif
                                        </td>
                                        @if ($app->reviewStatus == 0 && $app->approveStatus == 0)
                                            <td>Pending for review</td>
                                        @elseif($app->reviewStatus == 2)
                                            <td>Review revoked</td>
                                        @elseif($app->reviewStatus == 1 && $app->approveStatus == 0)
                                            <td>Pending for approve</td>
                                        @elseif($app->reviewStatus == 1 && $app->approveStatus == 1)
                                            <td class="greenHard">Request approved</td>
                                        @elseif($app->reviewStatus == 1 && $app->approveStatus == 2)
                                            <td class="red">Request revoked</td>
                                        @endif

                                        <td>
                                            <a href="/application/{{ $app->id }}/details" class="grey"><span
                                                    class=""><i
                                                        class="material-icons actionIcons">visibility</i></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>

        </div>
    </div>
@endsection
