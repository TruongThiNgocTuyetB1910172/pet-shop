<x-mail::message>

    #Thank you
    Chúc mừng quý khách đã đặt hàng thành công

{{--    Thông tin giao hàng--}}
{{--    + {{ $shippingAddress }}--}}
{{--    + {{ $total }}--}}
{{--    + {{ $trackingNumber }}--}}
{{--    + {{ $notes }}--}}

    @component('mail::table')

        |Product  |QTY  |Price   |
        |---------|-----|--------|
        |Computer |1    |   $1600|
        |Phone    |1    |     $12|
        |Dongle   |24   |   $2400|
        |&nbsp;   |Total|$4012.00|

    @endcomponent




</x-mail::message>
