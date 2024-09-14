<section class="product_section layout_padding">
   <div class="container">
      <div class="heading_container heading_center">
         <h2>
            Our <span>Menu</span>
         </h2>
      </div>
      <div class="row">
         <div class="col-sm-6 col-md-4 col-lg-4">
            <div class="box">
               <div class="option_container">
                  <div class="options">
                     <a href="add-item" class="option1">
                        Add To Cart
                     </a>
                     <a href="item-details" class="option2">
                        View Item Details
                     </a>
                     <a href="image-form" class="option3">
                        Image Upload
                     </a>
                  </div>
               </div>

               <div class="img-box">
                  <img src="images/p1.png" alt="">
               </div>
               <div class="detail-box">
                  <h5>
                     Pan Cake
                  </h5>
                  <h6>
                     $75
                  </h6>
               </div>


            </div>
         </div>
         @foreach ($itemData as $key)
     
         <div class="col-sm-6 col-md-4 col-lg-4">
            <div class="box">
               <div class="option_container">
                  <div class="options">
                     <a href="add-item" class="option1">
                        Add To Cart
                     </a>
                     <a href="item-details" class="option2">
                        View Item Details
                     </a>
                     <a href="image-form" class="option3">
                        Image Upload
                     </a>
                  </div>
               </div>

               <div class="img-box">
                  <img src="{{$Path.$key->Image}}" alt="">
               </div>
               <div class="detail-box">
                  <h5>
                     {{$key->FoodName}}
                  </h5>
                  <h6>
                     {{$key->Price}}
                  </h6>
               </div>
            </div>
         </div>
    
      @endforeach
      </div>

      
      <div class="btn-box">
         <a href="">
            View All products
         </a>
      </div>
   </div>
</section>