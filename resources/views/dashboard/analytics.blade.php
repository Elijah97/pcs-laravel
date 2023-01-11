@extends('dashboard.sidemenu')
@section('content')
    <div class="container-fluid Main_Content pad32">
        <div class="row">

            <div class="col-12">
                <div class="row">

                    <div class="col-3">
                        <div class="row col-12 M_Card_16 mabo32">
                            <div class="col-2">
                                <span class="material-icons analyticsIcon">
                                    attach_money
                                </span>
                            </div>
                            <div class="col-10">

                                <p class="M_Txt_Large text-uppercase green">
                                    {{ $current_budget ? number_format($current_budget[0]->amount + $current_budget[0]->expenses) : '0' }} Rwf</p>
                                <p class="M_Txt_Info grey"> This Month's budget</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="row col-12 M_Card_16 mabo32">
                            <div class="col-2">
                                <span class="material-icons analyticsIcon">
                                    payment
                                </span>
                            </div>
                            <div class="col-10">
                                <p class="M_Txt_Large text-uppercase green">
                                   {{ $current_budget ? number_format($current_budget[0]->expenses) : '0' }} Rwf</p>
                                <p class="M_Txt_Info grey"> This Month's Expenses</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-3">
                        <div class="row col-12 M_Card_16 mabo32">
                            <div class="col-2">
                                <span class="material-icons analyticsIcon">
                                    inbox
                                </span>
                            </div>
                            <div class="col-10">
                                <p class="M_Txt_Large text-uppercase green"> {{ count($all_applications) }}</p>
                                <p class="M_Txt_Info grey"> Total Applications</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-3">
                        <div class="row col-12 M_Card_16 mabo32">
                            <div class="col-2">
                                <span class="material-icons analyticsIcon">
                                    pending_actions
                                </span>
                            </div>
                            <div class="col-10">
                                <p class="M_Txt_Large text-uppercase green"> {{ count($pending_applications) }}</p>
                                <p class="M_Txt_Info grey"> Pending Applications</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="row col-12 M_Card_16 mabo32">
                            <div class="col-2">
                                <span class="material-icons analyticsIcon">
                                    fact_check
                                </span>
                            </div>
                            <div class="col-10">
                                <p class="M_Txt_Large text-uppercase green"> {{ count($approved_applications) }}</p>
                                <p class="M_Txt_Info grey"> Approved Applications</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="row col-12 M_Card_16 mabo32">
                            <div class="col-2">
                                <span class="material-icons analyticsIcon">
                                    playlist_remove
                                </span>
                            </div>
                            <div class="col-10">
                                <p class="M_Txt_Large text-uppercase green"> {{ count($revoked_applications) }}</p>
                                <p class="M_Txt_Info grey"> Revoked Applications</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="row col-12 M_Card_16 mabo32">
                            <div class="col-2">
                                <span class="material-icons analyticsIcon">
                                    group
                                </span>
                            </div>
                            <div class="col-10">
                                <p class="M_Txt_Large text-uppercase green">
                                    {{ count($total_users) }}</p>
                                <p class="M_Txt_Info grey"> Total Users</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="row col-12 M_Card_16 mabo32">
                            <div class="col-2">
                                <span class="material-icons analyticsIcon">
                                    category
                                </span>
                            </div>
                            <div class="col-10">
                                <p class="M_Txt_Large text-uppercase green">
                                    {{ count($total_categories) }}</p>
                                <p class="M_Txt_Info grey"> Available Categories</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="col-12 M_Card_16 mabo32">
                            <p class="M_Txt_Info grey pad32"> Graph</p>
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="col-12 M_Card_16 mabo32">
                            <p class="M_Txt_Info grey pad32"> Graph</p>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="col-12 M_Card_16 mabo32">
                            <p class="M_Txt_Info grey pad32"> Graph</p>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="col-12 M_Card_16 mabo32">
                            <p class="M_Txt_Info grey pad32"> Graph</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
