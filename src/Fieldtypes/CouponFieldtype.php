<?php

namespace DoubleThreeDigital\SimpleCommerce\Fieldtypes;

use DoubleThreeDigital\SimpleCommerce\Facades\Coupon;
use Statamic\CP\Column;
use Statamic\Fieldtypes\Relationship;

class CouponFieldtype extends Relationship
{
    protected $canCreate = false;

    public function getIndexItems($request)
    {
        return Coupon::all()->map(function ($coupon) {
            return [
                'id'   => $coupon->id(),
                'code'  => $coupon->code(),
                'discount' => $coupon->discountText(),
                'redeemed' => $coupon->get('redeemed', 0) . ' times',
            ];
        })->values();
    }

    protected function getColumns()
    {
        return [
            Column::make('code')
                ->label('Code'),

            Column::make('discount')
                ->label('Discount'),

            Column::make('redeemed')
                ->label('Redeemed'),
        ];
    }

    public function toItemArray($id)
    {
        $coupon = Coupon::find($id);

        return [
            'id' => $coupon->id(),
            'title' => $coupon->code(),
        ];
    }

    public function preProcessIndex($data)
    {
        if (! $data) {
            return;
        }

        return collect($data)->map(function ($item) {
            $coupon = Coupon::find($item);

            return [
                'id' => $coupon->id(),
                'title' => $coupon->code(),
                'edit_url' => $coupon->editUrl(),
            ];
        });
    }
}
