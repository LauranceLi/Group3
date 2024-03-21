<div class="row d-inline-flex">
    <form action="filter_result.php" method="POST" class="mb-1">
        <div class="input-group">
            <select name="order_status" class="form-select" aria-label="Select order status">
                <option value="">訂單狀態</option>
                <option value="完成">完成</option>
                <option value="取消">取消</option>
                <option value="處理中">處理中</option>
            </select>
            <select name="payment_status" class="form-select" aria-label="Select payment status">
                <option value="">付款狀態</option>
                <option value="已付款">已付款</option>
                <option value="未付款">未付款</option>
            </select>
            <select name="shipping_status" class="form-select" aria-label="Select shipping status">
                <option value="">送貨狀態</option>
                <option value="已出貨">已出貨</option>
                <option value="未出貨">未出貨</option>
            </select>
            <button class="btn btn-outline-info " type="submit">篩選</button>
        </div>
    </form>
</div>