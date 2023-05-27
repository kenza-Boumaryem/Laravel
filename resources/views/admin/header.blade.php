<div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="admin/assets/images/logo-mini.svg" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" class="form-control" placeholder="Search products">
                </form>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              <!-- <li class="nav-item dropdown d-none d-lg-block">
                <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" data-toggle="dropdown" aria-expanded="false" href="#">+ Create New Project</a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
                  <h6 class="p-3 mb-0">Projects</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-file-outline text-primary"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Software Development</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-web text-info"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">UI Development</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-layers text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Software Testing</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">See all projects</p>
                </div>
              </li> -->
              <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="#">
                  <i class="mdi mdi-view-grid"></i>
                </a>
              </li>
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email"></i>
                  <?php
               
             $totalRows =App\Models\NotificationU::where('type', 'App\Notifications\NewMessageNotification')->count();;
               ?>
                  <!-- <span class="count bg-success"></span> -->
                  <span class="count-symbol bg-danger">{{$totalRows}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0">Messages</h6>
                  <div class="dropdown-divider"></div>
                  @foreach(auth()->user()->unreadnotifications as $notification)
                  @if ($notification->type === 'App\Notifications\NewMessageNotification')
                 
                  <a onclick="deletenotif({{$notification}})" id="app_{{$notification->id}}"class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <!-- <img src="admin/assets/images/faces/face2.jpg" alt="image" class="rounded-circle profile-pic"> -->
                     
                      <span class="menu-icon" style="color:orange;">
                <i class="mdi mdi-file-document-box"></i>
              </span>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">{{$notification->data['Nom'][0]}}</p>
                      <p class="text-muted mb-0">sent u a message</p>
                    </div>
                  </a>
                  @endif
                  @endforeach
                  <div class="dropdown-divider"></div>
                  
                  
              </li >
              <li class="nav-item dropdown border-left"> 
             
              <a class=" nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell"></i>
               <?php
               
             $totalRows =App\Models\NotificationU::where('type', 'App\Notifications\NewUserNotification')->count();;
               ?>
                  <span class="count-symbol bg-danger">{{$totalRows}}</span>
                </a>
                
                
                 <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  
                    
                @foreach(auth()->user()->unreadnotifications as $notification)
                @if ($notification->type === 'App\Notifications\NewUserNotification')
                <a onclick="deletenotif({{$notification}})" id="app_{{$notification->id}}" class="dropdown-item preview-item"  >
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-calendar text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">{{$notification->data['email'][0]}}</p>
                      <p class="text-muted ellipsis mb-0">just registred in your website</p>
                    </div>
                     
                 </a>
                 @endif
                @endforeach
                 
                
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">See all notifications</p>
                </div>
                
            
             </li>
             
              <li>

              <x-app-layout>
               </x-app-layout>
              </li>
              
          </div>
        </nav>
       <script>
    function deletenotif(notify) {
        console.log('test');
        $.ajax({
            url: "{{route('deletenotif')}}",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                key: notify.id
            },
            success: function (data) {
                console.log(data);
                $('#app_'+notify.id).remove();
            },
            error: function (error) {
                console.error(error);
            }
        });

    }
       </script>