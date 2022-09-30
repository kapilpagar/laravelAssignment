
@extends ('layoutes.app')
@section('content')
<div class="container">
    <div class="row">
       <div class="col-md-6 offset-md-4">
          <div class="card from-holder"> 
             <div class="card-body">
               <h1>Register</h1>
               @if(Session::has('error'))
                <p class="text-danger">{{Session::get('error')}}</p>
               @endif
               <form action="{{route('register')}}" method="post">
                @csrf
              
                @if(session()->has('registered'))
              <div class="alert alert-success alert-dismissible text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <b>{{session('registered')}}</b>
              </div>
              @endif
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" placeholder="name" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <label for="contact">Contact</label>
                  <input type="tel" name="contact" class="form-control" placeholder="Contact" required>
                </div>
                <div class="form-group">
                  <label for="contact">Address</label>
                  <textarea type="text" name="address" class="form-control" placeholder="Address" required></textarea>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="form-group">
                  <label for="contact">Country</label>
                  <select class="form-control" id="country" name="country">
                  <option value="">Select Country</option>
                    @foreach ($country as $list)
                    <option value="{{$list->id}}">{{$list->country}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="state" >State</label>
                  <!-- <input type="text" class="form-control" name="state"> -->
                  <select  id="state" >
                    <option value="">Selct State</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="city">City</label>
                  <!-- <input type="text" class="form-control" name="city"> -->
                  <select  id="city" >
                     <option value="">Select city</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="Register"><br>
                  <a href="{{route('login')}}" class="btn btn-link">Login</a>
                </div>
               </form>
             </div>
          </div>
       </div>
    </div>
</div>
<!-- Jqueri script -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
    jQuery(document).ready(function(){
        jQuery('#country').change(function(){
            // alert('hi');
            let cid = jQuery(this).val();
            // alert(cid);
            jQuery.ajax({
                url:'/getState',
                type:'post',
                data:'cid='+cid+'&_token={{csrf_token()}}',
                success:function(result){
                    jQuery('#state').html(result)
                }
            })
        });

        jQuery('#state').change(function(){
            // alert('hi');
            let sid = jQuery(this).val();
            alert(sid);
            jQuery.ajax({
                url:'/getCity',
                type:'post',
                data:'sid='+sid+'&_token={{csrf_token()}}',
                success:function(result){
                    jQuery('#city').html(result)
                }
            })
        });
    });

</script>
@endsection('content')
