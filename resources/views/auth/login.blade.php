@extends ('layoutes.app')
@section('content')
<div class="container">
    <div class="row">
       <div class="col-md-6 offset-md-4">
          <div class="card from-holder"> 
             <div class="card-body">
               <h1>Login</h1>
               @if(Session::has('error'))
                <p class="text-danger">{{Session::get('error')}}</p>
               @endif
               @if(Session::has('success'))
                <p class="text-success">{{Session::get('success')}}</p>
               @endif

               <form action="{{route('login')}}" method="post">
                @csrf
                @method('post')
 
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Email" >
                 
                </div>
                <div class="form-group">
                  <label for="email">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Password" required>
         
                </div>
                <div class="form-group">
                     <a href="" class="btn btn-link"> Forgot Password</a>
                </div>
                
                <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="Login">
                </div>
               </form>
             </div>
          </div>
       </div>
    </div>
</div>

@endsection