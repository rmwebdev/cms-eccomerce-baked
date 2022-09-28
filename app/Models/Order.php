<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Auditable;
    use HasFactory;

    public const ORDER_STATUS_SELECT = [
        'bag'      => 'Bag',
        'order'    => 'Order',
        'payment'  => 'Payment',
        'process'  => 'Process',
        'shipping' => 'Shipping',
        'done'     => 'Done',
    ];

    public $table = 'orders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'amount',
        'shipping_address',
        'order_address',
        'order_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
