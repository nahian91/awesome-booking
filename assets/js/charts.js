document.addEventListener('DOMContentLoaded', function(){
    // Dashboard Booking Status Pie
    if(document.getElementById('abegStatusChart')){
        new Chart(document.getElementById('abegStatusChart').getContext('2d'),{
            type:'pie',
            data:{labels:['Pending','Confirmed','Cancelled'],datasets:[{label:'Bookings',data:abegStatusData,backgroundColor:['#f39c12','#27ae60','#c0392b']}]},
            options:{responsive:true,plugins:{legend:{position:'bottom'}}}
        });
    }

    // Dashboard Revenue per Room
    if(document.getElementById('abegRoomRevenueChart')){
        new Chart(document.getElementById('abegRoomRevenueChart').getContext('2d'),{
            type:'bar',
            data:{labels:abegRoomLabels,datasets:[{label:'Revenue',data:abegRoomData,backgroundColor:'#2980b9'}]},
            options:{responsive:true,plugins:{legend:{display:false}},scales:{y:{beginAtZero:true}}}
        });
    }

    // Reports Monthly Revenue
    if(document.getElementById('abegMonthlyRevenueChart')){
        new Chart(document.getElementById('abegMonthlyRevenueChart').getContext('2d'),{
            type:'bar',
            data:{labels:monthlyLabels,datasets:[{label:'Revenue',data:monthlyData,backgroundColor:'#2980b9'}]},
            options:{responsive:true,plugins:{legend:{display:false}},scales:{y:{beginAtZero:true}}}
        });
    }
});
