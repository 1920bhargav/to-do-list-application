const express = require('express');
var config = require("../../config.production.json");
var functions = require("./functions");
const app = express();
var unix_time = require('unix-time');
var moment = require('moment');
const server = require('http').createServer(app);

const io = require('socket.io')(server, {
    cors: { origin: "*"}
});

server.listen(3000,()=>{
    console.log('server is running');
});

var customer = {};
var customer_list = [];
var customer_ = config.customer_prefix;

io.on('connection', (socket) => {

    socket.on('connect_customer', function (data) {

        var user_id = functions.validate_params(data.user_id);

        console.log('customer_id ------ : ', data);

        if (user_id !== false)
        {
            var socket_user_id = customer_ + user_id;
            customer[socket_user_id] = user_id;
            socket.username = socket_user_id;
            socket.room = socket_user_id;
            socket.join("normal_users");
            socket.join(socket_user_id);
            io.sockets.in(socket_user_id).emit('connect_customer', {message: 'Customer Connected ...'});
            if (customer_list.indexOf(user_id) == -1)
            {
                customer_list.push(user_id);
            }
            console.log('customer_list',customer_list);
        }

    });
});