<!DOCTYPE html>
<html>
    <head>
        <title>Chat App Socket.io</title>
    </head>
    <body>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>
        <script>
            $(function() {
                let ip_address = '127.0.0.1';
                let socket_port = '3000';
                let socket = io(ip_address + ':' + socket_port);
                socket.emit('connect_customer', {user_id: 2},() => {
                    
                });
                socket.on('connect_customer', (message) => {
                    console.log(message);
                });
            });
        </script>
    </body>
</html>