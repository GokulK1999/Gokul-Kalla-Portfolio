<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our Details <span>Menu</span>
            </h2>
        </div>
        <div class="row">

            @foreach ($itemData as $key)

            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="box">
                    <div class="option_container">
                        <div class="options">
                            <a href="item-details?id={{$key->ID}}" class="option2">
                                View Item Details
                            </a>
                        </div>
                    </div>

                    <div class="img-box">
                        <img src="storage/images/{{$key->Photo}}" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            {{$key->ItemName}}
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
            <a href="catering-booking" class="option1">
                Catering Booking List
            </a>
            <a href="menu">
                Back to Main Menu
            </a>
        </div>
    </div>
</section>