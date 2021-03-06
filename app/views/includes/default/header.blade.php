<header>
<nav class="navbar navbar-nav navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                <div class="navbar-collapse collapse" >
                  <ul class="nav navbar-nav navbar-left">
                    <li>
                        <i class="glyphicon glyphicon-fire" style="padding-left:5px;padding-right:5px;font-size:50px;background:#f8f8f8;-webkit-border-bottom-right-radius: 4px;
                                                              -webkit-border-bottom-left-radius: 4px;
                                                              -moz-border-radius-bottomright: 4px;
                                                              -moz-border-radius-bottomleft: 4px;
                                                              border-bottom-right-radius: 4px;
                                                              border-bottom-left-radius: 4px;" aria-hidden="true"></i>
                    </li>
                    <li>
                        {{APP_NAME}}
                    </li>
                  </ul>
                </div>
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse   " id="bs">
                <ul class="nav navbar-nav navbar-right">
                    <li> 
                        <a href="#" data-toggle="modal" data-target="#reservationModal" data-whatever=""><i class="fa fa-github fa-fw"></i> Reservation List</a>
                    </li>
                    <li>
                        <a href="{{URL::action('static.about')}}"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i> About</a>
                    </li>
                    <li>
                        <a href="{{URL::action('static.explore')}}"><i class="glyphicon glyphicon-barcode" aria-hidden="true"></i>  Explore</a>
                    </li>

                    <li>
                        <a href="#" data-toggle="modal" data-target="#contactModal" data-whatever=""><i class="glyphicon glyphicon-phone-alt" aria-hidden="true"></i> Contact</a>
                    </li>
                     <li>
                        <a href="{{URL::action('account.login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i>  User's Login</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Modal Send Inquiry -->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            {{Form::open(['route' => 'guest.mail.create' , 'method' => 'post'])}}
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="contactModalLabel">Contact Us</h4>
              For urgent matters, please call or text  <br/><strong>Tel: 696-4316</strong>
              <br/> <strong>Mobile: 0927-500-5257 </strong>
          </div>
          <div class="modal-body">
              <div class="form-group">
                {{Form::text('sendername', null, ['class' => 'form-control' ,'placeholder' => 'Fullname'])}}
                {{Form::hidden('receiveremail' , 'mail.sunrock@gmail.com')}}
                {{Form::hidden('receivername' ,  'System')}}
                {{Form::hidden('subject' ,'Message[Via Contact]')}}
              </div>
              <div class="form-group">
                 {{Form::email('senderemail' , null ,['class' => 'form-control' ,'style' => 'height:34px', 'placeholder' => 'Your Email Address'])}}
              </div>
              <div class="form-group">
                <label for="message-text" class="control-label">Concern</label>
                  {{Form::textarea('message' , null , ['class' => 'form-control'])}}
              </div>
          </div>
          
          <div class="modal-footer">
         
            
            {{Form::Submit('Send' , ['class' => 'btn btn-primary'])}}
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            {{Form::Close()}}
          </div>
        </div>
      </div>
    </div>
     <!-- Modal Reservation -->
    <div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModal" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="reservationModalLabel">My Reservations</h4>
            <h5>
              <div class="row">
                  <div class='col-md-6'>
                    @if(Session::get('email'))
                    E-mail Address: {{Session::get('email')}}<br/>
                    @elseif (Session::get('account_info')['email'])
                    E-mail Address: {{Session::get('account_info')['email']}}<br/>
                    @endif
                    @if(Session::get('date_info'))
                      Children : {{Session::get('date_info')['children']}}<br/>
                      Adult: {{Session::get('date_info')['adult']}} <br/>
                      Total Duration: {{Session::get('date_info')['lenofstay']}} days.
                    @endif


                  </div>
                  <div class='col-md-6'>
                    @if(Session::get('date_info'))
                        Arrival : {{Session::get('date_info')['start']}} <br/>
                        Departure: {{Session::get('date_info')['end']}} <br/>
                        @if (Session::get('totalFee'))
                          Total Fee: {{Session::get('totalFee')}}<br/>
                        @endif
                    @endif

                  </div>
              </div>
              @if(Session::get('date_info'))
              <div align="right">
              <a href="/#booknow" class="btn btn-default">Edit Information</a>
              {{HTML::linkRoute('book.removeAllItems', 'Reset' ,null, array('class' => 'btn btn-default'))}}
              {{HTML::linkRoute('book.index', 'Add Reservation items' ,null, array('class' => 'btn btn-primary'))}}
            </div>
              @endif
            </h5>
          </div>
          <div class="modal-body">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
                     @if((Session::get('items')))
                      <?php $ctr = 0;?>
                        @foreach (Session::get('items') as $i)
                              <div class="panel panel-info">
                                <div class="panel-heading" role="tab" id="headingOne">
                                  <h5 class="panel-title">
                                    <a data-toggle="collapse" class="list-group" data-parent="#accordion" href="#collapse{{$ctr}}" aria-expanded="false" aria-controls="collapse{{$ctr}}">
                                          
                                          <span class="list-group-item">

                                            <span>{{$i['product']}} 

                                                <span class="badge">
                                                    {{$i['quantity']}}
                                                </span>
                                             </span>

                                          </span>
                                    </a>
                                  </h5>
                                </div>
                                <div id="collapse{{$ctr}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                  <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-8">

                                                <p>{{$i['description']}}</p>
                                              
                                                <span class="badge"></span>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-lg-6"><p>Category: {{$i['type']}}</p> </div>
                                                    <div class="col-lg-6"><p>Price Per Unit : {{$i['price']}}
                                                        <div class="btn-group " role="group" aria-label="...">
                                                      @if(isset($i['removable']))
                                                        @if($i['removable'] == false)
                                                        @else
                                                        <a type="" href="{{URL::route('book.deleteItem', ['key' => $ctr])}}" class="btn btn-danger">
                                                      <i class="glyphicon glyphicon-remove"></i> Remove</a>
                                                        @endif
                                                      @else
                                                      <a type="" href="{{URL::route('book.deleteItem', ['key' => $ctr])}}" class="btn btn-danger">
                                                      <i class="glyphicon glyphicon-remove"></i> Remove</a>
                                                      @endif
                                                    </div>
                                                    </p></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <a data-lightbox="image-1" class="example-image-link" data-title="{{$i['product']}}" href="{{$i['image']}}"  >
                                                <img src="{{$i['image']}}"   class="example-image img-responsive img-rounded" />
                                            </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            <?php $ctr+= 1;?>
                        @endforeach
                              </div>
                    @else
                        <div role="presentation">
                            <a role="menuitem" tabindex="-1" href="/">Reservation List is empty </a>           
                        </div>
                    @endif
          </div>
          <div class="modal-footer">  
             @if((Session::get('items')))
            {{HTML::linkRoute('book.create', 'Proceed to Checkout',array(), array('id' => 'linkid', 'class' => 'btn btn-primary'), false);}}
            @endif
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
</header>