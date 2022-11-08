<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>DRD - Petty Cash System - Dashboard</title>
    <style type="text/css">
        /* table td,
        table th {
            border: 1px solid rgb(244, 244, 244);
        } */
        * {
            font-family: sans-serif !important;
            /* Change your font family */
        }

        .content-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 12px;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .content-table thead tr {
            background-color: #4e5c46;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
            text-transform: uppercase;
        }

        .content-table th,
        .content-table td {
            padding: 12px 15px;
        }

        .content-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .content-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .content-table tbody tr:last-of-type {
            border-bottom: 2px solid #4e5c46;
        }

        .content-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }

        h1 {
            font-family: sans-serif;
            letter-spacing: 0.2em;
            text-align: center;
            text-transform: uppercase;
        }

        header {
            border-bottom: rgb(224, 224, 224) solid 2px;
        }

        .header {
            background: #4e5c46;
            padding: 5px;
            border-radius: 4px;
            color: #ffffff;
        }

        caption {
            font: bold 100% sans-serif;
            text-align: center;
            text-transform: uppercase;
            padding: 15px;
            margin-bottom: 10px;
        }

        caption h1 {
            text-align: center;
            text-decoration: underline
        }
    </style>

</head>

<body>


    <div class="container-fluid Main_Content pad32">
        <div class="row">

            <div class="col-12">
                <div class="col-12 mabo32 pad0">

                    <div class="col-12 M_Card_16">
                        <header>
                            <div class="header">
                                <h1 style="font-size: 16px; font-weight: 600">REPORT</h1>
                            </div>
                            <center>
                                <img alt="" style="margin-top: 20px"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo.png'))) }}"
                                    width="100" height="100">
                                <h1 style="font-size: 18px; font-weight: 600">
                                    Ministry of Defence <br /><br />
                                    Defence Research and Development
                                </h1>
                            </center>
                        </header>
                        <h1 style="margin-top: 32px; font-size: 18px; font-weight: 300">PETTY CASH SINGLE APPLICATION
                            REPORT</h1>
                        <div style="padding: 16px; font-size: 14px">
                            <p><b>Date</b>: {{ date('d-m-Y', strtotime($application[0]->created_at)) }}</p>
                            <p><b>SVC N <sup>0</sup></b>: {{ $application[0]->serv_no }}</p>
                            <p><b>Rank</b>: {{ $application[0]->rank }}</p>
                            <p><b>Names</b>: {{ $application[0]->names }}</p>
                            <p><b>Phone</b>: {{ $application[0]->phone }}</p>
                            <p><b>Function</b>: {{ $application[0]->function }}</p>
                            <p><b>Unit</b>: {{ $application[0]->unit }}</p>
                            <p><b>Department</b>: {{ $application[0]->department }}</p>
                        </div>
                        <hr />
                        <table class="content-table" style="table-layout:fixed; width: 100%">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:5%;">#</th>
                                    <th scope="col">Application Title</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Reason</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <span style="display: none">{{ $index = 1 }}</span>
                                <tr>
                                    <td scope="row" style="text-align: center">{{ $index++ }}</td>
                                    <td>{{ $application[0]->title }}</td>
                                    <td style="text-align: center">{{ $application[0]->qty }}</td>
                                    <td style="text-align: center">{{ $application[0]->totalPrice }} Rwf</td>
                                    <td>{{ $application[0]->reason }}</td>

                                    @if ($application[0]->reviewStatus == 0 && $application[0]->approveStatus == 0)
                                        <td>Pending for review</td>
                                    @elseif($application[0]->reviewStatus == 2)
                                        <td>Review revoked</td>
                                    @elseif($application[0]->reviewStatus == 1 && $application[0]->approveStatus == 0)
                                        <td>Pending for approve</td>
                                    @elseif($application[0]->reviewStatus == 1 && $application[0]->approveStatus == 1)
                                        <td style="color: #4ab658">Request approved</td>
                                    @elseif($application[0]->reviewStatus == 1 && $application[0]->approveStatus == 2)
                                        <td style="color: #cf5858">Request revoked</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>

                        <table width="100%" style="text-align: center; margin-top: 16px">
                            <tr>
                                <td>Applicant Signature</td>
                                <td>Immediate Superior</td>
                                <td>Approved by: Head/Deputy DRD</td>
                            </tr>
                            <tr style="font-weight: bold">
                                <td style="padding-top: 32px">
                                    {{ $application[0]->rank . ' ' . $application[0]->names }}
                                </td>
                                <td style="padding-top: 32px">
                                    @if ($application[0]->reviewerId == '')
                                        ---
                                        @else{{ $application[0]->reviewerRank . ' ' . $application[0]->reviewerName }}
                                    @endif
                                </td>
                                <td style="padding-top: 32px">
                                    @if ($application[0]->approverId == '')
                                        ---
                                        @else{{ $application[0]->approverRank . ' ' . $application[0]->approverName }}
                                    @endif
                                </td>
                            </tr>

                            <tr style="font-weight: bold">
                                <td style="padding-top: 32px">
                                    {{ date('d-m-Y', strtotime($application[0]->neededBy)) }}
                                </td>
                                <td style="padding-top: 32px">
                                    @if ($application[0]->reviewerId == '')
                                        ---
                                        @else{{ date('d-m-Y', strtotime($application[0]->reviewedDate)) }}
                                    @endif
                                </td>
                                <td style="padding-top: 32px">
                                    @if ($application[0]->approverId == '')
                                        ---
                                        @else{{ date('d-m-Y', strtotime($application[0]->approvedDate)) }}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>


                </div>
            </div>

        </div>
    </div>
    <script src="{{ URL::asset('js/jquery.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/wow.min.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="{{ URL::asset('js/scripts.js') }}"></script>
</body>

</html>
