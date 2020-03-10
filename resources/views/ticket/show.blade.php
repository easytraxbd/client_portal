@extends('layouts.metronic')

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
                <h3 class="kt-portlet__head-title">
                    Ticket Details
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="{{route('ticket.index')}}" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        Back to Ticket
                    </a>
                    &nbsp;
                    <a href="/ticket/create" class="btn btn-info btn-icon-sm">
                        <i class="flaticon2-plus"></i> Add New
                    </a>
                </div>
            </div>
        </div>
        <br>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><strong>{{$ticket->title}}</strong></h4>
                                <p class="card-text">{!! $ticket->description !!}</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th scope="row">Type</th>
                                <td>{{$ticketTypeName}}</td>
                            </tr>
                            @if(isset($ticket->ticket_sub_type_id))
                                <tr>
                                    <th scope="row">Sub Type</th>
                                    <td>{{$ticketSubTypeName}}</td>
                                </tr>
                            @endif
                            @if(isset($ticket->call_type))
                                <tr>
                                    <th scope="row">Call Type</th>
                                    <td>{!! $ticket->call_type !!}</td>
                                </tr>
                            @endif
                            <tr>
                                <th scope="row">Status</th>
                                <td>{!! $ticket->status !!}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @foreach($commentsOfEmployee as $comment)
                    <div class="col-md-12">
                        <div class="row">
                            <div class="card offset-md-3 border-primary col-md-8">
                                <div class="card-body">
                                    <span class="pull-right">{{ $comment->created_at->format('F j, Y, g:i a') }}</span>
                                    <h4 class="card-title"><strong>{{$comment->user->first_name .' '. $comment->user->last_name}}</strong></h4>
                                    <p class="card-text">{!! $comment->comment !!}</p>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    @endforeach
                        @foreach($commentsOfClient as $comment)
                    <div class="col-md-12">
                        <div class="row">
                            <div class="card offset-md-1 border-success col-md-8">
                                <div class="card-body">
                                    <span class="pull-right">{{ $comment->created_at->format('F j, Y, g:i a') }}</span>
                                    <h4 class="card-title"><strong>{{$comment->client->name}}</strong></h4>
                                    <p class="card-text">{!! $comment->comment !!}</p>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                        @endforeach
                    <div class="col-md-12">
                        <div class="row">
                            <div class="card col-md-8 offset-md-1 border-success">
                                <form method="POST" action="{{route('comment.store')}}">
                                    @csrf
                                    <input name="ticket_id" type="hidden" value="{{$ticket->id}}">
                                    <label for="comment">Comment:</label>
                                    <textarea rows="4" name="comment" id="comment"
                                              class="form-control @error('comment') is-invalid @enderror border-success"
                                              placeholder="Enter your comment" required autofocus></textarea>
                                    @error('comment')
                                    <span class="form-text text-muted"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </form>
                            </div>
                        </div>

                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
@endsection
