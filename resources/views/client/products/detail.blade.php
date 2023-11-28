@extends('client.layouts.app')

@section('content')
    <section class="sub-header shop-detail-1">
        <img class="rellax bg-overlay" src="{{asset('client/images/sub-header/01.jpg')}}" alt="" />
        <div class="overlay-call-to-action"></div>
        <h3 class="heading-style-3">Chi tiết sản phẩm</h3>
    </section>
    <hr>
    <section class="boxed-sm">
        <div class="container">
            <div class="row product-detail">
                <div class="row main">
                    <div class="col-md-6">
                        <div class="woocommerce-product-gallery">
                            <div class="main-carousel">
                                @foreach($product->productImages as $key => $image)
                                    <div class="item">
                                        <img
                                            class="img-responsive"
                                            src="{{ asset($image->image) }}"
                                            alt="product thumbnail"
                                        />
                                    </div>
                                @endforeach
                            </div>
                            <br>
                            <div class="thumbnail-carousel ">
                                @foreach($product->productImages as $key => $image)
                                    <div class="item">
                                        <img
                                            class="img-responsive"
                                            src="{{ asset($image->image) }}"
                                            alt="{{ $product->name }}"
                                        />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="summary">
                            <div class="desc">
                                <div class="header-desc">
                                    <h2 class="product-title">{{$product->name}}</h2>
                                    <br>
                                    <span style="font-size: 30px;color: #96ad76" class="price">Giá: {{ CurrencyHelper::format($product->selling_price) }}</span>

                                    @if($productReviews->count() > 0)
                                        <div>
                                            @php
                                                $fullStars = floor($productRating); // Số sao đầy
                                                $halfStar = $productRating - $fullStars; // Phần nửa sao
                                                $emptyStars = 5 - $fullStars - ceil($halfStar); // Số sao rỗng
                                            @endphp
                                            @for ($i = 1; $i <= $fullStars; $i++)
                                                <i class="fa fa-star" aria-hidden="true"  style="color: yellow"></i>
                                            @endfor

                                            @if ($halfStar > 0)
                                                <i class="fa fa-star-half"  style="color: yellow"></i>
                                            @endif

                                            @for ($i = 1; $i <= $emptyStars; $i++)
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            @endfor
                                            <span> {{$productRating}} ({{$feedbacks->count()}} reviewer)</span>
                                        </div>
                                    @else
                                        <p>({{$feedbacks->count()}} reviewer)</p>
                                    @endif
                                </div>
                                <br>
                                <div class="product-meta">
                                    <p style="margin-bottom: 10px; font-size: medium ">
                                        Danh mục:
                                        <a href="#" rel="tag">{{$product->category->name}}</a>
                                    </p>
                                    <p style="margin-bottom: 10px; font-size: medium ">
                                        ID:
                                        <a href="#"> {{$product->sku}}</a>
                                    </p>
                                    <p style="margin-bottom: 10px; font-size: medium ">Hàng trong kho: {{$product->stock}}</p>
                                    <strong style="margin-bottom: 10px; font-size: large ">
                                        Mô tả:
                                    </strong>
                                    <p>{!! $product->description !!}</p>
                                </div>
                                <br>
                                <div class="widget-social align-left">
                                    <ul>
                                        <li>
                                            <a
                                                class="facebook"
                                                data-toggle="tooltip"
                                                title="Facebook"
                                                href="https://www.facebook.com/authemes"
                                            >
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="pinterest"
                                                data-toggle="tooltip"
                                                title="Pinterest"
                                                href="https://www.pinterest.com/authemes"
                                            >
                                                <i class="fa fa-pinterest"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="twitter"
                                                data-toggle="tooltip"
                                                title="Twitter"
                                                href="https://www.twitter.com/authemes"
                                            >
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="google-plus"
                                                data-toggle="tooltip"
                                                title="Google Plus"
                                                href="https://plus.google.com/authemes"
                                            >
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="instagram"
                                                data-toggle="tooltip"
                                                title="Instagram"
                                                href="https://instagram.com/authemes"
                                            >
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <br>
                                <br>
                                <div class="footer-desc row">
                                   <div class="col-md-9"> <form class="cart" action="{{ route('cart.add-to-cart', ['id' => $product->id]) }}" method="POST" id="addCart">
                                           @csrf
                                           <div class="quantity buttons-added" style="margin-right: 40px">
                                               <input class="minus"  value="-"  type="button" />
                                               <input
                                                   class="input-text qty text"
                                                   step="1"
                                                   min="1"
                                                   max=""
                                                   name="qty"
                                                   value="1"
                                                   title="Qty"
                                                   size="4"
                                                   pattern="[0-9]*"
                                                   inputmode="numeric"
                                                   id="qty"
                                                   type="number"

                                               />
                                               <input class="plus" value="+" type="button"  />
                                           </div>
                                           <button class="btn btn-brand no-radius" style="margin-right: 20px" type="submit">
                                               <a href="{{ route('cart.add-to-cart', ['id' => $product->id]) }}" class="primary-btn" style="color: white" onclick="event.preventDefault(); document.getElementById('addCart').submit();">Thêm vào giỏ hàng </a>
                                           </button>
                                       </form></div>
                                   <div class="col-md-3">
                                       <form action="{{ route('product-wishlist.addToWishList', ['id'=> $product->id]) }}" method="POST">
                                           @csrf
                                           <button
                                               class="btn btn-wishlist btn-brand-ghost no-radius"
                                               type="submit">
                                               <span class="lnr lnr-heart " ></span>
                                           </button>
                                       </form>

                                   </div>
                                    <hr>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div >
                <div class="heading-wrapper text-center">
                    <h3 class="heading">Viết đánh giá</h3>
                </div>
            </div>

            <div>
                <form action="{{ route('review-product.store', ['productId' => $product->id]) }}" method="POST">
                    @csrf
                    <div style="margin-bottom: 20px">
                        <h4>
                            Đánh giá của bạn
                        </h4>
                    </div>

                    <div class="rating my-4">
                        <label>
                            <input type="radio" name="rating" value="1" />
                            <span class="fa fa-star icon"></span>
                        </label>
                        <label>
                            <input type="radio" name="rating" value="2" />
                            <span class="fa fa-star icon"></span>
                            <span class="fa fa-star icon"></span>
                        </label>
                        <label>
                            <input type="radio" name="rating" value="3" />
                            <span class="fa fa-star icon"></span>
                            <span class="fa fa-star icon"></span>
                            <span class="fa fa-star icon"></span>
                        </label>
                        <label>
                            <input type="radio" name="rating" value="4" />
                            <span class="fa fa-star icon"></span>
                            <span class="fa fa-star icon"></span>
                            <span class="fa fa-star icon"></span>
                            <span class="fa fa-star icon"></span>
                        </label>
                        <label>
                            <input type="radio" name="rating" value="5" />
                            <span class="fa fa-star icon"></span>
                            <span class="fa fa-star icon"></span>
                            <span class="fa fa-star icon"></span>
                            <span class="fa fa-star icon"></span>
                            <span class="fa fa-star icon"></span>
                        </label>
                    </div>
                    <div style="margin-bottom: 20px">
                        <h4>
                            Viết đánh giá:
                        </h4>
                    </div>
                    <textarea
                        class="form-control w-max" style="border-color: green; height: 150px;"
                        name="comment" placeholder="Đánh giá của bạn *">
                    </textarea>
                   @if($checkBought)
                        <div style="margin-top: 20px">
                            <button class="btn btn-brand no-radius" type="submit">
                                Gửi đánh giá
                            </button>
                        </div>
                   @endif
                </form>
            </div>
            @if($productReviews->count()>0)
                <div style="margin-top: 20px">
                    <div class="card example-1 scrollbar-deep-purple bordered-deep-purple thin">
                        <ol class="comment-list">
                            @foreach($productReviews as $productReview)
                                @if($productReview->status === 1)
                                <li>
                                    <div class="the-comment">
                                        <div class="avatar">
                                            <img class="avatar" alt="avatar" style="width: 30px" src="{{ asset('storage/' . $productReview->user->image) }}" alt="{{ $productReview->user->name }}">
                                        </div>
                                        <div class="comment-box">
                                            <div class="comment-author meta">
                                                <p class="author">{{ $productReview->user->name }}</p>
                                                <p class="time">{{ $productReview->created_at }}</p>
                                                @for ($i = 1; $i <= $productReview->rating; $i++)
                                                    <i class="fa fa-star" aria-hidden="true" style="color: #e3e32c"></i>
                                                @endfor
                                            </div>
                                            <div class="row">
                                                    <div class="col-md-11">
                                                        <p>{{ $productReview->comment }}</p>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ol>
                    </div>
                </div>
            @else
                <div class="text-center color-dark"><p>Chưa có đánh giá</p></div>
            @endif
        </div>
        <div class="container">
            <div class="relate-product">
                <div class="heading-wrapper text-center">
                    <h3 class="heading">Sản phẩm tương tự</h3>
                </div>
                <div class="row main">
                    <div class="row product-grid-equal-height-wrapper product-equal-height-4-columns flex multi-row">
                        @foreach($relatedProducts as $product)
                            <figure class="item" style="margin-top: 30px">
                                <div class="product product-style-1">
                                    <div class="img-wrapper">
                                        <a href="{{ route('product-list.detail', ['id' => $product->id]) }}">
                                            <img style="height:280px"  src="{{asset( 'storage/'.$product->image) }}"  alt="product thumbnail" />
                                        </a>
                                        <div class="product-control-wrapper bottom-right">
                                            <div class="wrapper-control-item">
                                                <a class="js-quick-view" href="#" type="button" data-toggle="modal" data-target="#quick-view-product">
                                                    <span class="lnr lnr-eye"></span>
                                                </a>
                                            </div>
                                            <div class="wrapper-control-item item-wish-list">
                                                <a class="js-wish-list js-notify-add-wish-list" href="#">
                                                    <span class="lnr lnr-heart"></span>
                                                </a>
                                            </div>
                                            <div class="wrapper-control-item item-add-cart js-action-add-cart">
                                                <a class="animate-icon-cart" href="#">
                                                    <span class="lnr lnr-cart"></span>
                                                </a>
                                                <svg x="0px" y="0px" width="36px" height="32px" viewbox="0 0 36 32">
                                                    <path stroke-dasharray="19.79 19.79" fill="none" ,="," stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M9,17l3.9,3.9c0.1,0.1,0.2,0.1,0.3,0L23,11"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <figcaption class="desc text-center" >
                                        <h3>
                                            <a class="product-name" href="product-detail.html">{{$product->name}}</a>
                                        </h3>
                                        <span class="price">Giá: {{ CurrencyHelper::format($product->selling_price) }}</span>
                                    </figcaption>
                                </div>
                            </figure>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
    <style>
        .rating {
            display: inline-block;
            position: relative;
            height: 50px;
            line-height: 50px;
            font-size: 25px;
        }

        .rating label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            cursor: pointer;
        }

        .rating label:last-child {
            position: static;
        }

        .rating label:nth-child(1) {
            z-index: 5;
        }

        .rating label:nth-child(2) {
            z-index: 4;
        }

        .rating label:nth-child(3) {
            z-index: 3;
        }

        .rating label:nth-child(4) {
            z-index: 2;
        }

        .rating label:nth-child(5) {
            z-index: 1;
        }

        .rating label input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .rating label .icon {
            float: left;
            color: transparent;
        }

        .rating label:last-child .icon {
            color: black;
        }

        .rating:not(:hover) label input:checked ~ .icon,
        .rating:hover label:hover input ~ .icon {
            color: #ffa904;
        }

        .rating label input:focus:not(:checked) ~ .icon:last-child {
            color: black;
            text-shadow: 0 0 5px #ffa904;
        }

        .scrollbar-deep-purple::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #F5F5F5;
            border-radius: 10px;
        }

        .scrollbar-deep-purple::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        .scrollbar-deep-purple::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #96ad76;
        }

        .scrollbar-deep-purple {
            scrollbar-color: #96ad76 #F5F5F5;
        }

        .bordered-deep-purple::-webkit-scrollbar-track {
            -webkit-box-shadow: none;
            border: 1px solid #96ad76;
        }

        .bordered-deep-purple::-webkit-scrollbar-thumb {
            -webkit-box-shadow: none;
        }

        .square::-webkit-scrollbar-track {
            border-radius: 0 !important;
        }

        .square::-webkit-scrollbar-thumb {
            border-radius: 0 !important;
        }

        .thin::-webkit-scrollbar {
            width: 6px;
        }

        .example-1 {
            position: relative;
            overflow-y: scroll;
            height: 300px;
        }
    </style>
@endsection
