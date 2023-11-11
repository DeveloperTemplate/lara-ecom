<div class="order-status-load">
    @if ($orderStatus ?? null)
    <label class="form-label">Status</label>
    <select name="status" class="form-control">
        <option value="Pending" @if ($orderStatus->status == 'Pending') selected @endif >Pending</option>
        <option value="Processing" @if ($orderStatus->status == 'Processing') selected @endif>Processing</option>
        <option value="Shipped" @if ($orderStatus->status == 'Shipped') selected @endif>Shipped</option>
        <option value="In Transit" @if ($orderStatus->status == 'In Transit') selected @endif>In Transit</option>
        <option value="Out for Delivery" @if ($orderStatus->status == 'Out for Delivery') selected @endif>Out for Delivery</option>
        <option value="Delivered" @if ($orderStatus->status == 'Delivered') selected @endif>Delivered</option>
        <option value="Cancelled" @if ($orderStatus->status == 'Cancelled') selected @endif>Cancelled</option>
        <option value="On Hold" @if ($orderStatus->status == 'On Hold') selected @endif>On Hold</option>
        <option value="Returned" @if ($orderStatus->status == 'Returned') selected @endif>Returned</option>
        <option value="Refunded" @if ($orderStatus->status == 'Refunded') selected @endif>Refunded</option>
        <option value="Backordered" @if ($orderStatus->status == 'Backordered') selected @endif>Backordered</option>
        <option value="Partially Shipped" @if ($orderStatus->status == 'Partially Shipped') selected @endif>Partially Shipped</option>     
    </select>   
    @endif
</div>
