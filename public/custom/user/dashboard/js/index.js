$(document).ready( function () {
    var token=$('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type:'POST',
        url:'/dashboard/chart_data',
        data: {
            _token:token,
        },
        success: function(data) {
            add_chart(data[0],data[1],data[2])
        },
    })
});

function add_chart(users_total,products_total,categories_total){
      
    const data = {
        datasets: [{
          label: 'Users',
          backgroundColor: '#343a40',
          borderColor: '#343a40',
          data: users_total,
          },{
              label: 'Prodcts',
              backgroundColor: '#ffc107',
              borderColor: '#ffc107',
              data: products_total,
          },{
              label: 'Category',
              backgroundColor: '#0dcaf0 ',
              borderColor: '#0dcaf0',
              data: categories_total,
        }],
    };
      
    
    const config = {
        type: 'line',
        data: data,
        options: {}
    };
       
    
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
}

