@extends('admin.app')
@section('content')
    <div id="content" class="app-content">
        <div class="container">

            <div class="row gx-2 mb-50px">
                <div class="col-lg-4 col-sm-6">
                    <div class="widget widget-stats bg-teal mb-7px">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                        <div class="stats-content">
                            <div class="stats-title">USERS</div>
                            <div class="stats-number">{{ $users }}</div>
                            <div class="stats-progress progress">
                                <div class="progress-bar" style="width: 70.1%;"></div>
                            </div>
                            <div class="stats-desc">Better than last week (70.1%)</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="widget widget-stats bg-blue mb-7px">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
                        <div class="stats-content">
                            <div class="stats-title">POSTS</div>
                            <div class="stats-number">{{ $posts }}</div>
                            <div class="stats-progress progress">
                                <div class="progress-bar" style="width: 40.5%;"></div>
                            </div>
                            <div class="stats-desc">Better than last week (40.5%)</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="widget widget-stats bg-purple mb-7px">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
                        <div class="stats-content">
                            <div class="stats-title">ROLES</div>
                            <div class="stats-number">{{ $roles }}</div>
                            <div class="stats-progress progress">
                                <div class="progress-bar" style="width: 76.3%;"></div>
                            </div>
                            <div class="stats-desc">Better than last week (76.3%)</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="widget widget-stats bg-dark mb-7px">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-comment-alt fa-fw"></i></div>
                        <div class="stats-content">
                            <div class="stats-title">PERMISSIONS</div>
                            <div class="stats-number">{{ $permission }}</div>
                            <div class="stats-progress progress">
                                <div class="progress-bar" style="width: 54.9%;"></div>
                            </div>
                            <div class="stats-desc">Better than last week (54.9%)</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="widget widget-stats bg-orange mb-7px">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-file-alt fa-fw"></i></div>
                        <div class="stats-content">
                            <div class="stats-title">PENDING INVOICE</div>
                            <div class="stats-number">20</div>
                            <div class="stats-progress progress">
                                <div class="progress-bar" style="width: 23.5%;"></div>
                            </div>
                            <div class="stats-desc">More than last week (23.5%)</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="widget widget-stats bg-pink mb-7px">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-exclamation-triangle fa-fw"></i></div>
                        <div class="stats-content">
                            <div class="stats-title">ERROR LOG</div>
                            <div class="stats-number">5</div>
                            <div class="stats-progress progress">
                                <div class="progress-bar" style="width: 10.5%;"></div>
                            </div>
                            <div class="stats-desc">More than last week (10.5%)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
