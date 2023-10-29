<div>
    @php

        $categories=app('categories')
    @endphp
    <section class="sub-header shop-layout-1">
        <img class="rellax bg-overlay" src="{{asset('client/images/sub-header/01.jpg')}}" alt="">
        <div class="overlay-call-to-action"></div>
        <h3 class="heading-style-3">Mua sắm </h3>
    </section>
    <section class="boxed-sm">
        <div class="container">
            <div class="heading-wrapper text-center">
                <h3 class="heading-style-2">Sản phẩm của chúng tôi</h3>
            </div>
            <div class="row">
                <div class="row main">
                    <div class="col-md-3">
                        <div class="sidebar">
                            <div class="widget widget-categories">
                                <h4 class="title-widget text-center">Danh mục</h4>
                                <div class="woocommerce-top-control">
                                    <form method="GET">
                                        <input
                                            wire:model.live.debounce.500ms="searchTerm"
                                            type="text"
                                            placeholder="Search" style="width: 100%;
                                            font-size: 15px;
                                            color: #b7b7b7;
                                            margin: 15px;
                                            padding-left: 15px;
                                            border: 1px solid #e5e5e5;
                                            height: 40px;">
                                    </form>
                                </div>
                                @if($categories->count()>0)
                                    <ul>
                                        @foreach($categories as $key => $category)
                                            @if( $category->products->count() > 0)
                                               <div>
                                                   <input
                                                       wire:model="selectedCategory"
                                                       class="form-check-input hidden" type="radio" value="{{ $category->id }}" id="{{ $key }}">
                                                   <label class="form-group" for="{{ $key }}">
                                                       {{ $category->name }} ({{$category->products->count()}}sp)
                                                   </label>
                                               </div>
                                            @endif
                                        @endforeach
                                    </ul>
                                @else
                                    <li>Không có danh mục nào</li>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="woocommerce-top-control wrapper">
                            <div >
                                <label >Sắp xếp theo giá:</label>
                                <select wire:model="sortOrder" class="form-control" style="width: 200px; height: 30px">
                                    <option value="asc">Giá: Thấp đến Cao</option>
                                    <option value="desc">Giá: Cao đến Thấp</option>
                                </select>
                            </div>
                        </div>
                        <div class="row product-grid-equal-height-wrapper product-equal-height-3-columns flex multi-row">

                            @if($products->count() > 0)
                                @foreach($products as $product)
                                    <figure class="item">
                                        <div class="product product-style-1">
                                            <div class="img-wrapper">
                                                <a href="{{ route('product-list.detail', ['id' => $product->id]) }}">
                                                    <img class="img-responsive" style="height:250px" src="{{asset( 'storage/'.$product->image) }}"  alt="product thumbnail" />
                                                </a>
                                                <div class="product-control-wrapper bottom-right">
                                                    <div class="wrapper-control-item">
                                                    </div>
                                                    <div class="wrapper-control-item item-add-cart ">

                                                        <form action="{{ route('cart.add-to-cart', ['id' => $product->id]) }}" method="POST">
                                                            @csrf
                                                            <button class="animate-icon-cart" type="submit" name="qty"> <span class="lnr lnr-cart"></span></button>
                                                        </form>

                                                        <svg x="0px" y="0px" width="36px" height="32px" viewbox="0 0 36 32">
                                                            <path stroke-dasharray="19.79 19.79" fill="none" ,="," stroke-width="1" stroke-linecap="square" stroke-miterlimit="10" d="M9,17l3.9,3.9c0.1,0.1,0.2,0.1,0.3,0L23,11"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <figcaption class="desc text-center" style="background-color: white">
                                                <h3>
                                                    <a class="product-name" href="{{ route('product-list.detail', ['id' => $product->id]) }}">{{ $product->name }}</a>
                                                </h3>
                                                <span class="price">{{ CurrencyHelper::format($product->selling_price) }}</span>
                                            </figcaption>
                                        </div>
                                    </figure>
                                @endforeach
                            @else
                                <div class="alert alert-warning mt-3">
                                    <strong>Warning!</strong> Sản phẩm bạn tìm kiếm hiện không có.
                                </div>

                            @endif
                        </div>
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 text-right">--}}
{{--                                {{$products->links()}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div><script>
    <script src="path/to/jquery.js"></script>
    <script src="path/to/jquery.nice-select.js"></script>
</script>
