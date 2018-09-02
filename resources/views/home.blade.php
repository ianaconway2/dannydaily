@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(isset($jail->out_of_jail_at) && strtotime($jail->out_of_jail_at) > time())
                <div class="alert alert-danger" role="alert">
                   You are in jail until {{ date('F d', strtotime($jail->out_of_jail_at)) }}
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="alert alert-warning" role="alert">
                {{ $remaining }} Days Remaining
            </div>

            @if(!isset($jail->out_of_jail_at) || strtotime($jail->out_of_jail_at) < time())

                <br>
                <div class="card">
                    <div class="card-header">Unlock New Card</div>
                    <div class="card-body card-padding">
                        <form action="{{ route('home.upload-card') }}" method="post" enctype="multipart/form-data" id="upload-card-form">
                            <div class="form-group">
                                <input type="file" name="file" class="form-control" onchange="$('#upload-card-form').submit()">
                            </div>
                        </form>
                    </div>
                </div>

            @endif

                <br>

            @foreach($unlocked as $item)
                @if($item->redeemed || $item->completed)
                    <div class="card border-success" onclick="window.location.href= '{{ route('cards.show', $item->id) }}'" style="cursor: pointer">
                        <div class="card-header bg-success"><b>Unlocked {{ date('F d', strtotime($item->unlocked_at)) }}</b></div>
                        <div class="card-body card-padding">
                            <table style="width: 100%">
                                <tr>
                                    <td style="vertical-align: top">
                                        <h4 style="margin-bottom:5px;"><b>{{ $item->title }}</b> | <small>{{ $item->series }}</small></h4>
                                        <small>{{ $item->description }}</small><br>
                                        @if($item->redeemed || $item->completed)
                                            <small class="text-success">{{ $item->redeemable ? 'Redeemed' : 'Completed' }} on {{ $item->redeemable ? date('F d', strtotime($item->redeemed_at)) : date('F d', strtotime($item->completed_at))  }}</small>
                                        @endif
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                @else
                    <div class="card border-warning" onclick="window.location.href= '{{ route('cards.show', $item->id) }}'" style="cursor: pointer">
                        <div class="card-header bg-warning"><b>Unlocked {{ date('F d', strtotime($item->unlocked_at)) }}</b></div>
                        <div class="card-body card-padding">
                            <table style="width: 100%">
                                <tr>
                                    <td style="width:150px;vertical-align: top">
                                        <img src="{{ $item->image_path }}" alt="" style="width:140px;">
                                    </td>
                                    <td style="vertical-align: top">
                                        <h4 style="margin-bottom:5px;"><b>{{ $item->title }}</b> | <small>{{ $item->series }}</small></h4>
                                        <small>{{ $item->description }}</small>
                                        <br><br>
                                        @if($item->redeemable)
                                            <a href="#" class="btn btn-warning btn-xs">Redeem Now</a>
                                        @elseif($item->completable)
                                            <a href="#" class="btn btn-outline-warning btn-xs text-black-50">Completed Now</a>
                                        @endif
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                @endif


                    <br>
            @endforeach

        </div>
    </div>
</div>
@endsection
