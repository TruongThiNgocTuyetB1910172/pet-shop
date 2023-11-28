@extends('client.layouts.app')
@section('content')

    <section class="sub-header shop-detail-1">
        <img class="rellax bg-overlay" src="client/images/sub-header/013.jpg" alt="">
        <div class="overlay-call-to-action"></div>
        <h3 class="heading-style-3">Lịch sử mua hàng</h3>
    </section>
    <hr>
    <section class="boxed-sm">
        <div class="container">
                <ul class="nav nav-tabs mb-3 w-auto " id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation" >
                        <a href="#all" class="nav-link active" data-toggle="tab" role="tab" style="color: black">Tất cả đơn hàng</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#pending" class="nav-link" data-toggle="tab" role="tab" style="color: black">Chờ xác nhận</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#accepted" class="nav-link" data-toggle="tab" role="tab" style="color: black">Đã duyệt</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#inDelivery" class="nav-link"  data-toggle="tab" role="tab" style="color: black">Đang giao</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#success" class="nav-link"  data-toggle="tab" role="tab" style="color: black">Đã nhận hàng</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#cancel" class="nav-link"  data-toggle="tab" role="tab" style="color: black">Đã hủy</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#refund" class="nav-link"  data-toggle="tab" role="tab" style="color: black">Trả hàng/ hoàn tiền</a>
                    </li>
                </ul>
            <br>
            <div class="tab-content " id="pills-tabContent">
                <div role="tabpanel" class="tab-pane" id="all">
                    @if ($orders->count() > 0)
                        <div class="woocommerce">
                            <form class="woocommerce-cart-form">
                                <table class="woocommerce-cart-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="product-thumbnail">Địa chỉ</th>
                                        <th class="product-name">Trạng thái</th>
                                        <th class="product-price">Tổng tiền</th>
                                        <th class="product-quantity">Thời gian đặt</th>
                                        <th class="product-quantity">Thời gian cập nhật trạng thái</th>
                                        <th class="product-remove">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td  class="text-truncate" style="max-width: 150px;">
                                                {{ $order->shipping_address }}
                                            </td>
                                            @if($order->status === 'pending')
                                                <td><span class="badge badge-danger" style="background-color:#5252f3">Đang chờ duyệt</span></td>
                                            @elseif($order->status === 'accepted')
                                                <td><span class="badge badge-danger" style="background-color: #4703f5">Đã được duyệt</span></td>
                                            @elseif($order->status === 'inDelivery')
                                                <td><span class="badge badge-warning" style="background-color: orangered">Đang vận chuyển</span></td>
                                            @elseif($order->status === 'success')
                                                <td><span class="badge badge-success" style="background-color: green">Thành công</span></td>
                                            @elseif($order->status === 'cancel')
                                                <td><span class="badge badge-info"  style="background-color: red">Hủy đơn</span></td>
                                            @else
                                                <td><span class="badge badge-dark">Hoàn tiền</span></td>
                                            @endif
                                            <td class="product-subtotal" data-title="Total">{{ CurrencyHelper::format($order->total) }}</td>
                                            <td>{{$order->created_at->format('d')}} - {{$order->created_at->format('m')}} -
                                                {{$order->created_at->format('Y')}} <small>{{ $order->created_at->format('g:i A') }}</small>
                                            </td>
                                            <td>{{$order->updated_at->format('d')}} - {{$order->updated_at->format('m')}} -
                                                {{$order->updated_at->format('Y')}} <small>{{ $order->updated_at->format('g:i A') }}</small>
                                            </td>
                                            <td class="product-remove">
                                                <a  style="cursor: pointer" href="{{ route('history.detail', ['id'=> $order->id]) }}" aria-label="Remove this item"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </form>
                            <hr>
                        </div>
                    @else
                        <div class="woocommerce" style="margin-bottom: 30px">
                            <h3 class="text-center">Không có sản phẩm nào.</h3>
                        </div>
                    @endif
                </div>
                <div role="tabpanel" class="tab-pane active" id="pending">
                    @if ($orders->count() > 0)
                        <div class="woocommerce">
                            <form class="woocommerce-cart-form">
                                <table class="woocommerce-cart-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="product-thumbnail">Địa chỉ</th>
                                        <th class="product-price">Tổng tiền</th>
                                        <th class="product-quantity">Thời gian đặt</th>
                                        <th class="product-quantity">Thời gian cập nhật trạng thái</th>
                                        <th class="product-remove">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($orders as $order)
                                            @if($order->status === 'pending')
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td class="product-name" >
                                                    {{ $order->shipping_address }}
                                                </td>
                                                <td class="product-subtotal" data-title="Total">{{ CurrencyHelper::format($order->total) }}</td>
                                                <td>{{$order->created_at->format('d')}} - {{$order->created_at->format('m')}} -
                                                    {{$order->created_at->format('Y')}} <small>{{ $order->created_at->format('g:i A') }}</small>
                                                </td>
                                                <td>{{$order->updated_at->format('d')}} - {{$order->updated_at->format('m')}} -
                                                    {{$order->updated_at->format('Y')}} <small>{{ $order->updated_at->format('g:i A') }}</small>
                                                </td>
                                                <td class="product-remove">
                                                    <a  style="cursor: pointer" href="{{ route('history.detail', ['id'=> $order->id]) }}" aria-label="Remove this item"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                    </tbody>
                                    @endif
                                    @endforeach

                                </table>
                            </form>
                            <hr>
                        </div>
                    @else
                        <div class="woocommerce" style="margin-bottom: 30px">
                            <h3 class="text-center">Không có sản phẩm nào.</h3>
                        </div>
                    @endif
                </div>
                <div role="tabpanel" class="tab-pane" id="accepted">
                    @if ($orders->count() > 0)
                        <div class="woocommerce">
                            <form class="woocommerce-cart-form">
                                <table class="woocommerce-cart-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="product-thumbnail">Địa chỉ</th>
                                        <th class="product-price">Tổng tiền</th>
                                        <th class="product-quantity">Thời gian đặt</th>
                                        <th class="product-quantity">Thời gian cập nhật trạng thái</th>
                                        <th class="product-remove">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($orders as $order)
                                        @if($order->status === 'accepted')
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td class="product-name" >
                                                    {{ $order->shipping_address }}
                                                </td>
                                                <td class="product-subtotal" data-title="Total">{{ CurrencyHelper::format($order->total) }}</td>
                                                <td>{{$order->created_at->format('d')}} - {{$order->created_at->format('m')}} -
                                                    {{$order->created_at->format('Y')}} <small>{{ $order->created_at->format('g:i A') }}</small>
                                                </td>
                                                <td>{{$order->updated_at->format('d')}} - {{$order->updated_at->format('m')}} -
                                                    {{$order->updated_at->format('Y')}} <small>{{ $order->updated_at->format('g:i A') }}</small>
                                                </td>
                                                <td class="product-remove">
                                                    <a  style="cursor: pointer" href="{{ route('history.detail', ['id'=> $order->id]) }}" aria-label="Remove this item"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                    </tbody>
                                    @endif
                                    @endforeach

                                </table>
                            </form>
                            <hr>
                        </div>
                    @else
                        <div class="woocommerce" style="margin-bottom: 30px">
                            <h3 class="text-center">Không có sản phẩm nào.</h3>
                        </div>
                    @endif</div>
                <div role="tabpanel" class="tab-pane" id="inDelivery">
                    @if ($orders->count() > 0)
                        <div class="woocommerce">
                            <form class="woocommerce-cart-form">
                                <table class="woocommerce-cart-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="product-thumbnail">Địa chỉ</th>
                                        <th class="product-price">Tổng tiền</th>
                                        <th class="product-quantity">Thời gian đặt</th>
                                        <th class="product-quantity">Thời gian cập nhật trạng thái</th>
                                        <th class="product-remove">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($orders as $order)
                                        @if($order->status === 'inDelivery')
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td class="product-name" >
                                                    {{ $order->shipping_address }}
                                                </td>
                                                <td class="product-subtotal" data-title="Total">{{ CurrencyHelper::format($order->total) }}</td>
                                                <td>{{$order->created_at->format('d')}} - {{$order->created_at->format('m')}} -
                                                    {{$order->created_at->format('Y')}} <small>{{ $order->created_at->format('g:i A') }}</small>
                                                </td>
                                                <td>{{$order->updated_at->format('d')}} - {{$order->updated_at->format('m')}} -
                                                    {{$order->updated_at->format('Y')}} <small>{{ $order->updated_at->format('g:i A') }}</small>
                                                </td>
                                                <td class="product-remove">
                                                    <a  style="cursor: pointer" href="{{ route('history.detail', ['id'=> $order->id]) }}" aria-label="Remove this item"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                    </tbody>
                                    @endif
                                    @endforeach

                                </table>
                            </form>
                            <hr>
                        </div>
                    @else
                        <div class="woocommerce" style="margin-bottom: 30px">
                            <h3 class="text-center">Không có sản phẩm nào.</h3>
                        </div>
                    @endif
                </div>
                <div role="tabpanel" class="tab-pane" id="success">
                    @if ($orders->count() > 0)
                        <div class="woocommerce">
                            <form class="woocommerce-cart-form">
                                <table class="woocommerce-cart-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="product-thumbnail">Địa chỉ</th>
                                        <th class="product-price">Tổng tiền</th>
                                        <th class="product-quantity">Thời gian đặt</th>
                                        <th class="product-quantity">Thời gian cập nhật trạng thái</th>
                                        <th class="product-remove">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($orders as $order)
                                        @if($order->status === 'success')
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td class="product-name" >
                                                    {{ $order->shipping_address }}
                                                </td>
                                                <td class="product-subtotal" data-title="Total">{{ CurrencyHelper::format($order->total) }}</td>
                                                <td>{{$order->created_at->format('d')}} - {{$order->created_at->format('m')}} -
                                                    {{$order->created_at->format('Y')}} <small>{{ $order->created_at->format('g:i A') }}</small>
                                                </td>
                                                <td>{{$order->updated_at->format('d')}} - {{$order->updated_at->format('m')}} -
                                                    {{$order->updated_at->format('Y')}} <small>{{ $order->updated_at->format('g:i A') }}</small>
                                                </td>
                                                <td class="product-remove">
                                                    <a  style="cursor: pointer" href="{{ route('history.detail', ['id'=> $order->id]) }}" aria-label="Remove this item"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                    </tbody>
                                    @endif
                                    @endforeach

                                </table>
                            </form>
                            <hr>
                        </div>
                    @else
                        <div class="woocommerce" style="margin-bottom: 30px">
                            <h3 class="text-center">Không có sản phẩm nào.</h3>
                        </div>
                    @endif
                </div>
                <div role="tabpanel" class="tab-pane" id="cancel">
                    @if ($orders->count() > 0)
                        <div class="woocommerce">
                            <form class="woocommerce-cart-form">
                                <table class="woocommerce-cart-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="product-thumbnail">Địa chỉ</th>
                                        <th class="product-price">Tổng tiền</th>
                                        <th class="product-quantity">Thời gian đặt</th>
                                        <th class="product-quantity">Thời gian cập nhật trạng thái</th>
                                        <th class="product-remove">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($orders as $order)
                                        @if($order->status === 'cancel')
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td class="product-name" >
                                                    {{ $order->shipping_address }}
                                                </td>
                                                <td class="product-subtotal" data-title="Total">{{ CurrencyHelper::format($order->total) }}</td>
                                                <td>{{$order->created_at->format('d')}} - {{$order->created_at->format('m')}} -
                                                    {{$order->created_at->format('Y')}} <small>{{ $order->created_at->format('g:i A') }}</small>
                                                </td>
                                                <td>{{$order->updated_at->format('d')}} - {{$order->updated_at->format('m')}} -
                                                    {{$order->updated_at->format('Y')}} <small>{{ $order->updated_at->format('g:i A') }}</small>
                                                </td>
                                                <td class="product-remove">
                                                    <a  style="cursor: pointer" href="{{ route('history.detail', ['id'=> $order->id]) }}" aria-label="Remove this item"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                    </tbody>
                                    @endif
                                    @endforeach

                                </table>
                            </form>
                            <hr>
                        </div>
                    @else
                        <div class="woocommerce" style="margin-bottom: 30px">
                            <h3 class="text-center">Không có sản phẩm nào.</h3>
                        </div>
                    @endif
                </div>
                <div role="tabpanel" class="tab-pane" id="refund">
                    @if ($orders->count() > 0)
                        <div class="woocommerce">
                            <form class="woocommerce-cart-form">
                                <table class="woocommerce-cart-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="product-thumbnail">Địa chỉ</th>
                                        <th class="product-price">Tổng tiền</th>
                                        <th class="product-quantity">Thời gian đặt</th>
                                        <th class="product-quantity">Thời gian cập nhật trạng thái</th>
                                        <th class="product-remove">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($orders as $order)
                                        @if($order->status === 'refund')
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td class="product-name" >
                                                    {{ $order->shipping_address }}
                                                </td>
                                                <td class="product-subtotal" data-title="Total">{{ CurrencyHelper::format($order->total) }}</td>
                                                <td>{{$order->created_at->format('d')}} - {{$order->created_at->format('m')}} -
                                                    {{$order->created_at->format('Y')}} <small>{{ $order->created_at->format('g:i A') }}</small>
                                                </td>
                                                <td>{{$order->updated_at->format('d')}} - {{$order->updated_at->format('m')}} -
                                                    {{$order->updated_at->format('Y')}} <small>{{ $order->updated_at->format('g:i A') }}</small>
                                                </td>
                                                <td class="product-remove">
                                                    <a  style="cursor: pointer" href="{{ route('history.detail', ['id'=> $order->id]) }}" aria-label="Remove this item"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                    </tbody>
                                    @endif
                                    @endforeach

                                </table>
                            </form>
                            <hr>
                        </div>
                    @else
                        <div class="woocommerce" style="margin-bottom: 30px">
                            <h3 class="text-center">Không có sản phẩm nào.</h3>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </section>

@endsection




