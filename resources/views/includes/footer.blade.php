<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.getElementById('menu-toggle').addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar-wrapper');
        sidebar.classList.toggle('active');
    });

    document.getElementById('close-sidebar').addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar-wrapper');
        sidebar.classList.toggle('active');
    });
</script>

<script>
    
    const pusher = new Pusher('abc0252a1a4983e75579', {
        cluster: 'ap2',
        encrypted: true
    });

    
    const channel = pusher.subscribe('admin-notifications');


   
    channel.bind('order.created', function(data) {
       
        const notification = $(`
            <div class="notification" style="
                background-color:rgb(103, 164, 110); 
                color: white; 
                padding: 15px; 
                margin-bottom: 10px; 
                border-radius: 5px; 
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); 
                font-size: 14px;">
                <strong>New Order Created</strong><br>
                Name: ${data.order.name}<br>
                Delivery City: ${data.order.delivery_city}
            </div>
        `);

       
        $('#notification-container').append(notification);

     
        setTimeout(() => {
            notification.fadeOut(500, function() {
                $(this).remove();
            });
        }, 5000);
    });
</script>

</body>
</html>
