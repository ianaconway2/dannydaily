@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if(!$card->unlocked)
                    <div class="card">
                        <div class="card-header">Locked Card</div>
                        <div class="card-body card-padding">
                            ???
                        </div>
                    </div>
                @else
                    <div>
                        @if($card->show_uploaded_as_thumb)
                            <img src="data:image/png;base64, {{ $card->uploaded_image }}" alt="" style="width:100%;">
                        @else
                            <img src="{{ $card->image_path }}" alt="" style="width:100%;">
                        @endif
                    </div>

                    <br>

                    @if(
                    ($card->redeemable && !$card->redeemed)
                    || ($card->completable && !$card->completed)
                   )
                        <div class="card border-success">
                            <div class="card-header bg-success">
                                <span class="text-white">{{ $card->redeemable ? 'Redeem' : 'Complete' }} Card Now</span>
                            </div>
                            <div class="card-body">
                                @if($card->should_upload_finished)
                                    <form action="{{ route('cards.upload-completed', $card->id) }}" method="post" enctype="multipart/form-data" id="upload-complete-form">
                                        <div class="form-group">
                                            <label for="file">Upload your answers to complete this card</label>
                                            <input name="file" id="file" type="file" class="form-control" onchange="$('#upload-complete-form').submit()">
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ route('cards.submit-completed', $card->id) }}" method="post">
                                        <div class="form-group">
                                            <label for="comments">{{ $card->complete_redeem_label !== '' ? $card->complete_redeem_label : 'Comments' }}</label>
                                            <textarea name="comments" id="comments" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger">{{ $card->redeemable ? 'Redeem' : 'Complete' }}</button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>

                    @endif

                    <br>

                    <div class="card border-secondary">
                        <div class="card-header bg-secondary text-white">{{ $card->series }}: {{ $card->title }}</div>
                        <div class="card-body">
                            @if($card->redeemed || $card->completed)
                                <div class="alert alert-success">
                                    <b>{{ $card->redeemable ? 'Redeemed' : 'Completed' }} on {{ $card->redeemable ? date('F d', strtotime($card->redeemed_at)) : date('F d', strtotime($card->completed_at))  }}</b>
                                </div>
                                {{ $card->complete_redeem_results }}


                                @if($card->should_upload_finished)
                                    <div>
                                        <img src="data:image/png;base64, {{ $card->finished_image }}" alt="" style="width:100%;">
                                    </div>
                                @endif

                                <hr>
                            @endif

                            {{ $card->description }}

                            <hr>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="{{ (count($totals->unlocked) / count($totals->all)) * 100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ (count($totals->unlocked) / count($totals->all)) * 100 }}%">
                                    <span class="sr-only">{{ (count($totals->unlocked) / count($totals->all)) * 100 }}% Complete (success)</span>
                                </div>
                            </div>
                            <small>You unlocked {{ count($totals->unlocked) }} out of {{ count($totals->all) }} cards like this</small>
                        </div>
                    </div>

                    <br>

                    @if(count($card->attachments) > 0)
                        <div class="card border-info">
                            <div class="card-header bg-info text-white">Attachments ({{ count($card->attachments) }})</div>
                            <div class="card-body">
                                @foreach($card->attachments as $attachment_item)
                                    <a href="{{ $attachment_item->file_path }}" target="_blank">
                                        <img src="{{ $attachment_item->file_path }}" alt="" style="width:100%">
                                    </a>
                                    <br>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
@endsection
