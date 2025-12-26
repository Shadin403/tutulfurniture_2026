   <!-- Sidebar Start -->
   <div>
       <div class="pb-3 sidebar pe-4">
           <nav class="navbar bg-light navbar-light">
               <a href="javascript:void(0)" class="mx-4 mb-3 navbar-brand">
                   <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Tutul Furniture</h3>
               </a>
               <div class="mb-4 d-flex align-items-center ms-4">
                   <div class="position-relative">
                       <img class="rounded-circle" src="{{ asset('admin/img/user.jpg') }}" alt=""
                           style="width: 40px; height: 40px;">
                       <div
                           class="bottom-0 p-1 border border-2 border-white bg-success rounded-circle position-absolute end-0">
                       </div>
                   </div>
                   <div class="ms-3">
                       <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                       <span>{{ Auth::user()->role ? 'Admin' : 'User' }}</span>
                   </div>
               </div>
               <div class="navbar-nav w-100">
                   <a href="{{ route('admin.dashboard') }}"
                       class="nav-item nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}"><i
                           class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                   <div class="nav-item dropdown">
                       <a href="javascript:void(0)" class="nav-link dropdown-toggle"
                           onclick="document.getElementById('customerDropdown').classList.toggle('show');"><i
                               class="fa fa-users me-2"></i>Customers</a>
                       <div id="customerDropdown" class="bg-transparent border-0 dropdown-menu"
                           style="margin-left: 20px">
                           <a href="{{ route('admin.all.customers') }}" wire:navigate class="mt-1 dropdown-item"><i
                                   class="fa fa-list me-2"></i>
                               Customer list</a>
                       </div>
                   </div>
               </div>
               <div class="navbar-nav w-100">
                   <div>
                       <div class="nav-item dropdown">
                           <div onclick="document.getElementById('productDropdown').classList.toggle('show');"><a
                                   href="#" class="nav-link dropdown-toggle"><i
                                       class="bi bi-layers-half"></i>Product</a>
                           </div>
                           <div id="productDropdown" class="bg-transparent border-0 dropdown-menu"
                               style="margin-left: 20px">
                               <a href="{{ route('admin.product.create') }}" wire:navigate class="dropdown-item"><i
                                       class="fa fa-plus me-2"></i>
                                   Create
                                   Product</a>
                               <a wire:navigate href="{{ route('admin.all.products') }}" class="dropdown-item"><i
                                       class="fa fa-list me-2"></i>Product
                                   list </a>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="navbar-nav w-100">
                   <div>
                       <div class="nav-item dropdown">
                           <div onclick="document.getElementById('brandDropdown').classList.toggle('show');"><a
                                   href="#" class="nav-link dropdown-toggle"><i
                                       class="bi bi-layers-half"></i>Brand</a>
                           </div>
                           <div id="brandDropdown" class="bg-transparent border-0 dropdown-menu"
                               style="margin-left: 20px">
                               <a href="{{ route('admin.brand.create') }}" wire:navigate class="dropdown-item"><i
                                       class="fa fa-plus me-2"></i>
                                   Create
                                   Brand</a>
                               <a href="{{ route('admin.all.brands') }}" wire:navigate class="dropdown-item"><i
                                       class="fa fa-list me-2"></i>Brand
                                   list </a>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="navbar-nav w-100">
                   <div class="nav-item dropdown">
                       <a href="javascript:void(0)"
                           onclick="document.getElementById('categoryDropdown').classList.toggle('show');"
                           class="nav-link dropdown-toggle">
                           <i class="bi bi-layers-half"></i>
                           Category
                       </a>

                       <div id="categoryDropdown" class="bg-transparent border-0 dropdown-menu"
                           style="margin-left: 20px">
                           <a href="{{ route('admin.category.create') }}" wire:navigate class="dropdown-item">
                               <i class="fa fa-plus me-2"></i> Create Category
                           </a>
                           <a href="{{ route('admin.all.categories') }}" wire:navigate class="dropdown-item">
                               <i class="fa fa-list me-2"></i> Category list
                           </a>
                       </div>
                   </div>
               </div>
               <div class="navbar-nav w-100">
                   <div class="nav-item dropdown">
                       <a href="javascript:void(0)"
                           onclick="document.getElementById('subcategoryDropdown').classList.toggle('show');"
                           class="nav-link dropdown-toggle">
                           <i class="bi bi-layers-half"></i>
                           Sub-Category
                       </a>

                       <div id="subcategoryDropdown" class="bg-transparent border-0 dropdown-menu"
                           style="margin-left: 20px">
                           <a href="{{ route('admin.subCategory.create') }}" wire:navigate class="dropdown-item">
                               <i class="fa fa-plus me-2"></i> Create Sub-Category
                           </a>
                           <a href="{{ route('admin.all.subCategories') }}" wire:navigate class="dropdown-item">
                               <i class="fa fa-list me-2"></i> Sub-Category list
                           </a>
                       </div>
                   </div>
               </div>

               <div class="navbar-nav w-100">
                   <div class="nav-item dropdown">
                       <a href="javascript:void(0)"
                           onclick="document.getElementById('sliderDropdown').classList.toggle('show');"
                           class="nav-link dropdown-toggle">
                           <i class="bi bi-layers-half"></i>
                           Sliders
                       </a>

                       <div id="sliderDropdown" class="bg-transparent border-0 dropdown-menu" style="margin-left: 20px">
                           <a href="{{ route('admin.slider.create') }}" wire:navigate class="dropdown-item">
                               <i class="fa fa-plus me-2"></i> Create Slider
                           </a>
                           <a href="{{ route('admin.all.sliders') }}" wire:navigate class="dropdown-item">
                               <i class="fa fa-list me-2"></i> Slider list
                           </a>
                       </div>
                   </div>
               </div>
               <div class="navbar-nav w-100">
                   <div class="nav-item dropdown">
                       <form id="logout-form" action="" method="POST">
                           <a href="#" class="nav-link">
                               <i class="fas fa-sign-out-alt me-2" style="color: black;"></i>Logout
                           </a>
                       </form>
                   </div>
               </div>
           </nav>
       </div>
       <!-- Sidebar End -->


   </div>
