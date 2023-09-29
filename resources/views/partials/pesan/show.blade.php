  <div class="col-md-9">
      <div class="card card-primary card-outline">
          <div class="card-header">
              <h3 class="card-title">Baca Pesan Masuk</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
              <div class="mailbox-read-info">
                  <h5>Subjek pesan : <b>{{ $showPesan->perihal }}</b></h5>
                  <h6 style="margin-top: 10px; margin-bottom: 10px;">
                      From: <span style="text-transform: uppercase;"><strong>{{ $showPesan->role }}</strong></span> -   
                      @if($showPesan->namaPengirim == 'admin')Kepala Sekolah @else {{ $showPesan->namaPengirim }} @endif

                      <span class="mailbox-read-time float-right">{{ $formattedTime }}</span>
                  </h6>
              </div>
              <!-- /.mailbox-read-info -->

              <!-- /.mailbox-controls -->


              <div class="mailbox-read-message">
                  <p>{{ $showPesan->isi_pesan }}</p>
              </div>
              <!-- /.mailbox-read-message -->
              <form action="{{ asset($route . '/pesan/balas/' . $showPesan->id_pengirim) }}" method="post">
                  @csrf
                  <input type="hidden" name="perihal" value="{{ $showPesan->perihal }}">
                   <input type="hidden" name="penerima" value="{{ $showPesan->role }}">
                  <div class="reply-box" style="display: none; margin-top:20px;">
                      <div class="form-group">
                          <label for="replyMessage">Balasan:</label>

                          <textarea id="compose-textarea" class="form-control" style="height: 300px" name="isi_pesan"></textarea>
                      </div>
                      <div class="form-group">
                          <button id="sendReplyBtn" type="submit" class="btn btn-primary"><i
                                  class="fas fa-paper-plane"></i> Kirim</button>
                      </div>
                  </div>
              </form>

          </div>
          <!-- /.card-body -->

          <!-- /.card-footer -->
          <div class="card-footer">
              <div class="float-right">
                  <button id="replyBtn" type="button" class="btn btn-default"><i class="fas fa-reply"></i>
                      Balas</button>
              </div>
          </div>
          <!-- /.card-footer -->
      </div>
      <!-- /.card -->
  </div>

  <style>
      .form-group {
          margin-bottom: 15px;
      }

      .reply-box {
          padding: 15px;
          background-color: #f8f8f8;
          border: 1px solid #ddd;
      }
  </style>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
      $(document).ready(function() {
          $('#replyBtn').on('click', function() {
              $('.reply-box').show();
              $(this).hide();
          });

          $('#sendReplyBtn').on('click', function() {
              var replyMessage = $('#replyMessage').val();
              $('#replyMessage').val('');
              $('.reply-box').hide();
              $('#replyBtn').show();
          });
      });
  </script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
      $(document).ready(function() {
          $('#replyBtn').on('click', function() {
              $('.reply-box').show();
              $(this).hide();
          });

          $('#sendReplyBtn').on('click', function() {
              var replyMessage = $('#replyMessage').val();
              $('.reply-box').hide();
              $('#replyBtn').show();
          });
      });
  </script>
