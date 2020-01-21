<div class="col-lg-6">
  <div class="card">
      <div class="card-header">
          <h2 class="h6 mb-0 text-uppercase">Messages</h2>
      </div>
      <div class="card-body">
          <div class="message-box">
            @if ($messages)
                  @if ($userMessage)
                    @foreach ($userMessage as $message)
                          <div class="row mt-2 mb-2">
                              <div class="col-md-2 user-prof">
                                  <div class="user-icon1"><img src="{{asset('img/user.svg')}}"></div>
                              </div>
                              <div class="col-md-6 outbox">{{$message->message}}</div>
                              <div class="col-md-4 text-gray-400 msg-time text-sm">
                                    @php
                                        $datePosted = $message->created_at;
                                        echo($datePosted->diffForHumans());
                                    @endphp
                              </div>
                          </div>
                    @endforeach
                  @endif
                      @foreach ($otherMessage as $message)
                        <div class="row mt-2 mb-2">
                            <div class="col-md-4 text-gray-400 msg-time-2 text-sm">
                                @php
                                    $datePosted = $message->created_at;
                                    echo($datePosted->diffForHumans());
                                @endphp
                            </div>
                            <div class="col-md-6 inbox">{{$message->message}}</div>
                            <div class="col-md-2 user-prof">
                                <div class="user-icon"><img src="{{asset('img/user.svg')}}"></div>
                            </div>
                        </div>
                      @endforeach
            @else
                <div class="file-icon text-center"><i class="fa fa-comments-o text-gray-300"></i></div>
                <div class="h5 text-center text-gray-500">You have no messages!</div>
            @endif
          </div>
      </div>
      <div class="card-footer">
          <form method="POST" action="/new-message">
                {{csrf_field()}}
              <div class="row message-area">
                  <div class="col-md-9">
                      <input name="order_id" value="{{$id}}" class="form-control hidden">
                      <input name="sender_id" class="form-control hidden">
                      <textarea name="message" class="form-control " placeholder="Write message..."></textarea>
                  </div>
                  <div class="col-md-2">
                      <button type="submit" class="send-btn btn btn-primary">Send</button>
                  </div>
              </div>
          <form>
      </div>
  </div>
</div>