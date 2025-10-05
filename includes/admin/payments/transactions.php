<div class="wrap">
    <h2>Transactions</h2>
    <table class="widefat fixed datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Booking ID</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>#1001</td>
                <td>$200</td>
                <td>bKash</td>
                <td>Completed</td>
                <td>2025-10-05</td>
            </tr>
        </tbody>
    </table>
</div>
<script>
jQuery(document).ready(function($){
    $('.datatable').DataTable();
});
</script>
