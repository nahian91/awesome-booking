<div class="wrap">
    <h2>Refund Requests</h2>
    <table class="widefat fixed datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Transaction</th>
                <th>Customer</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Requested On</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>#TX12345</td>
                <td>John Doe</td>
                <td>$100</td>
                <td>Pending</td>
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
